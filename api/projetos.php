<?php
class Projeto{
  
    private $conn;
    private $tabelaProjetos = "projetos";
  
    public $projetoId;
    public $projetoNome;
    public $projetoDataInicio;
    public $projetoDataFim;
    public $projetoFinalizado;
  
    public function __construct($db){
        $this->conn = $db;
    }

    function listarProjetos() {
  
        $query = "SELECT
                    projetoId,
                    projetoNome,
                    projetoDataInicio,
                    projetoDataFim,
                    projetoFinalizado
                FROM
                    ".$this->tabelaProjetos."
                ORDER BY
                    projetoDataFim :orderBy";
      
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":orderBy", $this->orderBy);
        $stmt->execute();
      
        return $stmt;
    }

    function criarProjeto() {
  
        $query = "INSERT INTO
                    ".$this->tabelaProjetos."
                SET
                    projetoNome = :projetoNome,
                    projetoDataInicio = :projetoDataInicio,
                    projetoDataFim = :projetoDataFim,
                    projetoFinalizado = 0";
      
        $stmt = $this->conn->prepare($query);

        $this->projetoNome = htmlspecialchars(strip_tags($this->projetoNome));
        $this->projetoDataInicio = htmlspecialchars(strip_tags($this->projetoDataInicio));
        $this->projetoDataFim = htmlspecialchars(strip_tags($this->projetoDataFim));
      
        $stmt->bindParam(":projetoNome", $this->projetoNome);
        $stmt->bindParam(":projetoDataInicio", $this->projetoDataInicio);
        $stmt->bindParam(":projetoDataFim", $this->projetoDataFim);
      
        if ($stmt->execute()) {
            return true;
        }
      
        return false;
          
    }

    function editarProjeto() {

        $query = "UPDATE 
                    ".$this->tabelaProjetos."
                SET 
                    projetoNome = :projetoNome,
                    projetoDataInicio = :projetoDataInicio,
                    projetoDataFim = :projetoDataFim,
                    projetoFinalizado = :projetoFinalizado
                WHERE 
                    projetoId = :projetoId";

        $stmt = $this->conn->prepare($query);

        $this->projetoNome = htmlspecialchars(strip_tags($this->projetoNome));
        $this->projetoDataInicio = htmlspecialchars(strip_tags($this->projetoDataInicio));
        $this->projetoDataFim = htmlspecialchars(strip_tags($this->projetoDataFim));
      
        $stmt->bindParam(":projetoNome", $this->projetoNome);
        $stmt->bindParam(":projetoDataInicio", $this->projetoDataInicio);
        $stmt->bindParam(":projetoDataFim", $this->projetoDataFim);
        $stmt->bindParam(":projetoFinalizado", $this->projetoFinalizado);
        $stmt->bindParam(":projetoId", $this->projetoId);
        
        $stmt->execute();
        
        if ($stmt->execute()) {
            return true;
        }
      
        return false;
    }

    function apagarProjeto() {
  
        $query = "DELETE FROM
                    ".$this->tabelaProjetos."
                WHERE 
                projetoId = :projetoId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":projetoId", $this->projetoId);
        $stmt->execute();
      
        if ($stmt->execute()) {
            return true;
        }
      
        return false;
    }
}
