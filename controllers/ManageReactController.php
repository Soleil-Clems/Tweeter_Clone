<?php
include_once "./models/ManageReactModel.php";

class ManageReactController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ManageReactModel();
    }

    public function setReactController()
    {
        if (myVerify($_POST['postId'], $_POST["retweeter_id"])) {
            $postId = myEncrypte($_POST['postId'], "int");
            $userId = myEncrypte($_POST['retweeter_id'], "int");

            $result = $this->model->setReactModel($postId, $userId);
            header('Content-Type: application/json');
            echo json_encode(array("success" => true, "message" => $result));
        }
    }
}
