<section class="article-wrapper --shadow --watch_more">
            <article class="article --papper_effect">
                <h2 class="article__title"><?=$article["title"];?></h2>
                <div class="article__wrapper-img">
                    <img class="article__img" width="240px" height="180px" alt="article image"
                        src=<?="./images/".$article['main_picture'];?> />
                </div>
                <p class="article__text"> <?=$article["body"];?> </p>
                <a href="#openModal" class="infograpics_wrapper">
                    <?php 
                        foreach($images as $img){
                        echo '<img class="infograpics_wrapper__img" width="120px" height="90px" alt="article image" desc="1" src="./images/' . $img['picture'] . `"  onclick="choose(this.src, this.alt, this.getAttribute('desc'))" />`;
                        }
                    ?>
                </a>
                <div class="reaction">
                    <div>
                        <i class="<?=$reaction=="lol"? "fa-solid": "fa-regular";?> fa-face-grin-squint-tears" onclick="face_grin_squint_tears(event)"></i>
                        <i class="<?=$reaction=="smile"? "fa-solid": "fa-regular";?> fa-face-smile" onclick="face_smile(event)"></i>
                        <i class="<?=$reaction=="sad"? "fa-solid": "fa-regular";?> fa-face-frown" onclick="face_frown(event)"></i>
                        <i class="<?=$reaction=="cry"? "fa-solid": "fa-regular";?> fa-face-sad-tear" onclick="face_sad_tear(event)"></i>
                    </div>
                    <div>
                        <i class="<?=$like;?> fa-heart --red" onclick="like(event)"></i>
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
            <script src="js/my_js.js" type="text/javascript"></script>
            <script type="text/javascript">
                var data_base_like = "<?=$like;?>";

                var data_base_reaction = "<?=$reaction;?>";
            </script>
</section>