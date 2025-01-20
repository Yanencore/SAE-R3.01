<?php
class BddConnect {
    public PDO $pdo;
    protected string $host;
    protected string $login;
    protected string $password;
    protected string $dbname;

    public function __construct() {
        $this->host = "localhost:3306";
        $this->login = "root";
        $this->password = "root";
        $this->dbname = "schema_name";
    }

    public function connexion() : \PDO {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            $this->pdo = new \PDO($dsn, $this->login, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e) {
            die("Erreur de connexion BDD : " . $e->getMessage());
        }

        return $this->pdo;
    }
}
