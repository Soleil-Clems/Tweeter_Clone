<?php
include_once "./models/UserModel.php";

class UserController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function getUserController()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: welcome");

            exit;
        } else {
            $suggested= $this->model->getUserModel();
            return $suggested;
            
        }
    }

}
