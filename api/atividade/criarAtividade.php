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
  
$data = json_decode(file_get_contents("php://input"));
  
if (
    !empty($data->projetoId) &&
    !empty($data->atividadeNome) &&
    !empty($data->atividadeDataInicio) &&
    !empty($data->atividadeDataFim)
) {
  
    $atividade->projetoId = $data->projetoId;
    $atividade->atividadeNome = $data->atividadeNome;
    $atividade->atividadeDataInicio = $data->atividadeDataInicio;
    $atividade->atividadeDataFim = $data->atividadeDataFim;
  
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