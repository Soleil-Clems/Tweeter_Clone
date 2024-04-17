<?php
@session_start();
include_once "./models/AuthModel.php";
include "./utils/functions.php";
class AuthController
{
    protected $model;
    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function login()
    {

        if (myVerify($_POST['email'], $_POST['psw'])) {
            $email = myEncrypte($_POST['email'], "mail");
            $psw = myEncrypte($_POST['psw'], "psw");

            $success = $this->model->loginUser($email, $psw);
            if ($success) {
                
                header('Content-Type: application/json');
                echo json_encode(array("success" => true, "message" => $success));
            }else{
                header('Content-Type: application/json');
                echo json_encode(array("success" => false, "message" => $success));

            }
            
        } else {
            header('Content-Type: application/json');
            echo json_encode(array("success" => false, "message" => "Champ vide"));
        }
    
    }

    public function register()
    {
        if (myVerify($_POST["username"], $_POST["pseudo"], $_POST["birthday"], $_POST["email"], $_POST["psw"], $_POST['cPsw'])) {

            $username = myEncrypte($_POST["username"], 'str');
            $pseudo = myEncrypte($_POST["pseudo"], 'str');
            $birthday = myEncrypte($_POST["birthday"], "str");
            $email = myEncrypte($_POST["email"], "mail");
            $psw = myEncrypte($_POST["psw"], "psw");
            $cPsw = myEncrypte($_POST["psw"], "psw");

            $age = date_diff(date_create($birthday), date_create('now'))->y;

            if ($age >=18) {
            
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    if (my_password_verify($cPsw, $psw)) {
    
                        $success = $this->model->registerUser($username, $pseudo, $birthday,$email, $psw);
    
                        header('Content-Type: application/json');
                        echo json_encode(array("success" => $success['response'], "message" => $success["message"]));
                    }else{
    
                        header('Content-Type: application/json');
                        echo json_encode(array("success" => false, "message" => "Les mots de passes doivent etre similaires!"));
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array("success" => false, "message" => "Email non valide!"));
                }
            }else{
                header('Content-Type: application/json');
                echo json_encode(array("success" => false, "message" => "L'age dois etre 18+"));

            }

        } else {
            header('Content-Type: application/json');
            echo json_encode(array("success" => false, "message" => "Tous les champs doivent etre remplis!"));
        }
    }



    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: welcome");
        exit;
        
    }

    
}
