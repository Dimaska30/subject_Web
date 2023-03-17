<section class="article-wrapper --shadow --watch_more">
            <article class="article --papper_effect">
                <h2 class="article__title"><?php=$article["title"];?></h2>
                <div class="article__wrapper-img">
                    <img class="article__img" width="240px" height="180px" alt="article image"
                        src=<?php="./images/".$article['main_picture'];?>/>
                </div>
                <p class="article__text"> <?php=$article["body"];?> </p>
                <a href="#openModal" class="infograpics_wrapper">
                    <?php 
                        foreach($images as $img){
                        echo '<img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="1" src="./images/' . $img['picture'] . `"  onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />`;
                        }
                    ?>
                    <img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="1" src="./images/placeholder.png"  onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />
                    <img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="2" src="./images/placeholder1.png" onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />
                    <img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="3" src="./images/placeholder2.png" onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />
                    <img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="4" src="./images/placeholder3.png" onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />
                    <img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="5" src="./images/placeholder4.png" onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />
                </a>
                <div class="reaction">
                    <div>
                        <i class="fa-regular fa-face-grin-squint-tears" onclick="face_grin_squint_tears(event)"></i>
                        <i class="fa-regular fa-face-smile" onclick="face_smile(event)"></i>
                        <i class="fa-regular fa-face-frown" onclick="face_frown(event)"></i>
                        <i class="fa-regular fa-face-sad-tear" onclick="face_sad_tear(event)"></i>
                    </div>
                    <div>
                        <i class="fa-regular fa-heart --red" onclick="like(event)"></i>
                        <div class="share">
                            <i class="fa-solid fa-share-nodes" onclick="share(event)"></i>
                        </div>
                    </div>
                </div>
                <div class="tags_wrapper">
                <?php 
                    foreach($tags as $tag){
                    echo '<a href="/INFOgrapics/search.php?type=1&tag='.$tag['ID'].'">'.$tag['Name']."</a>";
                    }
                ?>
                </div>
            </article>
        </section>