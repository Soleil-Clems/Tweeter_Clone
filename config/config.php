<?php
if (isset($_GET['uid'])) {
    $r = (int)filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT);
}else{
    $r='';
}
$url="/Tweeter_Clone/";
$urlHomepage="/Tweeter_Clone/homepage";
$urlWelcome="/Tweeter_Clone/welcome";
$urlProfil="/Tweeter_Clone/profil";
$urlOtherProfil="/Tweeter_Clone/profil?uid=$r";
$urlLogin="/Tweeter_Clone/login";
$urlRegister="/Tweeter_Clone/register";
$urlLogout="/Tweeter_Clone/logout";
$url404="/Tweeter_Clone/404";
$urlMessenger="/Tweeter_Clone/messenger";
$urlPost="/Tweeter_Clone/post";
$urlimgProfil="/Tweeter_Clone/imgprofil";
$urlimgBanner="/Tweeter_Clone/imgbanner";
$urlUpdate="/Tweeter_Clone/update";
$urlFollow="/Tweeter_Clone/follow";
$urlTag="/Tweeter_Clone/tag";
$urlShare="/Tweeter_Clone/share";
$urlComment="/Tweeter_Clone/comment";
$urlGetComment="/Tweeter_Clone/getComment";
$urlLike="/Tweeter_Clone/like";
$urlSearch="/Tweeter_Clone/explore";