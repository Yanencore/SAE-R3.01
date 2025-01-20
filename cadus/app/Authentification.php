<?php

require_once "User.php";
class Authentification {

    private IUserBDD $userBDD;
    public function __construct(IUserBDD $userBDD) {
        $this->userBDD = $userBDD;
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données
     *
     * @param string $nom Nom de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe
     * @param string $repeat Confirmation du mot de passe
     * @return bool
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
     * Authentifie un utilisateur à l'aide de son email et mot de passe.
     *
     * @param string $email Email de l'utilisateur
     * @param string $password Mot de passe
     * @return true true si l'authentification fonctionne
     *
     * @throws \Exception
     */
    public function authenticate(string $email, string $password) : true {
        $user = $this->userBDD->findUserByEmail($email);
        if(!$user || !password_verify($password, $user->getPassword())) {
            throw new \Exception("Mot de pass ou email invalide");
        }
        return true;
    }

    /**
     * Vérifie si un email est invalide.
     *
     * @param string $email Email à vérifier
     * @return bool
     */
    private function invalideEmail(string $email) : bool {
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }


}
