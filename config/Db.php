<?php

abstract class Db
{
    protected $db;
    private $host = 'localhost';
    private $dbName = 'tweeter_db';
    private $user = 'root';
    private $password = '';

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
            $this->db = new PDO($dsn, $this->user, $this->password); 
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
            throw new \Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }
}