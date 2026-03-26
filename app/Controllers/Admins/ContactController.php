<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\Contact;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    private $contactModel;
    private $mail;
    private $client;

    public function __construct()
    {
        parent::__construct();
        $this->contactModel = new Contact();
        $this->mail = new PHPMailer(true);
        $this->client = new Client();
    }

    private function validateData($data)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required|digits:10',
            'message' => 'required',
            'status' => 'required',
        ];

        $this->validator->setMessages([
            'name:required' => 'Vui lòng nhập tên',
            'email:required' => 'Vui lòng nhập email',
            'email:email' => 'Email không hợp lệ',
            'phoneNumber:required' => 'Vui lòng nhập số điện thoại',
            'phoneNumber:digits' => 'Số điện phải gồm 10 số',
            'message:required' => 'Vui lòng nhập lời nhắn',
        ]);

        $errors = $this->validate($this->validator, $data, $rules);

        return $errors;
    }

    private function getAndCreateFormData()
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
        $message = htmlspecialchars($_POST['message']);
        $status = htmlspecialchars($_POST['status']) ?? 0;

        $data = [
            'name' => $name,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'message' => $message,
            'status' => $status,
        ];

        return $data;
    }

    public function getAllContacts()
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $keyword = $_GET['keyword'] ?? '';
            $sort = $_GET['sort'] ?? 'id';
            $order = $_GET['order'] ?? 'ASC';
            $page = $_GET['page'] ?? 1;
            $key = $_GET['key'] ?? false;
            $value = $_GET['value'] ?? false;

            $totalContacts = $this->contactModel->countAll();

            $unreadContactsCount = $this->contactModel->countAll([
                'key' => 'status',
                'value' => 0,
            ]);

            $readContactsCount = $this->contactModel->countAll([
                'key' => 'status',
                'value' => 1,
            ]);

            if ($key !== false && $value !== false) {
                $totalContacts = $this->contactModel->countAll([
                    'key' => $key,
                    'value' => $value,
                ]);

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalContacts / $limit);

                $offset = ((int)$page - 1) * $limit;

                $contacts = $this->contactModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'key' => $key,
                    'value' => $value,
                ]);
                return view('adminViews.contacts.index', compact('contacts', 'totalPage', 'page', 'sort', 'order', 'keyword', 'key', 'value', 'totalContacts', 'unreadContactsCount', 'readContactsCount'));
            }

            $limit = $_ENV['LIMIT'];

            $totalPage = ceil($totalContacts / $limit);

            $offset = ((int)$page - 1) * $limit;

            if ($keyword) {
                $totalContacts = $this->contactModel->countAll(
                    [
                        'keyword' => $keyword,
                    ]
                );

                $limit = $_ENV['LIMIT'];

                $totalPage = ceil($totalContacts / $limit);

                $offset = ((int)$page - 1) * $limit;


                $contacts = $this->contactModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                    'keyword' => $keyword
                ]);
            } else {
                $contacts = $this->contactModel->getAll([
                    'offset' => (int)$offset,
                    'limit' => (int)$limit,
                    'order' => $order,
                    'sort' => $sort,
                ]);
            }
            return view('adminViews.contacts.index', compact('contacts', 'totalPage', 'page', 'sort', 'order', 'keyword', 'key', 'value', 'totalContacts', 'unreadContactsCount', 'readContactsCount'));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function showDetailContact($categoryId)
    {
        $contact = $this->contactModel->getById($categoryId);
        return view('adminViews.contacts.detail', compact('contact'));
    }

    public function showViewPrepareSendMail($categoryId)
    {
        $contact = $this->contactModel->getById($categoryId);
        return view('adminViews.contacts.mail', compact('contact'));
    }

    public function sendMail()
    {
        try {
            // Cấu hình SMTP
            $this->mail->isSMTP();
            $this->mail->Host       = $_ENV['MAIL_HOST']; // SMTP server
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = $_ENV['EMAIL_FROM']; // email của bạn
            $this->mail->Password   = $_ENV['APP_PASSWORD'];    // app password (không phải password thường)
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = $_ENV['MAIL_PORT'];

            // Người gửi & nhận
            $this->mail->setFrom($_ENV['EMAIL_FROM'], $_ENV['NAME_FROM']); // email người gửi 
            $this->mail->addAddress('kieuduydoan18@gmail.com', 'Phương'); // email người nhận

            // FIX TIẾNG VIỆT
            $this->mail->CharSet = 'UTF-8';
            // Nội dung
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Test gửi email';
            $this->mail->Body    = 'Xin chào, đây là email được gửi từ PHPMailer!';

            $this->mail->send();
            echo 'Gửi email thành công!';
        } catch (Exception $e) {
            echo "Lỗi: {$this->mail->ErrorInfo}";
        }
    }

    // public function deleteContact($categoryId = false)
    // {
    //     try {
    //         if ($categoryId) {
    //             $category = $this->contactModel->getById($categoryId);
    //             $where = [
    //                 'id' => $categoryId,
    //             ];

    //             $result = $this->contactModel->delete($where);

    //             if ($result > 0) {
    //                 if (file_exists(BASE_URL . $category['img'])) {
    //                     unlink(BASE_URL . $category['img']);
    //                 }
    //                 $_SESSION['success'] = 'Xóa thành công';
    //                 redirect('categories');
    //             }
    //         }

    //         $totalIds = count($_POST['ids']);
    //         $count = 0;

    //         foreach ($_POST['ids'] as $id) {
    //             $category = $this->contactModel->getById($id);
    //             if (!empty($category)) {
    //                 $where = [
    //                     'id' => $id,
    //                 ];

    //                 $result = $this->contactModel->delete($where);

    //                 if ($result > 0) {
    //                     if (file_exists(BASE_URL . $category['img'])) {
    //                         unlink(BASE_URL . $category['img']);
    //                     }
    //                     ++$count;
    //                 } else {
    //                     throw new Exception('Có lỗi xảy ra');
    //                 }
    //             } else {
    //                 throw new Exception('Có lỗi xảy ra');
    //             }
    //         }

    //         if ($count == $totalIds) {
    //             $_SESSION['success'] = 'Xóa thành công';
    //             redirect('categories');
    //         } else {
    //             echo $count;
    //             echo $totalIds;
    //         }
    //     } catch (\Throwable $th) {
    //         echo $th->getMessage();
    //     }
    // }
}
