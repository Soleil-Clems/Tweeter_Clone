<?php

class HomepageController
{
    

    public function __construct()
    {
        
    }

    public function getHomepageController(){
        $hashtagController = new HashtagController();
        $hashtags = $hashtagController->getHashtagController();
        $tweetController = new TweetController();
        $allPost = $tweetController->getAllTweetController();
        $UserController = new UserController();
        $suggested = $UserController->getUserController();
        include(__DIR__ . '/../views/homepage.php');
    }
}
