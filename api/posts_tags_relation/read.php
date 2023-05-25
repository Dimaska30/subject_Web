<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/posts_tags_relation.php";

$database = new Database();
$db = $database->getConnection();

$posts_tags_relation = new Posts_tags_relation($db);

$stmt = $posts_tags_relation->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $posts_tags_relations_arr = array();
    $posts_tags_relations_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $posts_tags_relation_item = array(
            "ID" => $ID,
            "ID_post" => $ID_post,
            "ID_tag" => $ID_tag
        );
        array_push($posts_tags_relations_arr["records"], $posts_tags_relation_item);
    }
    http_response_code(200);
    echo json_encode($posts_tags_relations_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Связи между тэгами и постами не найдены."), JSON_UNESCAPED_UNICODE);
}
