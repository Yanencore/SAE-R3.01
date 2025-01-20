<?php

require_once "IUserBdd.php";
class UserBddMySQL implements IUserBDD {

    private PDO $mySqlConnexion;

    public function __construct(\PDO $mySqlConnexion) {
        $this->mySqlConnexion = $mySqlConnexion;
    }



    public function saveUser(User $user) : bool {
        $stmt = $this->mySqlConnexion->prepare(
            "INSERT INTO users (nom,prenom,email,password) VALUES (:nom,:prenom,:email,:password)"
        );

        return $stmt->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
        ]);
    }

    public function findUserByEmail(string $email) : ?User {
        $stmt = $this->mySqlConnexion->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result) {
            return new User($result['nom'],$result['prenom'],$result['email'], $result['password']);
        }
        return null;
    }

    /**
     * Crée un token aléatoire pour un utilisateur et le sauvegarde dans la base.
     * @param string $email Email d'un utilisateur.
     * @return string Token
     * @throws \Random\RandomException
     */
    public function createUserToken(string $email): string{
        $token = bin2hex(random_bytes(32));
        $this->mySqlConnexion->exec("UPDATE users SET token = '$token' WHERE email = '$email'");
        return $token;
    }

    /**
     * Vérifie si l'utilisateur est connecté via les cookies 'email et 'token'
     * @return bool
     */
    public function isUserConnected(): bool{

        if (isset($_COOKIE['email']) && isset($_COOKIE['token'])){
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];

            $stmt = $this->mySqlConnexion->query("SELECT * FROM users WHERE email = '$email' AND token = '$token'");
            $result = $stmt->fetch();
            if ($result)
                return true;
        }
        return false;
    }

    /**
     * Supprime le compte de l'utilisateur connecté.
     */
    public function deteleYourAccount(): void{
        $token = $_COOKIE['token'];
        $this->mySqlConnexion->exec("DELETE FROM users WHERE token ='$token'");
        setcookie("token","",time() - 3600, '/');
        setcookie("email","",time() - 3600, '/');
    }

    /**
     * Récupère l'ID de l'utilisateur connecté.
     * @return int|null
     */
    public function getUserId(): ?int{
        if ($this->isUserConnected()){
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];
            $stmt = $this->mySqlConnexion->query("SELECT * FROM users WHERE email = '$email' AND token = '$token'");
            $result = $stmt->fetch();
            return $result['id'];
        }
        return null;
    }

    /**
     * Vérifie si l'utilisateur a déjà répondu au sondage.
     * @return bool
     */
    public function didTheSurvey(): bool{
        $user_id = $this->getUserId();
        $stmt = $this->mySqlConnexion->prepare("SELECT id FROM sondage WHERE user_id = '$user_id'");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     * @return bool
     */
    public function isAdmin(): bool{
        if ($this->isUserConnected()){
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];
            $stmt = $this->mySqlConnexion->query("SELECT * FROM users WHERE email = '$email' AND token = '$token'");
            $result = $stmt->fetch();
            if($result['isAdmin'] == 1)
                return true;
        }
        return false;
    }

}
