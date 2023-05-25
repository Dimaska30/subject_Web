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

if (
    !empty($data->ID_post) &&
    !empty($data->ID_user) &&
    !empty($data->Reaction)
) {
    $reaction->ID_post = $data->ID_post;
    $reaction->ID_user = $data->ID_user;
    $reaction->Reaction = $data->Reaction;

    if ($reaction->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Реакция была создана."), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать реакцию."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать реакцию. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>