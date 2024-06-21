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
            $suggested = $this->model->getUserModel();
            return $suggested;
        }
    }

    public function searchUserController($filter)
    {
        if (!isset($_SESSION['user'])) {
            header("Location: welcome");
            exit;
        } else {
            $results = $this->model->searchUserModel($filter);
            return $results;
        }
    }

    public function getSearchUserController(){
        $hashtagController = new HashtagController();
        $hashtags = $hashtagController->getHashtagController();
        $tweetController = new TweetController();
        $allPost = $tweetController->getAllTweetController();
        $UserController = new UserController();
        $suggested = $UserController->getUserController();
        include(__DIR__ . '/../views/search.php');
    }
}
