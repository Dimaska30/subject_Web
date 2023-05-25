<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/laters.php";
$database = new Database();
$db = $database->getConnection();
$laters = new Laters($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->ID_post) &&
    !empty($data->ID_user)
) {
    $laters->ID_post = $data->ID_post;
    $laters->ID_user = $data->ID_user;

    if ($laters->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Отложенный пост был создан."), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно создать отложенный пост."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно создать отложенный пост. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>