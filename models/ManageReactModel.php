<?php
include_once "./config/Db.php";

class ManageReactModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    

    public function setReactModel($postId,$userId)
    {
        $retweeterId = $_SESSION['user']['id'];
        $query = "INSERT INTO retweet(post_id, user_id, retweeter_id) VALUES(:post_id, :user_id, :retweeter_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':retweeter_id', $retweeterId, PDO::PARAM_INT);
        $exec = $stmt->execute();
        if ($exec) {
            return "its Work";
        }else{
            return "NOT Work";

        }
        
    }
}
