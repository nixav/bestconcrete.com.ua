<div class="left-bar">
    <h2>Каталог</h2>
    <?php 

        wp_nav_menu( array(
        'theme_location' => 'catalog',
        'menu_class'        => 'catalog-menu',
        
    ) );

        $query_args = array(
            'number' => 2,
            'orderby' => 'comment_date',
            'order' => 'DESC',
            'type' => '',
            'status' => 'approve',
        );

        $category_id = get_queried_object()->term_id;
        if(empty(get_term_children($category_id, 'product_cat')) && !is_shop()) {
            echo '<ul class="filter">';
                echo '<h2>' . __('Фильтр') . '</h2>';
            dynamic_sidebar( 'product_filter' );
            echo '</ul>';
        }

        if( $comments = get_comments( $query_args ) ){ ?>
    <div class="feedback">
        <h2>Отзывы</h2>
        <ul class="comment">


            <?php 

                foreach( $comments as $comment ){
                    $comm_author = $comment->comment_author;
                    $comm_link = get_comment_link( $comment->comment_ID ); 
                    $comm_excerpt = mb_substr( strip_tags( $comment->comment_content ), 0, 50 ) .'...';
                    $comm_rating = get_comment_meta( $comment->comment_ID, 'rating', true );


                 ?>
            <li>
                <p class="name">
                    <?php echo $comm_author; ?>
                </p>
                <p class="feedback-text">
                    <?php echo $comm_excerpt; ?>
                </p>
                <div class="feedback-assessment">
                    <ul>
                        <?php 
                            for ($max_rating = 1; $max_rating <= 5; $max_rating++) {
                                if($max_rating <= $comm_rating){
                                    echo '<li><img src="' . TEMPLATE_DIRECTORY_URI . '/img/gold-star.png" alt=""></li>';
                                }else{
                                    echo '<li><img src="' . TEMPLATE_DIRECTORY_URI . '/img/grey-star.png" alt=""></li>';                                        
                                }
                            }
                        ?>
                    </ul>
                    <p><?php echo !empty($comm_rating) ? $comm_rating-- :  '0'; ?> из 5</p>
                </div>
            </li>
            <?php    
                }

                ?>

        </ul>
        <div class="buttons">
            <a href="<?php echo site_url('/feedbacks#comment-form'); ?>">+ Добавить отзыв</a>
            <a href="<?php echo site_url('/feedbacks'); ?>">Все отзывы</a>
        </div>
    </div>


    <?php  }

    ?>

</div>