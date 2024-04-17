<?php
include_once "./models/HashtagModel.php";

class HashtagController
{
    protected $model;

    public function __construct()
    {
        $this->model = new HashtagModel();
    }

    public function getHashtagController()
    {
        $hastags= $this->model->getHashtagModel();
        return $hastags;
    }
    public function getTagController(){
        if (myVerify($_POST["tag"], $_POST["seems"])) {
            
            $tag = $_POST["tag"];
            $secureTag = myEncrypte($_POST["tag"], 'str');
            $seems = myEncrypte($_POST["seems"], 'str');
            $tagged = $this->model->getTagModel($tag, $secureTag, $seems);
            
            header('Content-Type: application/json');
            echo json_encode(array("success" => true, "message" => $tagged));
        }
    }

}
