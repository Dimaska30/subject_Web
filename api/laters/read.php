<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/laters.php";

$database = new Database();
$db = $database->getConnection();

$laters = new Laters($db);

$stmt = $laters->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $laters_arr = array();
    $laters_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $laters_item = array(
            "ID" => $ID,
            "ID_post" => $ID_post,
            "ID_user" => $ID_user
        );
        array_push($laters_arr["records"], $laters_item);
    }
    http_response_code(200);
    echo json_encode($laters_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Отложенные посты не найдены."), JSON_UNESCAPED_UNICODE);
}
