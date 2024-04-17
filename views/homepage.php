<?php $title = "Home";
ob_start();

?>

<div class="suggestion">
    <div id="forYou">For you</div>
    <div id="following">Following</div>
</div>

<div id="userList" style="display: none;"></div>
<div id="allPost">
    <div class="formPost">
        <form action="" method="POST" enctype="multipart/form-data" id="formPost">
            <label for="postContent" class="labelPost">
                <div class="imgProfil"><img src="./assets/favicon.webp" alt=""></div>
                <textarea type="text" name="content" id="postContent" placeholder="What is happening?!" rows="4"></textarea>
                <div class="tag" hidden>
                    <ul id="tagUl">

                    </ul>
                </div>
                <span id="numberCaracter">0/142</span>
            </label>
            <div id="imgPreview">
                <img id="preview" style="display: none;">
            </div>
            <div class="formBottom">
                <label for="postFile"><i class="fa-regular fa-image"></i>
                    <input type="file" id="postFile" name="media">
                </label>
                <input type="submit" value="Post" id="submitPost" name="submitPost">
            </div>
        </form>
    </div>
    <div id="allContent">

        <?php foreach ($allPost as $key => $tweet) { ?>

            <div class="tweet">
                <div class="card">
                    <div class="headerCard">
                        <div class="userInfo">
                            <div class="imgProfil"><img src="<?= $tweet["profil"] ?>" alt=""></div>
                            <div class="infoText">

                                <div class="userName"><?= $tweet["username"] ?></div>
                                <div class="userPost">
                                    <?= $tweet["content"] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mediaCard">
                        <div class="media">
                            <img src="<?= $tweet["media"] ?>" alt="">
                        </div>
                    </div>
                    <div class="footCard">
                        <div class="innerFoot">

                            <div class="commentaire" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-regular fa-comment"></i><span id="commentStat">233</span></div>
                            <div class="share" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-solid fa-retweet"></i><span id="shareStat"><?= $tweet["share"] ?></span></div>
                            <div class="reaction" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-regular fa-heart"></i><span class="reacStat"><?= $tweet["share"] ?></span></div>
                        </div>
                        <div class="commentSection" style="display: none;">
                            <div class="containComment">
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
                            <div class="commentForm">
                                <form action="" method="post" class="postComment" data-target="<?= $tweet["id"] ?>">
                                    <textarea name="" id="" cols="30" rows="3" class="com"></textarea>
                                    <input type="submit" value="Comment">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>

<?php
$content = ob_get_clean();
require "layout.php";
?>