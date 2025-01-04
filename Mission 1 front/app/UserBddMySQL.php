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
     * @throws \Random\RandomException
     */
    public function createUserToken(string $email): string{
        $token = bin2hex(random_bytes(32));
        $this->mySqlConnexion->exec("UPDATE users SET token = '$token' WHERE email = '$email'");
        return $token;
    }

    public function isUserConnected(): bool{

        if (isset($_COOKIE['email']) && isset($_COOKIE['token'])){
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];

            $stmt = $this->mySqlConnexion->query("SELECT * FROM users WHERE email = '$email' AND token = '$token'");
            $result = $stmt->fetch();
            if ($result['id'])
                return true;
        }
        return false;
    }

    public function deteleYourAccount(): void{
        $token = $_COOKIE['token'];
        $this->mySqlConnexion->exec("DELETE FROM users WHERE token ='$token'");
        setcookie("token","",time() - 3600, '/');
        setcookie("email","",time() - 3600, '/');
    }

}
