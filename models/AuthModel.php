<?php
@session_start();
include_once "./config/Db.php";
class AuthModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }


    public function loginUser($email, $psw)
    {


        $query = "SELECT * FROM users WHERE email = :email AND stay=1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);


            if (my_password_verify($psw, $userData['psw'])) {

                unset($userData['psw']);
                
                $_SESSION["user"] = $userData;
            
                return $userData;
            } else {
                return false;
            }
        } else {

            return false;
        }
    }

    public function registerUser($username, $pseudo, $birthday, $email, $psw, $stay = 1)
    {
        
        $query = "SELECT * FROM users WHERE email = :email OR pseudo = :pseudo AND stay=1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            $query = "INSERT INTO users(username, pseudo, email, psw, birthday, bio, city, profil, banner, stay) VALUES(:username, :pseudo, :email, :psw, :birthday, :bio, :city, :profil, :banner, :stay)";
            $stmt = $this->db->prepare($query);
            $profil = "./uploads/defaultprofil.png";
            $bio = "";
            $city = "";
            $banner = "./uploads/defaultbanner.png";
            $stay = "1";
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':psw', $psw, PDO::PARAM_STR);
            $stmt->bindParam(':stay', $stay, PDO::PARAM_INT);
            $stmt->bindParam(':profil', $profil, PDO::PARAM_STR);
            $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
            $stmt->bindParam(':banner', $banner, PDO::PARAM_STR);

            
            if ($stmt->execute()) {
                $query = "SELECT * FROM users WHERE email = :email  AND stay=1";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();


                if ($stmt->rowCount() > 0) {
                    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                    unset($userData['psw']);
                    $_SESSION["user"] = $userData;
                    $uid = $userData["id"];

                    $query = "INSERT INTO follow(user_id, follower, following) VALUES($uid, '', '')";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute();
                    return array("response" => true, "message" => "get follower");
                }
            } else {
                return array("response" => false, "message" => $stmt->execute());
            }
        } else {

            return array("response" => false,  "message" => "This account exist");
        }
    }
}
