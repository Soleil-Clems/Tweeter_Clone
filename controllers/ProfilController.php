<?php
include_once "./models/ProfilModel.php";

class ProfilController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProfilModel();
    }

    public function getProfilController()
    {
        if (isset($_GET['uid'])) {
            $users = $this->model->getProfilModel();
        }else{
            $users = $_SESSION["user"];

        }
        $hashtagController = new HashtagController();
        $hashtags = $hashtagController->getHashtagController();

        $myPostController = new TweetController();
        $myPosts = $myPostController->getAllMyTweetController();

        $myRetweet = $myPostController->getAllMyRetweetController();
        
        $UserController = new UserController();
        $suggested = $UserController->getUserController();

        $FollowController = new FollowController();
        $follow = $FollowController->getFollowController();

        include(__DIR__ . '/../views/profil.php');
    }

    public function setProfilImgController()
    {

        if (myVerify($_FILES["profil"])) {
            $file = $_FILES["profil"];

            if ($file['error'] == 0) {

                $fileName = $file['name'];
                $fileTmp = $file["tmp_name"];
                $extensionArr = explode(".", $file["name"]);
                $extension = strtolower(end($extensionArr));
                $allowedExtension = ['jpg', 'jpeg', 'png'];

                if (in_array($extension, $allowedExtension)) {
                    $uid = $_SESSION['user']["id"];
                    $newImg = md5(uniqid('', true)) . "." . $extension;
                    $fileDestination = "./uploads/" . $newImg;



                    $profileModel = new ProfilModel();
                    $img = $profileModel->setProfilImgModel($uid, $fileTmp, $fileDestination);

                    if ($img) {
                        $_SESSION['user']["profil"] = $fileDestination;
                    }

                    header('Content-Type: application/json');
                    echo json_encode(array("success" => true, "message" => $img));
                }
            }
        }
    }

    public function setBannerImgController()
    {

        if (myVerify($_FILES["banner"])) {
            $file = $_FILES["banner"];

            if ($file['error'] == 0) {

                $fileName = $file['name'];
                $fileTmp = $file["tmp_name"];
                $extensionArr = explode(".", $file["name"]);
                $extension = strtolower(end($extensionArr));
                $allowedExtension = ['jpg', 'jpeg', 'png'];

                if (in_array($extension, $allowedExtension)) {
                    $uid = $_SESSION['user']["id"];
                    $newImg = md5(uniqid('', true)) . "." . $extension;
                    $fileDestination = "./uploads/" . $newImg;



                    $profileModel = new ProfilModel();
                    $img = $profileModel->setBannerImgModel($uid, $fileTmp, $fileDestination);

                    if ($img) {
                        $_SESSION['user']["banner"] = $fileDestination;
                    }

                    header('Content-Type: application/json');
                    echo json_encode(array("success" => true, "message" => $img));
                }
            }
        }
    }

    public function updateController(){
        if (myVerify($_POST["username"], $_POST["pseudo"], $_POST["bio"], $_POST["psw"], $_POST["newPsw"], $_POST["cfPsw"])) {
            $userName = myEncrypte($_POST["username"], "str");
            $pseudo = myEncrypte($_POST["pseudo"], "str");
            $bio = myEncrypte($_POST["pseudo"], "str");
            $psw = myEncrypte($_POST["psw"], "psw");
            $newPsw = myEncrypte($_POST["newPsw"], "psw");
            $cfPsw = myEncrypte($_POST["cfPsw"], "psw");
            $nopsw = false;
            if ($_POST["psw"]=="") {
                $nopsw=true;
            }

            if ($cfPsw == $newPsw) {
                $update = $this->model->updateModel($userName, $pseudo, $bio, $psw, $newPsw, $nopsw);
                header('Content-Type: application/json');
                echo json_encode(array("success" => true, "message" => $update));

            }else{
                header('Content-Type: application/json');
                echo json_encode(array("success" => false, "message" => "New password and Confirm password must be same"));

            }

        }else{
            header('Content-Type: application/json');
            echo json_encode(array("success" => true, "message" => "An error Occured"));

        }
        
    }
    
}
