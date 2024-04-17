<?php
include_once "./models/FollowModel.php";

class FollowController
{
    protected $model;

    public function __construct()
    {
        $this->model = new FollowModel();
    }

    public function followController(){
        if (myVerify($_POST["option"],$_POST["id"])) {
            $uid = $_SESSION["user"]['id'];
            $targetId = myEncrypte($_POST['id'], "int");
            $option = myEncrypte($_POST['option'], "str");
            if ($option=="true") {
                $option=true;
            }else{

                $option=false;
            }
            
            $result = $this->model->followModel($uid, $targetId, $option);
            header('Content-Type: application/json');
            echo json_encode(array("success" => true, "message" => $result));
            
        }
    }

    public function getFollowController(){
        $follow =$this->model->getFollowModel();
        $followers = $follow[0];
        $followings = $follow[1];
        return [$followers, $followings];
    }
    
}