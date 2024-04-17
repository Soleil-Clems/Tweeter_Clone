<?php

include_once "./config/Db.php";
class HashtagModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getHashtagModel()
    {

        $query = "SELECT * FROM hashtag";
        $stmt = $this->db->query($query);

        $stmt->execute();

        $hashtag = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $hashtag;
    }

    public function getTagModel($tag, $secureTag, $seems)
    {


        $uid = $_SESSION["user"]["id"];

        if ($tag == "@") {

            $query = "SELECT u.username, u.pseudo, u.profil, u.id FROM users u LEFT JOIN follow f ON u.id = f.user_id WHERE (f.user_id IS NULL OR f.following NOT LIKE '$uid' ) AND u.id <> $uid AND u.pseudo LIKE '%$seems%' LIMIT 3;";
        } else {

            $query = "SELECT id, name AS 'pseudo' FROM hashtag WHERE name LIKE '%$seems%'";
        }

        $stmt = $this->db->query($query);

        if ($stmt) {
            $tagged = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tagged;
        } else {

            return false;
        }
    }
}
