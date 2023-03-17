<?php

require_once "functions.php";
// двумерный массив со списком записей
//$items_list = [];
$mysqli = new mysqli( "localhost", "INFOgrapics", "YouAweSomeSite", "infographics" );
            
if ( $mysqli->connect_errno ) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}
            
$mysqli->set_charset( "utf8" );


$row = $mysqli->query( "SELECT * FROM user WHERE ID = 2" );
$user = $row->fetch_assoc(); 

// HTML код главной страницы

$title_page = $user['login'];
$meta_tags = '';
$header = renderTemplate('./templates/header.php', [
    'title_page' => "Профиль",
    'avatar' => './images/out.png',
    'nickname' => $user['login']
]);

$request_1 = $mysqli->query( "SELECT * FROM favorites WHERE ID_user=".$user['ID'] );
$posts_favorites = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

$request_2 = $mysqli->query( "SELECT * FROM laters WHERE ID_user=".$user['ID'] );
$posts_laters = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

$request_1 = $mysqli->query( "SELECT * FROM post WHERE ID_autor=".$user['ID'] );
$posts_written = mysqli_fetch_all($request_1, MYSQLI_ASSOC);



$page_content = renderTemplate('./templates/profile.php', [
    'posts'=>$posts_favorites,
    'avatar'=>$user['Picture'],
    'Email'=>$user["Email"],
    'nickname' => $user['login']
]);
$footer = renderTemplate('./templates/footer.php', []);

$empty_post = [
    "ID" => '0',
    "body" => "",
    "title" => '',
    "main_picture" => ""
];

$template = renderTemplate('./templates/html_templates/article_for_profile.php', [
    'post'=>$empty_post
]);

// окончательный HTML код
$layout_content = renderTemplate('layout.php',[
    'title' => $title_page,
    'meta_tags' => $meta_tags,
    'header' => $header,
    'content' => $page_content,
    'footer' => $footer,
    'template' => $template
]);

// вывод на экран итоговой страницы
print($layout_content);
?>