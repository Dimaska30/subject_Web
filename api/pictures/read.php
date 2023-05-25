<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/pictures.php";

$database = new Database();
$db = $database->getConnection();

$picture = new Pictures($db);

$stmt = $picture->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $pictures_arr = array();
    $pictures_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $picture_item = array(
            "ID" => $ID,
            "ID_post" => $ID_post,
            "picture" => $picture
        );
        array_push($pictures_arr["records"], $picture_item);
    }
    http_response_code(200);
    echo json_encode($pictures_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Картинки не найдены."), JSON_UNESCAPED_UNICODE);
}
