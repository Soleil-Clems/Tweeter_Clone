<?php
include_once "./models/TweetModel.php";
include_once "./utils/functions.php";

class TweetController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TweetModel();
    }

    public function  getAllTweetController(){
        $allPost = $this->model->getAllTweetModel();
        return $allPost;
        
    }

    public function getAllMyTweetController(){
        if (isset($_GET["uid"])) {
            $uid = myEncrypte($_GET["uid"], "int");
        }else{
            $uid = $_SESSION['user']["id"];

        }
        $myPost = $this->model->getAllMyTweetModel($uid);
        return $myPost;
    }

    public function getAllMyRetweetController(){
        if (isset($_GET["uid"])) {
            $uid = myEncrypte($_GET["uid"], "int");
        }else{
            $uid = $_SESSION['user']["id"];

        }
        $myRetweet = $this->model->getAllMyRetweetModel($uid);
        return $myRetweet;
    }

    public function setCommentController(){
        if (myVerify($_POST['postId'], $_POST["comment"])) {
            $postId = myEncrypte($_POST['postId'], "int");
            $comment =$_POST['comment'];
            $success = $this->model->setCommentModel($postId, $comment);
            header('Content-Type: application/json');
            echo json_encode(array("success" =>true , "message" => $success));
        }
    }

    public function setLikeController(){
        if (myVerify($_POST['postId'])) {
            $postId = myEncrypte($_POST['postId'], "int");
            $success = $this->model->setLikeModel($postId);
            header('Content-Type: application/json');
            echo json_encode(array("success" =>true , "message" => $success));
        }
    }

    public function postController()
    {

        if (isset($_POST["content"])) {
            if (myVerify($_POST["content"])) {
                $content = $_POST["content"];
            } else {
                $content = "";
            }
        } else {
            $content = "";
        }

        if (isset($_FILES["media"])) {
            if (myVerify($_FILES["media"])) {
                $file = $_FILES["media"];
                $fileName = $file["name"];
                $fileTmpName = $file["tmp_name"];

                $extensionArr = explode(".",$file["name"]);
                $extension = strtolower(end($extensionArr));
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'avi', 'mov', 'mpg', 'mp2', 'mp3', 'mp4', 'webp'];
                $newImg = md5(uniqid('',true)).".".$extension;

                if (in_array($extension, $allowedExt)) {
                    $destinationPath = './uploads/' . $newImg;

                    
                    if (move_uploaded_file($fileTmpName, $destinationPath)) {
                        $media = $destinationPath;
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(array("success" => false, "message" => "erreur upload"));
                    }
                }
            }
        } else {
            $media = "";
        }
        $success = $this->model->postModel($content, $media);

        if ($success) {
            
            header('Content-Type: application/json');
            echo json_encode(array("success" =>true , "message" => $success));
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("success" =>false , "message" => $success));

        }
    }
}
