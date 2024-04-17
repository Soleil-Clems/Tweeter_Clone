<?php

include_once "./config/Db.php";
class TweetModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTweetModel()
    {
        $query = "SELECT posts.*, COUNT(retweet.id) AS 'share', users.username, users.pseudo, users.profil FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN retweet ON posts.id = retweet.post_id GROUP BY posts.id";
        $stmt = $this->db->query($query);
        $allPost =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        shuffle($allPost);
        return $allPost;
    }

    public function getAllMyTweetModel($uid)
    {

        $query = "SELECT posts.*, COUNT(retweet.id) AS 'share', COUNT(reaction.id_post) AS 'like', users.username, users.pseudo, users.profil FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN retweet ON posts.id = retweet.post_id LEFT JOIN reaction ON posts.id = reaction.id_post WHERE users.id = $uid GROUP BY posts.id";
        $stmt = $this->db->query($query);
        $myPost = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $myPost;
    }
    public function getAllMyRetweetModel($uid)
    {

        $query = "SELECT retweet.*, user1.username AS username, user1.id AS userid, user1.pseudo AS userpseudo, user1.profil AS userprofil, user2.username AS retweeterusername, user2.id AS retweeterid, user2.pseudo AS retweeterpseudo, user2.profil AS retweeterprofil, posts.media, posts.content FROM retweet JOIN users AS user1 ON retweet.user_id = user1.id JOIN users AS user2 ON retweet.retweeter_id = user2.id JOIN posts ON retweet.post_id = posts.id WHERE user2.id= $uid";
        $stmt = $this->db->query($query);
        $myRetweet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $myRetweet;
    }

    public function setCommentModel($postId, $comment)
    {
        $uid = $_SESSION['user']['id'];
        $query = "INSERT INTO comments(id_post, user_id, comment) VALUES(:id_post, :user_id, :comment)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $uid, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $exec = $stmt->execute();

        if ($exec) {
            $query = "SELECT comments.comment, users.username, users.pseudo, users.id, users.profil FROM comments JOIN users ON comments.user_id = users.id WHERE id_post=$postId";
            $stmt = $this->db->query($query);
            if ($stmt) {
                $comments=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $comments;
            }

        } else {
            return $exec;
        }
    }
    public function setLikeModel($postId)
    {
        $uid = $_SESSION['user']['id'];
        $query = "INSERT INTO reaction(id_post, user_id) VALUES(:id_post, :user_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $uid, PDO::PARAM_STR);
        $exec = $stmt->execute();

        if ($exec) {
            $query = "SELECT COUNT(*) AS 'like' FROM reaction WHERE id_post=$postId";
            $stmt = $this->db->query($query);
            if ($stmt) {
                $react=$stmt->fetch(PDO::FETCH_ASSOC);
                return $react;
            }

        } else {
            return $exec;
        }
    }



    public function postModel($content, $media)
    {
        $uid = $_SESSION["user"]["id"];
        $query = "INSERT INTO posts(user_id, content, media, created_at) VALUES(:id, :content, :media, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $uid, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':media', $media, PDO::PARAM_STR);
        $exec = $stmt->execute();
        if ($exec) {
            $query = "SELECT id AS 'post_id', content, media FROM posts";
            $stmt = $this->db->query($query);
            $allPost =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            shuffle($allPost);
            return $allPost;
        } else {

            return "An error Occured";
        }
    }
}
