<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/reaction.php";

$database = new Database();
$db = $database->getConnection();

$reaction = new Reaction($db);

$stmt = $reaction->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $reactions_arr = array();
    $reactions_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $reaction_item = array(
            "ID_post" => $ID_post,
            "ID_user" => $ID_user,
            "Reaction" => $Reaction
        );
        array_push($reactions_arr["records"], $reaction_item);
    }
    http_response_code(200);
    echo json_encode($reactions_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Реакции не найдены."), JSON_UNESCAPED_UNICODE);
}
