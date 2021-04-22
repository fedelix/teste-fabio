<?php
class Projeto{
  
    private $conn;
    private $tabelaProjetos = "projetos";
    private $tabelaAtividades = "atividades";
  
    public $projetoId;
    public $projetoNome;
    public $projetoDataInicio;
    public $projetoDataFim;
    public $projetoFinalizado;
    public $atividadeTotal;
    public $atividadeFinalizada;
  
    public function __construct($db){
        $this->conn = $db;
    }

    function listarProjetos() {
  
        $query = "SELECT
                    p.projetoId,
                    p.projetoNome,
                    p.projetoDataInicio,
                    p.projetoDataFim,
                    p.projetoFinalizado,
                    COUNT(a.atividadeFinalizada) as atividadeTotal,
                    SUM(a.atividadeFinalizada) as atividadeFinalizada
                FROM
                    ".$this->tabelaProjetos." p
                LEFT JOIN
                    ".$this->tabelaAtividades." a
				ON 
					p.projetoId = a.projetoId
                GROUP BY
                    p.projetoId
                ORDER BY
                    p.projetoDataFim";
      
        $stmt = $this->conn->prepare($query);
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

}
