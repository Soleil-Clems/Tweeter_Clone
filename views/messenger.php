<?php $title = "Messenger";
ob_start(); ?>
<h1>Messenger</h1>

<div class="userInfo">
    <div class="profileImage">
        <img src="<?= $_SESSION['user']['profil'] ?>" alt="Profile Image">
    </div>
    <div class="userDetails">
        <h2><?= $_SESSION['user']['username'] ?> <span>@<?= $_SESSION['user']['pseudo'] ?></span></h2>
        <p><?= $_SESSION['user']['bio'] ?></p>
        <ul>
            <li><strong>Email:</strong> <?= $_SESSION['user']['email'] ?></li>
            <li><strong>Birthday:</strong> <?= $_SESSION['user']['birthday'] ?></li>
            <li><strong>City:</strong> <?= $_SESSION['user']['city'] ?></li>
            <li><strong>Joined:</strong> <?= $_SESSION['user']['created_at'] ?></li>
        </ul>
    </div>
</div>

<?php

?>

<style>
  
    h1 {
        text-align: center;
        color: #1da1f2;
    }
    .userInfo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;
        padding: 20px;
        /* background-color: #fff; */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .profileImage img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 2px solid #1da1f2;
        margin-right: 20px;
    }
    .userDetails {
        max-width: 600px;
    }
    .userDetails h2 {
        margin: 0;
        font-size: 24px;
    }
    .userDetails h2 span {
        color: #657786;
        font-size: 16px;
    }
    .userDetails p {
        font-size: 16px;
        color: #657786;
    }
    .userDetails ul {
        list-style: none;
        padding: 0;
    }
    .userDetails ul li {
        margin: 10px 0;
        font-size: 16px;
    }
    .userDetails ul li strong {
        color: #1da1f2;
    }
</style>

<?php
$content = ob_get_clean();
require "layout.php";
?>
