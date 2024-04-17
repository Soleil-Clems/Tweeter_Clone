<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// include_once "autoload.php";

include_once "./router/Router.php";
include_once "./config/config.php";


$router = new Router();


$router->addRoute("GET", "$urlWelcome", "Middleware@isConnect");
$router->addRoute("GET", "$url404", "Middleware@page404");
$router->addRoute("POST", "$urlLogin", "AuthController@login");
$router->addRoute("POST", "$urlRegister", "AuthController@register");
$router->addRoute("POST", "$urlPost", "TweetController@postController");
$router->addRoute("POST", "$urlimgProfil", "ProfilController@setProfilImgController");
$router->addRoute("POST", "$urlimgBanner", "ProfilController@setBannerImgController");
$router->addRoute("POST", "$urlUpdate", "ProfilController@updateController");
$router->addRoute("POST", "$urlFollow", "FollowController@followController");
$router->addRoute("POST", "$urlTag", "HashtagController@getTagController");
$router->addRoute("POST", "$urlShare", "ManageReactController@setReactController");
$router->addRoute("POST", "$urlComment", "TweetController@setCommentController");
$router->addRoute("POST", "$urlLike", "TweetController@setLikeController");


if (isset($_SESSION["user"])) {
    
    $router->addRoute("GET", "$url", "HomepageController@getHomepageController");
    $router->addRoute("GET", "$urlHomepage", "HomepageController@getHomepageController");
    $router->addRoute("GET", "$urlProfil", "ProfilController@getProfilController");
    $router->addRoute("GET", "$urlOtherProfil", "ProfilController@getProfilController");
    $router->addRoute("GET", "$urlLogout", "AuthController@logout");
    $router->addRoute("GET", "$urlMessenger", "MessengerController@getMessengerController");

    if (isset($_GET['uid'])) {
        
    }
    $router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} else {
    if ($_SERVER['REQUEST_URI']=="$urlLogin" || $_SERVER['REQUEST_URI']=="$urlRegister") {
        $router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }else {
        $router->handleRequest("GET", $urlWelcome);
    }
}
