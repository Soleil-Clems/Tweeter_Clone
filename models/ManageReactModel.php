<?php
include_once "./config/Db.php";

class ManageReactModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    

    // public function setReactModel($postId,$userId)
    // {
    //     $retweeterId = $_SESSION['user']['id'];
    //     $query = "INSERT INTO retweet(post_id, user_id, retweeter_id) VALUES(:post_id, :user_id, :retweeter_id)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    //     $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    //     $stmt->bindParam(':retweeter_id', $retweeterId, PDO::PARAM_INT);
    //     $exec = $stmt->execute();
    //     if ($exec) {
    //         return "its Work";
    //     }else{
    //         return "NOT Work";

    //     }
        
    // }

    public function setReactModel($postId, $userId)
{
    $reactorId = $_SESSION['user']['id'];

    // Vérifier si l'utilisateur a déjà liké ce post
    $query = "SELECT * FROM reaction WHERE post_id = :post_id AND user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $reactorId, PDO::PARAM_INT);
    $stmt->execute();
    $reaction = $stmt->fetch(PDO::FETCH_ASSOC);
    return $reaction;

    if ($reaction) {
        // Si l'utilisateur a déjà liké le post, supprimer la réaction
        $query = "DELETE FROM reaction WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $reactorId, PDO::PARAM_INT);
        $exec = $stmt->execute();
        if ($exec) {
            return "Like removed";
        } else {
            return "Failed to remove like";
        }
    } else {
        // Si l'utilisateur n'a pas encore liké le post, ajouter la réaction
        $query = "INSERT INTO reaction(post_id, user_id) VALUES(:post_id, :user_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $reactorId, PDO::PARAM_INT);
        $exec = $stmt->execute();
        if ($exec) {
            return "Like added";
        } else {
            return "Failed to add like";
        }
    }
}

}
