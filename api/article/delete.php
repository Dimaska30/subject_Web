<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/article.php";

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$data = json_decode(file_get_contents("php://input"));
$article->ID = $data->id;

if ($article->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Товар был удалён"), JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Не удалось удалить товар"));
}