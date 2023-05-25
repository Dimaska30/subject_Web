<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/article.php";

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);

$stmt = $article->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $articles_arr = array();
    $articles_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $article_item = array(
            "ID" => $ID,
            "title" => $title,
            "body" => html_entity_decode($body),
            "main_picture" => $main_picture,
            "ID_autor" => $ID_autor,
            "Public_date" => $Public_date
        );
        array_push($articles_arr["records"], $article_item);
    }
    http_response_code(200);
    echo json_encode($articles_arr);
}

else {
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
