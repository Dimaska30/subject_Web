<div class="--shadow">
    <header class="--papper_effect">
            <a href="/INFOgrapics/index.php"><img class="logo" src="./images/logo.png"></img></a>
            <h1 class="site_name"><?=$title_page; ?></h1>
            <form class="search">
                <fieldset>
                    <legend>Поиск</legend>
                    <div>
                        <input type="text" placeholder="Напиши, мне, напиши" name="text_search"></input>
                        <div class="search__btn" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></div>
                    </div>
                    <div class="search__checkbox-wrapper">
                        <div>
                            <input type="radio" name="type_search" value="Title" id="type_search_title" value="title" checked/>
                            <label for="type_search_title">Заголовок</label>
                        </div>
                        <div>
                            <input type="radio"  name="type_search" value="tag" id="type_search_tag" value="tag"/>
                            <label for="type_search_tag">Теги</label>
                        </div>
                    </div>
                </fieldset>
            </form>
            <a class="avatar" href="http://localhost/INFOgrapics/profile.php">
                <img class="avatar-img" src=<?= $avatar; ?> width="100%" height="100%" title=<?= $nickname; ?> />
            </a>
            <nav>
                <ol>
                    <li><a>MAIN PAGE</a></li>
                </ol>
            </nav>
    </header>
    <script src="js/header.js" type="text/javascript"></script>
</div>
