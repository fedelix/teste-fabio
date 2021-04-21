<?php
class Atividades{
  
    private $conn;
    private $tabelaAtividades = "atividades";
  
    public $atividadeId;
    public $projetoId;
    public $atividadeNome;
    public $atividadeDataInicio;
    public $atividadeDataFim;
    public $atividadeFinalizada;
  
    public function __construct($db){
        $this->conn = $db;
    }

    function listarAtividades() {

        $query = "SELECT
                    atividadeId, projetoId, atividadeNome, atividadeDataInicio, atividadeDataFim, atividadeFinalizada
                FROM
                    ".$this->tabelaAtividades."
                WHERE 
                    projetoId = :projetoId 
                ORDER BY
                    atividadeDataFim :orderBy";
      
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":projetoId", $this->projetoId);
        $stmt->bindParam(":orderBy", $this->orderBy);
        $stmt->execute();
      
        return $stmt;
    }

    function criarAtividade() {
  
        $query = "INSERT INTO
                    ".$this->tabelaAtividades."
                SET
                projetoId = :projetoId,
                atividadeNome = :atividadeNome,
                atividadeDataInicio = :atividadeDataInicio,
                atividadeDataFim = :atividadeDataFim,
                atividadeFinalizada = 0";
      
        $stmt = $this->conn->prepare($query);

        $this->projetoId = htmlspecialchars(strip_tags($this->projetoId));
        $this->atividadeNome = htmlspecialchars(strip_tags($this->projetoDataInicio));
        $this->atividadeDataInicio = htmlspecialchars(strip_tags($this->projetoDataFim));
        $this->atividadeDataFim = htmlspecialchars(strip_tags($this->atividadeDataFim));
      
        $stmt->bindParam(":projetoId", $this->projetoId);
        $stmt->bindParam(":atividadeNome", $this->atividadeNome);
        $stmt->bindParam(":atividadeDataInicio", $this->atividadeDataInicio);
        $stmt->bindParam(":atividadeDataFim", $this->atividadeDataFim);
      
         if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }

    function editarAtividade() {

        $query = "UPDATE 
                    ".$this->tabelaAtividades."
                SET 
                    projetoId = :projetoId,
                    atividadeNome = :atividadeNome,
                    atividadeDataInicio = :atividadeDataInicio,
                    atividadeDataFim = :atividadeDataFim,
                    atividadeFinalizada = :atividadeFinalizada
                WHERE 
                    atividadeId = :atividadeId";

        $stmt = $this->conn->prepare($query);

        $this->projetoId = htmlspecialchars(strip_tags($this->projetoId));
        $this->atividadeNome = htmlspecialchars(strip_tags($this->projetoDataInicio));
        $this->atividadeDataInicio = htmlspecialchars(strip_tags($this->projetoDataFim));
        $this->atividadeDataFim = htmlspecialchars(strip_tags($this->atividadeDataFim));
      
        $stmt->bindParam(":projetoId", $this->projetoId);
        $stmt->bindParam(":atividadeNome", $this->atividadeNome);
        $stmt->bindParam(":atividadeDataInicio", $this->atividadeDataInicio);
        $stmt->bindParam(":atividadeDataFim", $this->atividadeDataFim);
        $stmt->bindParam(":atividadeId", $this->atividadeId);

        if ($stmt->execute()) {
            return true;
        }
      
        return false;
    }

    function apagarAtividade() {
  
        $query = "DELETE FROM
                    ".$this->tabelaAtividades."
                WHERE 
                    atividadeId = :atividadeId";
      
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":atividadeId", $this->atividadeId);
        $stmt->execute();
      
        if ($stmt->execute()) {
            return true;
        }
      
        return false;
    }
}
