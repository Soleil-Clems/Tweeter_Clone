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
        // Requête principale pour les tweets, les retweets, et les réactions
        $query = "
        SELECT 
            posts.*, 
            COUNT(DISTINCT retweet.id) AS 'share', 
            COUNT(DISTINCT reaction.id_post) AS 'like', 
            users.username, 
            users.pseudo, 
            users.profil
        FROM 
            posts
        LEFT JOIN 
            users ON posts.user_id = users.id
        LEFT JOIN 
            retweet ON posts.id = retweet.post_id
        LEFT JOIN 
            reaction ON posts.id = reaction.id_post
        GROUP BY 
            posts.id";

        $stmt = $this->db->query($query);
        $allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Préparer une liste des post IDs pour récupérer les commentaires
        $postIds = array_column($allPosts, 'id');

        if (!empty($postIds)) {
            // Requête pour récupérer les commentaires pour tous les posts
            $placeholders = implode(',', array_fill(0, count($postIds), '?'));
            $commentQuery = "
            SELECT 
                comments.id_post, 
                comments.comment,  
                users.id AS comment_user_id, 
                users.username AS comment_username, 
                users.pseudo AS comment_pseudo, 
                users.profil AS comment_profil
            FROM 
                comments
            JOIN 
                users ON comments.user_id = users.id
            WHERE 
                comments.id_post IN ($placeholders)
            ORDER BY 
                comments.id ASC";

            $commentStmt = $this->db->prepare($commentQuery);
            foreach ($postIds as $k => $id) {
                $commentStmt->bindValue(($k + 1), $id, PDO::PARAM_INT);
            }
            $commentStmt->execute();
            $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);


            $commentsByPostId = [];
            foreach ($comments as $comment) {
                $commentsByPostId[$comment['id_post']][] = $comment;
            }


            foreach ($allPosts as &$post) {
                $post['comments'] = isset($commentsByPostId[$post['id']]) ? $commentsByPostId[$post['id']] : [];
            }
        }

        shuffle($allPosts);
        return $allPosts;
    }

    // public function getAllMyTweetModel($uid)
    // {

    //     $query = "SELECT posts.*, COUNT(retweet.id) AS 'share', COUNT(reaction.id_post) AS 'like', users.username, users.pseudo, users.profil FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN retweet ON posts.id = retweet.post_id LEFT JOIN reaction ON posts.id = reaction.id_post WHERE users.id = $uid GROUP BY posts.id";
    //     $stmt = $this->db->query($query);
    //     $myPost = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $myPost;
    // }

    public function getAllMyTweetModel($uid)
    {
        // Requête pour récupérer les tweets de l'utilisateur avec les retweets et réactions associés
        $query = "
    SELECT 
        posts.*, 
        COUNT(retweet.id) AS 'share', 
        COUNT(reaction.id_post) AS 'like', 
        users.username, 
        users.pseudo, 
        users.profil
    FROM 
        posts
    LEFT JOIN 
        users ON posts.user_id = users.id
    LEFT JOIN 
        retweet ON posts.id = retweet.post_id
    LEFT JOIN 
        reaction ON posts.id = reaction.id_post
    WHERE 
        users.id = $uid
    GROUP BY 
        posts.id";

        $stmt = $this->db->query($query);
        $myPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Préparer une liste des IDs de posts pour récupérer les commentaires
        $postIds = array_column($myPosts, 'id');

        if (!empty($postIds)) {
            // Requête pour récupérer les commentaires pour tous les posts de l'utilisateur
            $placeholders = implode(',', array_fill(0, count($postIds), '?'));
            $commentQuery = "
        SELECT 
            comments.id_post, 
            comments.comment,  
            users.id AS comment_user_id, 
            users.username AS comment_username, 
            users.pseudo AS comment_pseudo, 
            users.profil AS comment_profil
        FROM 
            comments
        JOIN 
            users ON comments.user_id = users.id
        WHERE 
            comments.id_post IN ($placeholders)
        ORDER BY 
            comments.id ASC";

            $commentStmt = $this->db->prepare($commentQuery);
            foreach ($postIds as $k => $id) {
                $commentStmt->bindValue(($k + 1), $id, PDO::PARAM_INT);
            }
            $commentStmt->execute();
            $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

            // Regrouper les commentaires par ID de post
            $commentsByPostId = [];
            foreach ($comments as $comment) {
                $commentsByPostId[$comment['id_post']][] = $comment;
            }

            // Ajouter les commentaires à chaque post dans $myPosts
            foreach ($myPosts as &$post) {
                $post['comments'] = isset($commentsByPostId[$post['id']]) ? $commentsByPostId[$post['id']] : [];
            }
        }

        return $myPosts;
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
                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $comments;
            }
        } else {
            return $exec;
        }
    }


    public function getCommentModel($postId)
    {
        $query = "SELECT comments.comment, users.username, users.pseudo, users.id, users.profil FROM comments JOIN users ON comments.user_id = users.id WHERE id_post=$postId";
        $stmt = $this->db->query($query);
        if ($stmt) {
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } else {
            return [];
        }
    }



    public function setLikeModel($postId)
    {
        $uid = $_SESSION['user']['id'];


        $query = "SELECT * FROM reaction WHERE id_post = :id_post AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $uid, PDO::PARAM_INT);
        $stmt->execute();
        $reaction = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reaction) {

            $query = "DELETE FROM reaction WHERE id_post = :id_post AND user_id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $uid, PDO::PARAM_INT);
            $exec = $stmt->execute();

            if ($exec) {

                $query = "SELECT COUNT(*) AS 'like' FROM reaction WHERE id_post = :id_post";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
                $stmt->execute();
                $react = $stmt->fetch(PDO::FETCH_ASSOC);
                return $react;
            } else {
                return "Failed to remove like";
            }
        } else {

            $query = "INSERT INTO reaction(id_post, user_id) VALUES(:id_post, :user_id)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $uid, PDO::PARAM_INT);
            $exec = $stmt->execute();

            if ($exec) {

                $query = "SELECT COUNT(*) AS 'like' FROM reaction WHERE id_post = :id_post";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id_post', $postId, PDO::PARAM_INT);
                $stmt->execute();
                $react = $stmt->fetch(PDO::FETCH_ASSOC);
                return $react;
            } else {
                return "Failed to add like";
            }
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
