<?php

include_once "./config/Db.php";
class UserModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    

    public function getUserModel()
    {
        $uid = $_SESSION["user"]["id"];
        $query = "SELECT u.username, u.pseudo, u.profil, u.id FROM users u LEFT JOIN follow f ON u.id = f.user_id WHERE (f.user_id IS NULL OR f.follower NOT LIKE '$uid') AND u.id <> $uid LIMIT 3";
        
        $stmt = $this->db->query($query);

        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}
