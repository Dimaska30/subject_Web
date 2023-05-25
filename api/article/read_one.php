<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// подключение файла для соединения с базой и файл с объектом
include_once "../config/database.php";
include_once "../objects/article.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$article = new Article($db);

// установим свойство ID записи для чтения
$article->ID = isset($_GET["ID"]) ? $_GET["ID"] : die();
// получим детали товара
$article->readOne();

if ($article->title != null) {

    // создание массива
    $article_arr = array(
        "ID" =>  $article->ID,
        "title" => $article->title,
        "body" => $article->body,
        "main_picture" => $article->main_picture,
        "ID_autor" => $article->ID_autor,
        "Public_date" => $article->Public_date
    );

    // код ответа - 200 OK
    http_response_code(200);

    // вывод в формате json
    echo json_encode($article_arr);
} else {
    // код ответа - 404 Не найдено
    http_response_code(404);

    // сообщим пользователю, что такой товар не существует
    echo json_encode(array("message" => "Товар не существует"), JSON_UNESCAPED_UNICODE);
}
?>