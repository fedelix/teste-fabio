<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once 'projetos.php';
  
$database = new Database();
$db = $database->getConnection();
  
$projeto = new Projeto($db);

$stmt = $projeto->listarProjetos();
$num = $stmt->rowCount();
  
if ($num > 0) {
  
    $projetoArray = array();
    $projetoArray["records"] = array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $projetoItem = array(
            "projetoId" => $projetoId,
            "projetoNome" => $projetoNome,
            "projetoDataInicio" => $projetoDataInicio,
            "projetoDataFim" => $projetoDataFim,
            "projetoFinalizado" => $projetoFinalizado
        );
  
        array_push($projetoArray["records"], $projetoItem);
    }
  
    http_response_code(200);
  
    echo json_encode($projetoArray);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Nenhum projeto encontrado"));
}