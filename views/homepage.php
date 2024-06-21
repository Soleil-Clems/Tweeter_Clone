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
                                <div class="userName"><?= isset($tweet["username"]) ? $tweet["username"] : 'Unknown User' ?></div>
                                <div class="userPost"><?= $tweet["content"] ?></div>
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
                            <div class="commentaire" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-regular fa-comment"></i><span id="commentStat"><?= count($tweet['comments']) ?></span></div>
                            <div class="share" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-solid fa-retweet"></i><span id="shareStat"><?= $tweet["share"] ?></span></div>
                            <div class="reaction" data-target="<?= $tweet["id"] ?>" data-uid="<?= $tweet["user_id"] ?>"><i class="fa-regular fa-heart"></i><span class="reacStat"><?= $tweet["like"] ?></span></div>
                        </div>
                        <div class="commentSection" style="display: none;">
                            <div class="containComment">
                                <?php if (!empty($tweet['comments'])) { ?>
                                    <?php foreach ($tweet['comments'] as $comment) { ?>
                                        <div class="comment" style="margin-block:.5em;">
                                            <a href="#">
                                                <div class="imgProfil rounded"><img src="<?= isset($comment['comment_profil']) ? $comment['comment_profil'] : './assets/favicon.webp' ?>" alt=""></div>
                                            </a>
                                            <div class="boxMsg">
                                                <div class="user">
                                                    <a href="#"><?= $comment['comment_username'] ?></a>
                                                    <a href="#">@<?= $comment['comment_pseudo'] ?></a>
                                                </div>
                                                <div class="contentMsg"><?= $comment['comment'] ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="comment">
                                        <div class="boxMsg">
                                            <div class="contentMsg">No comments yet.</div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="commentForm">
                                <form action="" style="display:flex" method="post" class="postComment" data-target="<?= $tweet["id"] ?>">
                                    <textarea style="background:transparent;color:white; width:75%" placeholder="Comments " id="" cols="30" rows="3" class="com"></textarea>
                                    <input type="submit" style="border-bottom-left-radius: 1px;border-top-left-radius: 1px" class="comP" value="Comment">
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