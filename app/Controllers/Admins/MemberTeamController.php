<?php

namespace App\Controllers\Admins;

use App\Controller;
use App\Models\MemberTeam;

class MemberTeamController extends Controller
{
    private $memberTeamModel;

    public function __construct()
    {
        parent::__construct();
        $this->memberTeamModel = new MemberTeam();
    }

    public function getAllMemberTeamByCondition($options = [])
    {
        try {
            if (!isset($_SESSION['myAcc'])) {
                redirect('login');
            }

            $memberTeams = $this->memberTeamModel->getAllByCondition($options);

            return $memberTeams;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function inserMemberTeam()
    {
        try {
            $memberIds = $_POST['ids'];
            $route = $this->getCurrentRoute();
            $teamId = $_POST['team_id'];

            $totalIds = count($memberIds);
            $count = 0;

            foreach ($memberIds as $memberIds) {
                $result = $this->memberTeamModel->insert([
                    'team_id' => $teamId,
                    'member_id' => $memberIds
                ]);

                if ($result > 0) ++$count;
            }


            if ($totalIds == $count) {
                $_SESSION['success'] = 'Thao tác thành công!';
                redirect($route);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function deleteMemberTeam()
    {
        try {
            $totalIds = count($_POST['ids']);
            $team_id = $_POST['team_id'];
            $memberTeamIds = $_POST['ids'];
            $count = 0;
            $route = $this->getCurrentRoute();

            foreach ($memberTeamIds as $memberTeamId) {
                $where = [
                    'member_id' => $memberTeamId,
                    'team_id' => $team_id,
                ];

                $result = $this->memberTeamModel->delete($where);
                if ($result > 0) ++$count;
            }

            if ($count == $totalIds) {
                $_SESSION['success'] = 'Xóa thành công';
                redirect($route);
            } else {
                echo $count;
                echo $totalIds;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
