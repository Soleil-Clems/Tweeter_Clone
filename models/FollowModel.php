<?php

include_once "./config/Db.php";
class FollowModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }


    public function followModel($uid, $targetId, $option)
    {
        $conn = $this->db;
        $uid = $_SESSION['user']['id'];

        $query = "SELECT * FROM follow WHERE user_id= $uid";
        $stmt = $conn->prepare($query);
        $exec = $stmt->execute();

        $query2 = "SELECT * FROM follow WHERE user_id= $targetId";
        $stmt2 = $conn->prepare($query2);
        $exec2 = $stmt2->execute();

        if ($exec) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                if ($option) {

                    $all = explode(',', $result['following']);
                    $all2 = explode(',', $result2['follower']);

                    $back = '';

                    if (!in_array($targetId, $all)) {

                        array_push($all, $targetId);

                        $all = implode(",", $all);
                        $all = ltrim($all, ",");
                        $query = "UPDATE follow SET following = :following WHERE user_id = :iud";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam("iud", $uid);
                        $stmt->bindParam("following", $all);
                        $exec = $stmt->execute();
                    } else {
                        $back = "deja exist";
                    }

                    if (!in_array($uid, $all2)) {

                        array_push($all2, $uid);

                        $all2 = implode(",", $all2);
                        $all2 = ltrim($all2, ",");
                        $query = "UPDATE follow SET follower = :follower WHERE user_id = :iud";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam("iud", $targetId);
                        $stmt->bindParam("follower", $all2);
                        $exec = $stmt->execute();
                    } else {
                        $back = "deja exist";
                    }
                    $UserController = new UserController();
                    $suggested = $UserController->getUserController();
                    return $suggested;
                } else {
                    $all = explode(',', $result['refused']);


                    if (!in_array($targetId, $all)) {

                        array_push($all, $targetId);
                        $all = implode(",", $all);
                        $all = ltrim($all, ",");
                        $query = "UPDATE matchlist SET refused = :refused WHERE user_id = :iud";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam("iud", $uid);
                        $stmt->bindParam("refused", $all);
                        $stmt->execute();
                        return $all;
                    } else {
                        return "deja exist";
                    }
                }
            }
        }
    }

    public function getFollowModel()
    {
        if (isset($_GET["uid"])) {
            $uid = myEncrypte($_GET["uid"], "int");
        }else{
            $uid = $_SESSION['user']["id"];

        }
        $query = "SELECT follower, following FROM follow WHERE user_id=$uid";
        $stmt = $this->db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $followings = $result['following'];
        $followers = $result['follower'];

        $query = "SELECT id, username, pseudo, profil FROM users WHERE id IN ($followings)";
        $stmt = $this->db->query($query);
        if ($stmt) {

            $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $followings = [];
        }

        $query = "SELECT id, username, pseudo, profil FROM users WHERE id IN ($followers)";
        $stmt = $this->db->query($query);
        if ($stmt) {
            $followers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $followers = [];
        }
        return [$followers, $followings];
    }
}
