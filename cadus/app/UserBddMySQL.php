<?php

require_once "../app/IUserBdd.php";
class UserBddMySQL implements IUserBDD {

    private PDO $mySqlConnexion;
    public function __construct(\PDO $mySqlConnexion) {
        $this->mySqlConnexion = $mySqlConnexion;
    }

    public function saveUser(User $user) : bool {
        var_dump($user);
        $stmt = $this->mySqlConnexion->prepare(
            'insert into users values (nextval(seq_PK_users), :nom, :prenom, :email, :passwd);'
        );
        return $stmt->execute([
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'passwd' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
        ]);
    }

    public function findUserByEmail(string $email) : ?User {
        $stmt = $this->mySqlConnexion->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result) {
            return new User($result['nom'],$result['prenom'],$result['email'], $result['passwd']);
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


}
