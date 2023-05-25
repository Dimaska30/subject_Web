<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/pictures.php";
$database = new Database();
$db = $database->getConnection();
$picture = new Pictures($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->ID_post) &&
    !empty($data->picture)
) {
    $picture->ID_post = $data->ID_post;
    $picture->picture = $data->picture;

    if ($picture->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Картинка была создана."), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать картинку."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать картинку. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>