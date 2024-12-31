<?php
class User {

    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;

    public function __construct(string $nom, string $prenom, string $email, string $password) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->email = $email;
    }

    public function getNom(): string{return $this->nom;}
    public function getPrenom(): string{return $this->prenom;}
    public function getEmail() : string { return $this->email; }
    public function getPassword() : string { return $this->password; }

}
