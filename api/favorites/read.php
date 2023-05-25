<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/favorites.php";

$database = new Database();
$db = $database->getConnection();

$favorites = new Favorites($db);

$stmt = $favorites->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $favorites_arr = array();
    $favorites_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $favorites_item = array(
            "ID" => $ID,
            "ID_post" => $ID_post,
            "ID_user" => $ID_user
        );
        array_push($favorites_arr["records"], $favorites_item);
    }
    http_response_code(200);
    echo json_encode($favorites_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Понравившиеся посты не найдены."), JSON_UNESCAPED_UNICODE);
}
