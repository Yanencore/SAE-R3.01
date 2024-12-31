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
}
