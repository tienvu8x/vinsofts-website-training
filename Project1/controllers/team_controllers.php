<?php
session_start();
require_once '../model/team_model.php';
require_once '../libs/functions.php';
class TeamControllers {
    public $team_model;

    public function __construct() {
        $this->team_model = new TeamModel();

    }

    public function IndexTeam() {
        $data = $this->team_model->ListTeam();
        require_once '../view/team/team.php';
    }

    public function DeleteUserAction($data) {
        $this->team_model->DeleteUser($data);
        $data = $this->team_model->ListTeam();
        require_once '../view/team/team.php';
    }
    public function EditTeamAction($data) {
//        var_dump($data);die;
        $data2 = $this->team_model->EditTeamById($data['id']);
//        var_dump($data2);die;
        require_once '../view/team/editteam.php';
    }
    public function UpdateTeamByIdAction($data) {
//        var_dump($data);die;
//        var_dump($data['id']);die;
//        $data2 = $this->team_model->UpdateModel($data);
        if (empty($_FILES['fileToUpload']['name'])) {
//            var_dump($data2);die;
            $this->team_model->UpdateTeamModel($data);
            $data = $this->team_model->ListTeam();
            require_once '../view/team/team.php';
        }
        else {
            $upload = UploadImageTeam($data,$_FILES);
            if ($upload ==1) {
//                var_dump($_FILES['fileToUpload']['name']);die;
                $this->team_model->UpdateTeamModel2($data, $_FILES['fileToUpload']['name']);
                $data = $this->team_model->ListTeam();
                require_once '../view/team/team.php';
            }
            else {
                echo "sai luon";
            }
        }
        require_once '../view/team/team.php';
    }
    public function listAction() {
       echo "hung";
    }
    public function AddNewTeamAction() {
        require_once '../view/addnewteam.php';
    }
    public function ListUserAction($id) {

        $data = $this->team_model->ShowUserByTeamId($id['id']);
        require_once '../view/index.php';
    }
    public function AddNewAction() {
        require_once '../view/addnew.php';
    }
    public function CreateTeamAction($data) {


        $upload = UploadImageTeam($_FILES);
//        var_dump($upload);die;
        if ($upload ==1) {
            $this->team_model->UpdateTeam($data, $_FILES);
            $data = $this->team_model->ListTeam();
            require_once '../view/team/team.php';
        }
        else {

            require_once '../view/addnewteam.php';
        }
    }
    public function DeleteByIdAction($id) {
//        var_dump($id['id']);die;
        $this->team_model->DeleteTeamByIdModel($id['id']);
        $data = $this->team_model->ListTeam();
        require_once '../view/team/team.php';
    }
//    public function CreateAction($data) {
////        var_dump($data);die;
//        if (empty($_FILES['fileToUpload']['name'])) {
////            var_dump($data2);die;
//            $this->team_model->UpdateModel($data2);
//            $data = $this->team_model->ListTeam();
//            require_once '../view/team/team.php';
//        }
//        else {
//            $upload = UploadImage($data2, $_FILES);
//            if ($upload ==1) {
//                $this->team_model->UpdateModel2($data2, $_FILES);
//                $data = $this->team_model->ListTeam();
//                require_once '../view/team/team.php';
//            }
//            else {
//                echo "sai luon";
//            }
//
//        }

//        $data2 = $this->index_model->insertNewUser($data);
//        $data = $this->index_model->index();
//        require_once '../view/index.php';

//    }
    public function UpdateAction($data2) {
//        var_dump($data2);die;
//        var_dump($data2['status']);die;
//        $this->team_model->checkUser($data2['name']);
//
//        var_dump($_FILES);die;
//        var_dump($_FILES['file']['name']);die;
        if (empty($_FILES['fileToUpload']['name'])) {
//            var_dump($data2);die;
            $this->team_model->UpdateUserModel($data2);
            $data = $this->team_model->ListTeam();
            require_once '../view/team/team.php';
        }
        else {
            $upload = UploadImage($data2, $_FILES);
            if ($upload ==1) {
                $this->team_model->UpdateModel2($data2, $_FILES);
                $data = $this->team_model->ListTeam();
                require_once '../view/team/team.php';
            }
            else {
                echo "sai luon";
            }

        }

    }


}

$admin = new TeamControllers();

if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $admin->team_model;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
}else{
    $action = 'index';
}

switch ($action){
    case 'index';
        $admin->IndexTeam();
        break;
    case 'addnew';
        $admin->AddNewAction();
        break;
    case 'create';
        $admin->CreateTeamAction($_REQUEST);
        break;
    case 'list';
        $admin->ListUserAction($_REQUEST);
        break;
    case 'addnewTeam';
        $admin->AddNewTeamAction();
        break;
    case 'deleteUser';
        $admin->DeleteUserAction($_REQUEST);
        break;
    case 'edit';
        $admin->EditTeamAction($_REQUEST);
        break;
    case 'update';
        $admin->UpdateTeamByIdAction($_REQUEST);
        break;
    case 'delete';
        $admin->DeleteByIdAction($_REQUEST);
        break;
    default ;
        $admin->listAction();
        break;
}

?>