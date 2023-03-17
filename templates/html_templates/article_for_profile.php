<?php

$link = "";
if ($type == "like" || $type == "watch")
    $link = "http://localhost/articles/" . $post['ID'];

?>
<a class="--shadow" href=<?= $link; ?>>
    <article class="mini_article --papper_effect">
        <div class="mini_article__wrapper-img">
            <img class="mini_article__img" width="240px" height="180px" alt="article image" src=<?='./images/' . $post['main_picture']; ?> />
        </div>
        <h2 class="mini_article__title">
            <?= $post['title']; ?>
        </h2>
        <p class="mini_article__text"><?= $post['body']; ?></p>
        <?php
        $style;
        $function;
        if ($type == "like") {
            $style = "fa-solid fa-heart --red";
            $function = "toggle_click";
        } else if ($type == "watch") {
            $style = "fa-solid fa-minus";
            $function = "toggle_click";
        } else if ($type == "watch") {
            $style = "fa-solid fa-minus";
            $function = "edit";
        }
        ?>
        <button class="favorite_btn" onclick="<?= $function; ?>(event, <?= $type; ?>)"><i class=<?= $style; ?>></i></button>
    </article>
</a>