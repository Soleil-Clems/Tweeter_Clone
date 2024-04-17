<?php

include_once "./config/Db.php";
class ProfilModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getProfilModel()
    {
        if (isset($_GET['uid'])) {
            $uid = (int)filter_var($_GET['uid'], FILTER_SANITIZE_NUMBER_INT);
        }
        $query = "SELECT * FROM users WHERE id=$uid";
        $stmt = $this->db->query($query);

        $stmt->execute();

        $users = $stmt->fetch(PDO::FETCH_ASSOC);

        return $users;
    }

    public function setProfilImgModel($uid, $fileTmp, $fileDestination)
    {
        $query = "UPDATE users SET profil='$fileDestination' WHERE id=$uid";
        $stmt = $this->db->prepare($query);
        $exec = $stmt->execute();
        if ($exec) {
            move_uploaded_file($fileTmp, $fileDestination);
            $_SESSION['user']['profil'] = $fileDestination;
            return $exec;
        } else {
            return false;
        }
    }

    public function setBannerImgModel($uid, $fileTmp, $fileDestination)
    {
        $query = "UPDATE users SET banner='$fileDestination' WHERE id=$uid";
        $stmt = $this->db->prepare($query);
        $exec = $stmt->execute();
        if ($exec) {
            move_uploaded_file($fileTmp, $fileDestination);
            $_SESSION['user']['banner'] = $fileDestination;
            return $exec;
        } else {
            return false;
        }
    }

    public function updateModel($userName, $pseudo,  $bio, $psw, $newPass, $nopsw)
    {
        $uid = $_SESSION['user']["id"];
        $email = $_SESSION['user']["email"];
        $query = "SELECT * FROM users WHERE id = $uid AND email='$email'";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($nopsw) {
            $query = "UPDATE users SET username='$userName', pseudo='$pseudo', bio='$bio' WHERE id=$uid";
        } else {
            if ($row["psw"]==$psw) {
                $query = "UPDATE users SET username='$userName', pseudo='$pseudo', bio='$bio', psw='$newPass' WHERE id=$uid";
            
            }else{
                return "Password Error";
            }
        }
        
        $stmt = $this->db->prepare($query);
        $exec = $stmt->execute();

        if ($exec) {
            $_SESSION["user"]["username"]=$userName;
            $_SESSION["user"]["pseudo"]=$pseudo;
            $_SESSION["user"]["bio"]=$bio;

            return "success";
        }else{
            return "Password Error";
        }

        
    }
}
