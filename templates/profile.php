<main class="--shadow">
    <article class="profile_wrapper article --papper_effect --no-fix-size">
        <section class="header-profile">
            <div class="header-profile__avatar">
                <img class="avatar-img" src=<?= "./images/" . $avatar; ?> width="100px" height="100px" />
            </div>
            <div class="header-profile__info">
                <p class="nickname"><?= $nickname; ?></p>
                <p class="email"><?= $Email; ?></p>
                <a href="/any">Change password</a>
            </div>
            <form class="header-profile__buttons">
                <input type="radio" name="block" id="radio-favorite" value="1" checked>
                <label for="radio-favorite">favorite <i class="fa-solid fa-heart --red"></i></label>
                <input type="radio" name="block" id="radio-later" value="2">
                <label for="radio-later">later <i class="fa-solid fa-eye"></i></label>
                <input type="radio" name="block" id="radio-my" value="3">
                <label for="radio-my">my article <i class="fa-solid fa-feather-pointed"></i></label>
            </form>
        </section>
        <section id="prifile-article-wrapper">
            <div id="favorite_block" class="articles_wrapper">
                <div class="articles_block__mini">


                </div>
            </div>
            <div id="later_block" class="articles_wrapper">
                <div class="articles_block__mini">
                </div>
            </div>
            <div id="my_block" class="articles_wrapper">
                <div class="articles_block__mini">

                </div>
            </div>
        </section>
    </article>
    <script src="./js/profile.js" type="text/javascript"></script>
    <template id="article_favorite">
        <div class="--shadow">
            <article class="mini_article --papper_effect">
                <div class="mini_article__wrapper-img">
                    <img class="mini_article__img" width="240px" height="180px" alt="article image" src="" />
                </div>
                <h2 class="mini_article__title"></h2>
                <p class="mini_article__text"></p>
                <button class="favorite_btn" onclick="toggle_click(event, 'like')"><i class="fa-solid fa-heart --red"></i></button>
            </article>
        </div>
    </template>

    <template id="article_leter">
        <div class="--shadow">
            <article class="mini_article --papper_effect --for-profile">
                <div class="mini_article__wrapper-img">
                    <img class="mini_article__img" width="240px" height="180px" alt="article image" src="" />
                </div>
                <h2 class="mini_article__title"></h2>
                <p class="mini_article__text"></p>
                <button class="favorite_btn" onclick="toggle_click(event, 'watch')"><i class="fa-solid fa-minus"></i></button>
            </article>
        </div>
    </template>

    <template id="article_written">
        <div class="--shadow">
            <article class="mini_article --papper_effect --for-profile">
                <div class="mini_article__wrapper-img">
                    <img class="mini_article__img" width="240px" height="180px" alt="article image" src="" />
                </div>
                <h2 class="mini_article__title"></h2>
                <p class="mini_article__text"></p>
                <button class="favorite_btn" onclick="edit(event)"><i class="fa-solid fa-feather-pointed"></i></button>
            </article>
        </div>
    </template>
</main>