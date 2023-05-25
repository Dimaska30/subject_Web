<?php

// HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once "../config/core.php";
include_once "../config/database.php";
include_once "../objects/article.php";

// создание подключения к БД
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$article = new Article($db);

// получаем ключевые слова
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// запрос товаров
$stmt = $article->search($keywords);
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {
    // массив товаров
    $articles_arr = array();
    $articles_arr["records"] = array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлечём строку
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
    // код ответа - 200 OK
    http_response_code(200);

    // покажем товары
    echo json_encode($articles_arr);
} else {
    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // скажем пользователю, что товары не найдены
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
?>