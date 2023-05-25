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


$request_1;
$title_page;
if($_GET["type"]=="1"){
    $request_1 = $mysqli->query( "SELECT * FROM post INNER JOIN posts_tags_relation ON post.ID = ID_post WHERE ID_tag=".$_GET['tag'] );
    $title_page = 'tag by ID: '.$_GET['tag'];
} else if($_GET["type"]=="2"){
    $request_1 = $mysqli->query( "SELECT * FROM post INNER JOIN (posts_tags_relation INNER JOIN tag ON tag.ID=ID_tag) ON post.ID = ID_post WHERE tag.Name=".$_GET['tagName'] );
    $title_page = $_GET['tagName'];
}else if($_GET["type"]=="3"){
    $request_1 = $mysqli->query( "SELECT * FROM post WHERE title LIKE  '%".$_GET['title']."%'" );
    $title_page = $_GET['title'];
};

$posts = mysqli_fetch_all($request_1, MYSQLI_ASSOC);

// HTML код главной страницы


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
    'template' => $template,
    'turn_on_search' => False,
]);

// вывод на экран итоговой страницы
print($layout_content);
?>