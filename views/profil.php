<?php $title = "Profil";
ob_start(); ?>

<div class="suggestion">
    <div class="back"><a href="./homepage"><i class="fa-solid fa-arrow-left"></i></a></div>
    <div class="information">
        <p id="username">The Anonyme</p>
        <p id="postNum">0 posts</p>
    </div>
</div>

<div class="profileInfo">
    <div class="bannerTop">
        <div class="banner">
            <img src="<?= $users["banner"] ?>" alt="Banner">
            <?php if (!isset($_GET["uid"])) { ?>
                <form action="" method="post">
                    <input type="file" name="banner" id="bannerImg" hidden>
                    <label id="labelBan" for="bannerImg"><i class="fa-solid fa-pen-to-square"></i></label>
                </form>
            <?php } ?>
        </div>
        <div class="profilContainer">
            <img src="<?= $users["profil"] ?>" alt="Profile" id="profilImage">
            <?php if (!isset($_GET["uid"])) { ?>
                <form action="" method="post">
                    <input type="file" name="profil" id="profilImg" hidden>
                    <label id="labelProf" for="profilImg"><i class="fa-solid fa-pen-to-square"></i></label>
                </form>
            <?php } ?>
        </div>
        <div class="edit">
            <?php if (!isset($_GET["uid"])) { ?>
                <div id="editBtn" class="links">
                    Edit profile
                </div>
            <?php } else {
                echo "<div style='display:none; z-index:-99999;' class='links'></div>";
            } ?>
        </div>

    </div>
    <div class="technicalInfo">
        <h2><?= $users["username"] ?></h2>
        <p class="thin">@<?= $users["pseudo"] ?></p>
        <div class="joined thin">
            <i class="fa-solid fa-calendar-days"></i>
            <p id="dateJoined">13 Febrary</p>
        </div>
        <div class="follows">
            <p class="thin"><span class="big"><?= count($follow[1]) ?></span> Following</p>
            <p class="thin"><span class="big"><?= count($follow[0]) ?></span> Followers</p>
        </div>

    </div>
    <div class="navLink">
        <ul>
            <li class="links">Posts</li>
            <li class="links">Replies</li>
            <li class="links">Likes</li>
            <li class="links">Follower</li>
            <li class="links">Following</li>
        </ul>
    </div>
</div>

<div id="allTweets">

    <?php
    foreach ($myPosts as $key => $tweet) { ?>
        <div class="tweet">
            <div class="card">
                <div class="headerCard">
                    <div class="userInfo">
                        <div class="imgProfil"><img src="<?= $myPosts[$key]["profil"] ?>" alt=""></div>
                        <div class="infoText">

                            <div class="userName"><?= $myPosts[$key]["username"] ?></div>
                            <div class="userPost">
                                <?= $myPosts[$key]["content"] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mediaCard">
                    <div class="media">
                        <img src="<?= $myPosts[$key]["media"] ?>" alt="">
                    </div>
                </div>
                <div class="footCard">
                    <div class="innerFoot">

                        <div class="commentaire" data-target="<?= $myPost["id"] ?>" data-uid="<?= $myPost["user_id"] ?>"><i class="fa-regular fa-comment"></i><span id="commentStat">233</span></div>
                        <div class="share" data-target="<?= $myPost["id"] ?>" data-uid="<?= $myPost["user_id"] ?>"><i class="fa-solid fa-retweet"></i><span id="shareStat"><?= $myPosts[$key]["share"] ?></span></div>
                        <div class="reaction" data-target="<?= $myPost["id"] ?>" data-uid="<?= $myPost["user_id"] ?>"><i class="fa-regular fa-heart"></i><span id="reacStat">233</span></div>
                    </div>
                    <div class="commentSection" style="display: none;">
                        <div class="comment">
                            <a href="#">
                                <div class="imgProfil rounded"><img src="./assets/favicon.webp" alt=""></div>
                            </a>
                            <div class="boxMsg">
                                <div class="user">
                                    <a href="#">Anonyme</a>
                                    <a href="#">@anonyme</a>

                                </div>
                                <div class="contentMsg">
                                    fghjgnhnjjk
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php } ?>
</div>

<div id="allReTweets" hidden>

    <?php foreach ($myRetweet as $key => $retweet) { ?>

        <div class="tweet">
            <div class="card">
                <div class="headerCard">
                    <div class="userInfo">
                        <div class="imgProfil"><img src="<?= $retweet["retweeterprofil"] ?>" alt=""></div>
                        <div class="infoText">

                            <div class="userName"><?= $retweet["retweeterusername"] ?></div>

                        </div>
                    </div>
                </div>
                <div class="mediaCard">
                    <div class="retweet">
                        <div class="card">
                            <div class="headerCard">
                                <div class="userInfo">
                                    <div class="imgProfil"><img src="./assets/favicon.webp" alt=""></div>
                                    <div class="infoText">

                                        <div class="userName"><?= $retweet["username"] ?></div>
                                        <div class="userPost">
                                            <?= $retweet["content"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mediaCard">
                                <div class="media">
                                    <img src="<?= $retweet["media"] ?>" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="footCard">
                    <div class="innerFoot">

                        <div class="commentaire" data-target="<?= $retweet['post_id'] ?>" data-uid="<?= $retweet['user_id'] ?>"><i class="fa-regular fa-comment"></i><span id="commentStat">233</span></div>
                        <div class="share" data-target="<?= $retweet['post_id'] ?>" data-uid="<?= $retweet['user_id'] ?>"><i class="fa-solid fa-retweet"></i><span id="shareStat">233</span></div>
                        <div class="reaction" data-target="<?= $retweet['post_id'] ?>" data-uid="<?= $retweet['user_id'] ?>"><i class="fa-regular fa-heart"></i><span id="reacStat">233</span></div>
                    </div>
                    <div class="commentSection" style="display: none;">
                            <div class="comment">
                                <a href="#">
                                    <div class="imgProfil rounded"><img src="./assets/favicon.webp" alt=""></div>
                                </a>
                                <div class="boxMsg">
                                    <div class="user">
                                        <a href="#">Anonyme</a>
                                        <a href="#">@anonyme</a>

                                    </div>
                                    <div class="contentMsg">
                                        fghjgnhnjjk
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<div id="allLikes" hidden>
    <h1>All Likes</h1>
</div>

<div id="followers" class="corner" hidden>

    <?php
    foreach ($follow[0] as $key => $follower) { ?>
        <div class="line thinb">
            <a href="./profil?uid=<?= $follower["id"] ?>" class="imgProfil">
                <img src="<?= $follower["profil"] ?>" alt="Profile Picture">
            </a>
            <a href="./profil?uid=<?= $follower["id"] ?>" class="uInfo">
                <p><?= $follower["username"] ?></p>
                <p>@<?= $follower["pseudo"] ?></p>
            </a>
            <div class="follow">
                <div class="followBtn" data-want=true data-target="<?= $follower["id"] ?>">Follow</div>
            </div>
        </div>
    <?php } ?>
</div>

<div id="followings" class="corner" hidden>

    <?php
    foreach ($follow[1] as $key => $following) { ?>
        <div class="line thinb">
            <a href="./profil?uid=<?= $following["id"] ?>" class="imgProfil">
                <img src="<?= $following["profil"] ?>" alt="Profile Picture">
            </a>
            <a href="./profil?uid=<?= $following["id"] ?>" class="uInfo">
                <p><?= $following["username"] ?></p>
                <p>@<?= $following["pseudo"] ?></p>
            </a>
            <div class="follow">
                <div class="followBtn" data-want=true data-target="<?= $following["id"] ?>">Follow</div>
            </div>
        </div>
    <?php } ?>
</div>

<div id="Edit" hidden>
    <div id="editBlock">
        <h3>Edit profile</h3>
        <form action="" method="POST" id="editForm">

            <input class="samein" type="text" name="username" placeholder="Username" id="uName" value="<?= $users["username"] ?>"><br>
            <input class="samein" type="text" name="pseudo" placeholder="pseudo" value="<?= $users["pseudo"] ?>" id="pseudo"><br>
            <textarea name="bio" id="bio" cols="30" rows="3" placeholder="Bio..."><?= $users["bio"] ?></textarea>
            <br>
            <input class="samein" type="password" name="psw" autocomplete="true" placeholder="Actual password" id="actualPass"><br>
            <input class="samein" type="password" name="newPsw" autocomplete="true" placeholder="New password" id="newPass"><br>
            <div class="password-criteria error" hidden>
                <p class="length">Length between 8 to 50</p>
                <p class="numeric">At least 2 numbers</p>
                <p class="maj">At least 2 capital letters</p>
                <p class="min">At least 2 capital lowercase</p>
                <p class="chars">At least 2 capital special characters</p>
            </div>
            <input class="samein" type="password" name="cfPsw" autocomplete="true" placeholder="Confirm password" id="cfPass"><br>


            <input class="same" type="submit" name="updateProfile" value="Update" id="update">
        </form>
    </div>
</div>
<?php if (!isset($_GET["uid"])) { ?>
    <div class="logout">
        <label class="switch">
            <input type="checkbox" id="chooseTheme">
            <span class="slider round"></span>
        </label>
        <a href="./logout"><i class="fa-solid fa-power-off"></i></a>
    </div>
<?php } ?>
<?php
$content = ob_get_clean();
require "layout.php";
?>