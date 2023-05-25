<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных
include_once "../config/database.php";
include_once "../objects/article.php";
$database = new Database();
$db = $database->getConnection();
$article = new Article($db);

// получаем отправленные данные
$data = json_decode(file_get_contents("php://input"));

// убеждаемся, что данные не пусты
if (
    !empty($data->title) &&
    !empty($data->body) &&
    !empty($data->main_picture) &&
    !empty($data->ID_autor)
) {
    // устанавливаем значения свойств товара
    $article->ID = $data->ID;
    $article->title = $data->title;
    $article->body = $data->body;
    $article->main_picture = $data->main_picture;
    $article->ID_autor = $data->ID_autor;;

    // создание товара
    if ($article->create()) {
        // установим код ответа - 201 создано
        http_response_code(201);

        // сообщим пользователю
        echo json_encode(array("message" => "Товар был создан."), JSON_UNESCAPED_UNICODE);
    }
    // если не удается создать товар, сообщим пользователю
    else {
        // установим код ответа - 503 сервис недоступен
        http_response_code(503);

        // сообщим пользователю
        echo json_encode(array("message" => "Невозможно создать товар."), JSON_UNESCAPED_UNICODE);
    }
}
// сообщим пользователю что данные неполные
else {
    // установим код ответа - 400 неверный запрос
    http_response_code(400);

    // сообщим пользователю
    echo json_encode(array("message" => "Невозможно создать товар. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>