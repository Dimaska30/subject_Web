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
$article->ID = $data->ID;

$article->title = $data->title;
$article->body = $data->body;
$article->ID_autor = $data->ID_autor;
$article->main_picture = $data->main_picture;
$article->Public_date = $data->Public_date;

if ($article->update()) {
    http_response_code(200);
    echo json_encode(array("message" => "Товар был обновлён"), JSON_UNESCAPED_UNICODE);
}
else {
    http_response_code(503);
    echo json_encode(array("message" => "Невозможно обновить товар"), JSON_UNESCAPED_UNICODE);
}
