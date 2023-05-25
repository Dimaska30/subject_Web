<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/reaction.php";

$database = new Database();
$db = $database->getConnection();

$reaction = new Reaction($db);
$data = json_decode(file_get_contents("php://input"));
$reaction->ID_post = $data->ID_post;
$reaction->ID_user = $data->ID_user;
$reaction->Reaction = $data->Reaction;

if ($reaction->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Реакция была обновлёна"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить реакцию"), JSON_UNESCAPED_UNICODE);
}
