<?php
include_once "./models/MessengerModel.php";

class MessengerController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MessengerModel();
    }

    public function getMessengerController()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: homepage");
            
            exit;
        } else {
            $users = $this->model->getMessengerModel();
            
            include(__DIR__ . '/../views/messenger.php');
            exit;
        }
    }
    
}
