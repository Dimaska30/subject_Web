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

$request_1 = $mysqli->query( "SELECT * FROM post WHERE ID=".$_GET['id'] );
$posts = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

$request_2 = $mysqli->query( "SELECT * FROM posts_tags_relation WHERE ID_post=".$_GET['id'] );
$tags = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

$request_3 = $mysqli->query( "SELECT * FROM pictures WHERE ID_post=".$_GET['id'] );
$imgs = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

// HTML код главной страницы

$title_page = 'INFOgraphics';
$meta_tags = '';
$header = renderTemplate('./templates/header.php', [
    'title_page' => $title_page,
    'avatar' => './images/'.$user['Picture'],
    'nickname' => $user['login']
]);





$page_content = renderTemplate('./templates/homepage.php', ['posts'=>$posts]);
$footer = renderTemplate('./templates/footer.php', []);

$empty_post = [
    "ID" => '0',
    "body" => "",
    "title" => '',
    "main_picture" => ""
];

$template = renderTemplate('./templates/html_templates/article_for_main.php', [
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