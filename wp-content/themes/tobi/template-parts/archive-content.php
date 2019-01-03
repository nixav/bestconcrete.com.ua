<li>
    <div class="shadow-blog-mask"></div>
    <img src="<?php tobi_post_thumbnail(); ?>" alt="">
    <h2><?php the_title(); ?></h2>
    <?php 
        global $post;
        $tags = wp_get_post_tags($post->ID);


        ?>
            <div class="blog-tags">
            <?php
                if($tags){
                    foreach($tags as $tag){
                        echo '<span>' . $tag->name . '</span>';
                    }
                }

    ?>
            </div>
    <div class="more-button">
        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
        <a href="<?php the_permalink(); ?>">Подробнее</a>
    </div>
</li>