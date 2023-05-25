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
$laters->ID = $data->ID;

$laters->ID_post = $data->ID_post;
$laters->ID_user = $data->ID_user;

if ($laters->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Отложенный пост был обновлён"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить отложенный пост"), JSON_UNESCAPED_UNICODE);
}
