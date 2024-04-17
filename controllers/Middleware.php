<?php
// include_once "./models/UserModel.php";

class Middleware
{
    protected $model;

    public function __construct()
    {
        // $this->model = new UserModel();
    }

    public function isConnect()
    {
        if (isset($_SESSION['user'])) {
            header("Location: homepage");
            exit;
        } else {
                
            include(__DIR__ . '/../views/welcome.php');
            exit;
        }
    }
    
    public function page404(){
        include(__DIR__ . '/../views/404.php');

    }
}
