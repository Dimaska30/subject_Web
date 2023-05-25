<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/favorites.php";
$database = new Database();
$db = $database->getConnection();
$favorites = new Favorites($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->ID_post) &&
    !empty($data->ID_user)
) {
    $favorites->ID_post = $data->ID_post;
    $favorites->ID_user = $data->ID_user;

    if ($favorites->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Понравившийся пост был запомнят."), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно запомнить понравившийся пост."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно запомнить понравившийся пост. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>