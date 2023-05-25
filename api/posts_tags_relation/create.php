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

if (
    !empty($data->ID_post) &&
    !empty($data->ID_tag)
) {
    $posts_tags_relation->ID_post = $data->ID_post;
    $posts_tags_relation->ID_tag = $data->ID_tag;

    if ($posts_tags_relation->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Тэг добавлен к посту."), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить тэг к посту."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить тэг к посту. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>