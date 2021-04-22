<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once 'atividades.php';
  
$database = new Database();
$db = $database->getConnection();
  
$atividades = new Atividades($db);

$atividades->projetoId = isset($_GET['id']) ? $_GET['id'] : die();
$stmt = $atividades->listarAtividades();
$num = $stmt->rowCount();
  
if ($num > 0) {
  
    $atividadesArray = array();
    $atividadesArray["records"] = array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $atividadesItem = array(
            "atividadeId" => $atividadeId,
            "projetoId" => $projetoId,
            "atividadeNome" => $atividadeNome,
            "atividadeDataInicio" => $atividadeDataInicio,
            "atividadeDataFim" => $atividadeDataFim,
            "atividadeFinalizada" => $atividadeFinalizada
        );
  
        array_push($atividadesArray["records"], $atividadesItem);
    }
  
    http_response_code(200);
  
    echo json_encode($atividadesArray);
    
} else {

    http_response_code(404);
    echo json_encode(array("message" => "Nenhuma atividade encontrada."));
}