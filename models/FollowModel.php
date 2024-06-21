<?php

include_once "./config/Db.php";

class FollowModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function followModel($targetId, $option)
    {
        $conn = $this->db;

        // Récupérer l'ID de l'utilisateur actuel depuis la session
        $uid = $_SESSION['user']['id'];

        try {
            $conn->beginTransaction();

            // Vérifier si l'utilisateur suit déjà la cible
            $query = "SELECT * FROM follow WHERE user_id = :uid";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Récupérer les informations de suivi de la cible
            $query2 = "SELECT * FROM follow WHERE user_id = :targetId";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bindParam(":targetId", $targetId, PDO::PARAM_INT);
            $stmt2->execute();
            $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            if ($result && $result2) {
                if ($option) {
                    // L'utilisateur souhaite suivre la cible
                    $following = explode(',', $result['following']);
                    $follower = explode(',', $result2['follower']);

                    if (!in_array($targetId, $following)) {
                        array_push($following, $targetId);
                        $following = implode(",", $following);

                        // Mettre à jour la liste des suivis de l'utilisateur actuel
                        $queryUpdateFollowing = "UPDATE follow SET following = :following WHERE user_id = :uid";
                        $stmtUpdateFollowing = $conn->prepare($queryUpdateFollowing);
                        $stmtUpdateFollowing->bindParam(":following", $following);
                        $stmtUpdateFollowing->bindParam(":uid", $uid, PDO::PARAM_INT);
                        $stmtUpdateFollowing->execute();
                    } else {
                        return "Déjà suivi";
                    }

                    if (!in_array($uid, $follower)) {
                        array_push($follower, $uid);
                        $follower = implode(",", $follower);

                        // Mettre à jour la liste des abonnés de la cible
                        $queryUpdateFollower = "UPDATE follow SET follower = :follower WHERE user_id = :targetId";
                        $stmtUpdateFollower = $conn->prepare($queryUpdateFollower);
                        $stmtUpdateFollower->bindParam(":follower", $follower);
                        $stmtUpdateFollower->bindParam(":targetId", $targetId, PDO::PARAM_INT);
                        $stmtUpdateFollower->execute();
                    } else {
                        return "Déjà suivi";
                    }

                    // Après la mise à jour, récupérer à nouveau les données de suivi
                    $UserController = new UserController();
                    return $UserController->getUserController();
                } else {
                    // L'utilisateur souhaite ne pas suivre la cible
                    $refused = explode(',', $result['refused']);

                    if (!in_array($targetId, $refused)) {
                        array_push($refused, $targetId);
                        $refused = implode(",", $refused);

                        // Mettre à jour la liste des refusés par l'utilisateur actuel
                        $queryUpdateRefused = "UPDATE follow SET refused = :refused WHERE user_id = :uid";
                        $stmtUpdateRefused = $conn->prepare($queryUpdateRefused);
                        $stmtUpdateRefused->bindParam(":refused", $refused);
                        $stmtUpdateRefused->bindParam(":uid", $uid, PDO::PARAM_INT);
                        $stmtUpdateRefused->execute();
                        return $refused;
                    } else {
                        return "Déjà refusé";
                    }
                }
            }

            $conn->commit();
        } catch (PDOException $e) {
            $conn->rollBack();
            return "Erreur : " . $e->getMessage();
        }

        return "Erreur de récupération des données de suivi.";
    }

    public function getFollowModel()
    {
        // Récupérer l'ID de l'utilisateur actuel depuis la session ou via un paramètre sécurisé
        $uid = isset($_GET["uid"]) ? myEncrypte($_GET["uid"], "int") : $_SESSION['user']['id'];

        $query = "SELECT follower, following FROM follow WHERE user_id = :uid";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $followings = $result['following'] ? $result['following'] : '';
            $followers = $result['follower'] ? $result['follower'] : '';

            if ($followings) {
                $ids = explode(',', $followings);
                $placeholders = str_repeat('?,', count($ids) - 1) . '?';
                $query = "SELECT id, username, pseudo, profil FROM users WHERE id IN ($placeholders)";
                $stmt = $this->db->prepare($query);
                $stmt->execute($ids);
                $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $followings = [];
            }

            if ($followers) {
                $ids = explode(',', $followers);
                $placeholders = str_repeat('?,', count($ids) - 1) . '?';
                $query = "SELECT id, username, pseudo, profil FROM users WHERE id IN ($placeholders)";
                $stmt = $this->db->prepare($query);
                $stmt->execute($ids);
                $followers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $followers = [];
            }

            return [$followers, $followings];
        }

        return [[], []];
    }
}
