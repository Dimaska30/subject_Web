<main>
    <section class="articles_wrapper">
        <div class="articles_block">
            <?php

            $n = count($posts) <= 7 ? count($posts) : 7;
            //echo count($posts);
            //echo $n;
            //print_r($posts);
            //$i = 1;
            for ($i = 0; $i < $n; $i++) {
                print renderTemplate('./templates/html_templates/article_for_main.php', [
                    'post'=> $posts[$i]
                ]);
            }
            ;
            ?>
        </div>
    </section>
</main>