@extends('layouts.admin')

@section('link_css')
    <link rel="stylesheet" href="{{ route('storage/assets/css/contactMailAdmin.css') }}" />
@endsection

@section('content')
    <!-- Main Form -->
    <div class="app-wrapper">
        <div class="container pb-4 mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main-card">
                        <!-- Sender Section -->
                        <form action="{{ route('contact/sendMail') }}" method="post">
                            <div class="p-4 pb-3">
                                <span class="section-label mb-3">
                                    <i class="fa-solid fa-user"></i>
                                    Thông tin người gửi
                                </span>
                                <div class="row mt-3 g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="senderName">
                                            Tên người gửi
                                            <span class="required">*</span>
                                        </label>
                                        <div class="input-icon-wrapper">
                                            <i class="fa-regular fa-user input-icon"></i>
                                            <input type="text" class="form-control" id="senderName" name="name_from"
                                                value="{{ $contact['name'] }}" placeholder="Nguyễn Văn A">
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="senderEmail"> Email người gửi <span
                                                class="required">*</span> </label>
                                        <div class="input-icon-wrapper"><i class="fa-regular fa-envelope input-icon"></i>
                                            <input type="email" class="form-control" id="senderEmail" name="email_from"
                                                placeholder="nguyenvana@email.com" value="{{ $contact['name'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-line mx-4"></div>
                            <!-- Receiver Section -->
                            <div class="p-4 pb-3 pt-3"><span class="section-label mb-3"> <i class="fa-solid fa-users"></i>
                                    Thông
                                    tin người nhận </span>
                                <div class="row mt-3 g-3">
                                    <div class="col-md-6"><label class="form-label" for="receiverName"> Tên người nhận <span
                                                class="required">*</span> </label>
                                        <div class="input-icon-wrapper"><i class="fa-regular fa-user input-icon"></i> <input
                                                type="text" class="form-control" id="receiverName" name="name_to"
                                                placeholder="Trần Thị B" value="{{ $contact['name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="receiverEmail"> Email người nhận
                                            <span class="required">*</span> </label>
                                        <div class="input-icon-wrapper"><i class="fa-regular fa-envelope input-icon"></i>
                                            <input type="email" class="form-control" id="receiverEmail" name="email_to"
                                                placeholder="tranthib@email.com" value="{{ $contact['email'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-line mx-4"></div>
                            <!-- Email Content Section -->
                            <div class="p-4 pb-3 pt-3"><span class="section-label mb-3"> <i class="fa-solid fa-pen-nib"></i>
                                    Nội
                                    dung email </span>
                                <div class="mt-3 mb-3">
                                    <label class="form-label" for="emailGreeting">
                                        Phần mở đầu
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-regular fa-comment-dots input-icon" style="top:28%"></i>
                                        <textarea class="form-control" id="emailGreeting" name="email_greeting" rows="3"
                                            placeholder="Kính gửi Quý khách hàng, Cảm ơn quý khách đã liên hệ với chúng tôi...">
                                        </textarea>
                                        <div id="mail_opening" type="submit" class="btn btn-send mt-2">
                                            <i class="fa-solid fa-brain me-2"></i>AI gợi ý
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="emailBody">
                                        Phần nội dung chính
                                        <span class="required">*</span>
                                    </label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-regular fa-file-lines input-icon" style="top:16%"></i>
                                        <textarea class="form-control" id="emailBody" name="email_body" rows="6"
                                            placeholder="Nhập nội dung phản hồi chi tiết cho khách hàng tại đây...">
                                        </textarea>
                                        <div type="submit" class="btn btn-send mt-2">
                                            <i class="fa-solid fa-brain me-2"></i>AI gợi ý
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-line mx-4"></div>
                            <div class="p-4">
                                <div class="info-tip mb-4">
                                    <div class="d-flex gap-2 align-items-start"><i
                                            class="fa-solid fa-circle-info mt-1"></i>
                                        <p>Email sẽ được gửi từ hệ thống với thông tin người gửi đã nhập. Vui lòng kiểm tra
                                            kỹ
                                            nội dung trước khi gửi.</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap gap-3 justify-content-end">
                                    <button type="reset" class="btn btn-reset">
                                        <i class="fa-solid fa-rotate-left me-2"></i>Đặt lại
                                    </button>
                                    <button type="submit" class="btn btn-send">
                                        <i class="fa-solid fa-paper-plane me-2"></i>Gửi Email
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal Overlay -->
    <div class="modal-backdrop-custom d-none">
        <div class="loading-modal">
            <div class="spinner-ring">
                <div class="outer"></div>
                <div class="inner"></div>
                <i class="fas fa-database icon-center"></i>
            </div>
            <div class="loading-title" id="loadingTitle">
                Đang tạo dữ liệu...
            </div>
            <div class="loading-subtitle">
                Vui lòng đợi trong giây lát, hệ thống đang xử lý yêu cầu
                của bạn.
            </div>
            <div class="progress-track">
                <div class="progress-fill"></div>
            </div>
            <div class="loading-dots">
                <span></span> <span></span> <span></span>
            </div>
        </div>
    </div>
    <script>
        // const customerName = <?php echo json_encode($contact['name']); ?>
        // const customerEmail = <?php echo json_encode($contact['email']); ?>

        const customerName = <?php echo json_encode($contact['name'] ?? ''); ?>;
        const customerEmail = <?php echo json_encode($contact['email'] ?? ''); ?>;
        const customerProblem = <?php echo json_encode($contact['message'] ?? ''); ?>;



        // const customerProblem = <?php echo json_encode($contact['message']); ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ route('storage/assets/js/admins/mail.js') }}"></script>
@endsection
