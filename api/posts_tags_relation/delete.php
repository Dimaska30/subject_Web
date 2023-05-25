<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/posts_tags_relation.php";

$database = new Database();
$db = $database->getConnection();

$posts_tags_relation = new Posts_tags_relation($db);
$data = json_decode(file_get_contents("php://input"));
$posts_tags_relation->ID = $data->id;

if ($posts_tags_relation->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "С поста снят тэг"), JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Не удалось убрать тэг с поста"));
}
