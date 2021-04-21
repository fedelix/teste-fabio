<?php
class Database{

    private $host = "localhost";
    private $name = "euax";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function getConnection(){
  
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->name, $this->user, $this->pass);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erro ao conectar: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
