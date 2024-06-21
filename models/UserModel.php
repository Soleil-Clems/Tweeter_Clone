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
        $query = "SELECT u.username, u.pseudo, u.profil, u.id 
                  FROM users u 
                  LEFT JOIN follow f ON u.id = f.user_id 
                  WHERE (f.user_id IS NULL OR f.follower NOT LIKE :uid) 
                  AND u.id <> :uid 
                  LIMIT 3";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function searchUserModel($filter)
    {
        $uid = $_SESSION["user"]["id"];
        $filter = "%" . $filter . "%";  // Ajouter les pourcentages pour la recherche LIKE

        $query = "SELECT u.username, u.pseudo, u.profil, u.id 
                  FROM users u 
                  WHERE (u.username LIKE :filter OR u.pseudo LIKE :filter) 
                  AND u.id <> :uid 
                  LIMIT 10";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
        $stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}
