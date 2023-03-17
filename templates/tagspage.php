<main class="--shadow">
        <article class="profile_wrapper article --papper_effect --no-fix-size">
            <section id="prifile-article-wrapper">
            <div class="tags_wrapper --fix-size">
                    <?php 
                    foreach($tags as $tag){
                    echo '<a href="/INFOgrapics/search.php?type=1&tag='.$tag['ID'].'">'.$tag['Name']."</a>";
                    }
                ?>
            </div>
                
            </section>
        </article>
</main>