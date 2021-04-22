<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../database.php';
include_once 'atividades.php';
  
$database = new Database();
$db = $database->getConnection();
  
$atividade = new Projeto($db);
  
$data = $_POST['dados'];
  
if (
    !empty($data["projetoId"]) &&
    !empty($data["nomeAtividade"]) &&
    !empty($data["atividadeDataInicio"]) &&
    !empty($data["atividadeDataFim"])
) {
  
    $atividade->projetoId = $data["projetoId"];
    $atividade->atividadeNome = $data["nomeAtividade"];
    $atividade->atividadeDataInicio = $data["atividadeDataInicio"];
    $atividade->atividadeDataFim = $data["atividadeDataFim"];
  
    if($atividade->criarAtividade()){

        http_response_code(201);
        echo json_encode(array("message" => "Atividade cadastrada com sucesso!"));
    
    } else {
  
        http_response_code(503);
        echo json_encode(array("message" => "Erro ao cadastrar atividade."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Erro ao cadastrar atividade, todos os campos são obrigatórios."));
}