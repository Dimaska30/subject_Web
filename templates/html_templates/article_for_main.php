
<a class="--shadow" href=<?="http://localhost/article?id=".$post['ID']; ?>>
    <article class="mini_article --papper_effect" id=<?=$post['ID']; ?>>
        <div class="mini_article__wrapper-img">
            <img class="mini_article__img" width="240px" height="180px" alt="article image"
                src=<?='./images/'.$post['main_picture']; ?> />
        </div>
        <h2 class="mini_article__title"><?=$post['title']; ?></h2>
        <p class="mini_article__text"><?= $post['body']; ?></p>
    </article>
</a>
