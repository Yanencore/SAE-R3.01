<?php

require_once "User.php";
class Authentification {

    private IUserBDD $userBDD;
    public function __construct(IUserBDD $userBDD) {
        $this->userBDD = $userBDD;
    }

    /**
     * @throws \Exception
     */
    public function register(string $nom,string $prenom, string $email, string $password, string $repeat) : bool {
        if($password !== $repeat) {
            throw new \Exception("Mots de passe différents");
        }
        if($this->invalideEmail($email)) {
            throw new \Exception("Email invalide");
        }
        if($this->userBDD->findUserByEmail($email)) {
            throw new \Exception("Utilisateur déjà enregistré");
        }

        $user = new User($nom,$prenom,$email, $password);
        return $this->userBDD->saveUser($user);

    }

    /**
     * @throws \Exception
     */
    public function authenticate(string $email, string $password) : true {
        $user = $this->userBDD->findUserByEmail($email);
        if(!$user || !password_verify($password, $user->getPassword())) {
            throw new \Exception("Mot de pass ou email invalide");
        }
        return true;
    }

    private function invalideEmail(string $email) : bool {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }


}
