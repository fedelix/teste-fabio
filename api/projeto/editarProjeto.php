<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../database.php';
include_once 'projetos.php';
  
$database = new Database();
$db = $database->getConnection();
  
$projeto = new Projeto($db);

$projeto->projetoId = isset($_POST['projetoId']) ? $_POST['projetoId'] : die();
  
$data = json_decode(file_get_contents("php://input"));
  
if (
    !empty($data->projetoNome) &&
    !empty($data->projetoDataInicio) &&
    !empty($data->projetoDataFim)
) {
  
    $projeto->projetoNome = $data->projetoNome;
    $projeto->projetoDataInicio = $data->projetoDataInicio;
    $projeto->projetoDataFim = $data->projetoDataFim;
  
    if($projeto->editarProjeto()){

        http_response_code(201);
        echo json_encode(array("message" => "Projeto editado com sucesso!"));
    
    } else {
  
        http_response_code(503);
        echo json_encode(array("message" => "Erro ao editar projeto."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Erro ao editar projeto, todos os campos são obrigatórios."));
}