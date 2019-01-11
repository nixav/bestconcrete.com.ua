<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tobi
 */

get_header();
?>



<?php echo do_shortcode( '[shop_messages]'); ?>

<div class="main-baner">
    <ul>
        <li>
            <h1>Железобетонные изделия <br> от 140 грн/шт.</h1>
            <a clas="make-order" href="#">Сделать заказ <span class="arrow-right"></span></a>
        </li>
        <li>
            <ul>
                <li><img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/main-baner-icon1.png" alt=""><span>Доставка во все регионы Украины</span></li>
                <li><img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/main-baner-icon2.png" alt=""><span>Бесплатная констультация</span></li>
                <li><img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/main-baner-icon3.png" alt=""><span>Широкий спектр услуг</span></li>
            </ul>
        </li>
    </ul>
</div>
<div id="wrapper" class="content-area">
    <main id="main" class="site-main">

        <?php

		$product_cats = get_terms( 'product_cat', array(
//            Отображение определенных категорий по id
//            'include'        => '16', 
            'parent' => 0,
        ) );
        
		if ( !empty($product_cats) ) { ?>
        <h2 class="main-title"><a class="main-title__link" href="#">Каталог</a></h2>
        <ul class="products">

            <?php 
			foreach($product_cats as $category){
                
				?>
            <li class="category-item">
                <h3 class="category-item__title">
                    <?php echo $category->name; ?>
                </h3>
                <div class="ctgr-img">
                    <?php woocommerce_subcategory_thumbnail( $category ); ?>
                </div>
                <a class="category-item__link" href="<?php echo esc_url( get_term_link( $category ) ) ; ?>">Перейти в категорию</a>
                <!--
                Получение id даной категории
                <p>
                    <?php 
//                        echo $category->term_id 
                    ?>
                </p>
                -->
            </li>

            <?php } ?>

        </ul>

        <?php 
		}
		?>




        <?php 
			$query_args = array(
			    'posts_per_page'    => 8,
			    'no_found_rows'     => 1,
			    'post_status'       => 'publish',
			    'post_type'         => 'product',
			    'meta_query'        => WC()->query->get_meta_query(),
			    'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
			);
			$sale_products = new WP_Query( $query_args );

			?>

        <?php
            	if( $sale_products->have_posts() ){
                ?>

        <h2 class="sales-title">Акционные предложения<a href="#">смотреть все →</a></h2>
        <ul class="slick-slider-sales">

            <?php
    				while( $sale_products->have_posts() ){
    				    $sale_products->the_post(); 
                        $product = wc_get_product(get_the_ID());
                        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' )[0];
                        ?>

            <li>
                <a href="<?php echo get_permalink( $product->ID ); ?>" title="<?php the_title(); ?>" class="good-link"><img src="<?php echo $thumbnail_src; ?>" alt=""><span>
                        <?php the_title(); ?></span></a>
                <div class="price-title">
                    <p class="last-price-title">Старая цена</p>
                    <p class="new-price-title">Цена со скидкой</p>
                </div>
                <div class="price">
                    <p class="last-price"><span>
                            <?php echo $product->get_regular_price(); ?></span> грн</p>
                    <p class="new-price"><span>
                            <?php echo $product->get_sale_price(); ?></span> грн</p>
                </div>
                <a href="<?php echo bloginfo( 'url' ) . '?add-to-cart=' . $product->get_id(); ?>" class="buy-btn"><span>+</span><span>В корзину</span></a>
            </li>

            <?php
                    }
                    ?>

        </ul>

        <?php
                }
                ?>
        <?php wp_reset_postdata(); ?>




        <?php
                $query_args = array(
                    'posts_per_page' => 4,
                    'post__in'  => get_option( 'sticky_posts' ),
                );
                $sticky_posts = new WP_Query( $query_args );
                if($sticky_posts->have_posts()){
                ?>

        <h2 class="main-title"><a class="main-title__link" href="#">Блог</a></h2>
        <ul class="mini-blog-block">

            <?php    
                    while($sticky_posts->have_posts()){
                        $sticky_posts->the_post();
                        ?>
            <li>
                <div class="shadow-blog-mask"></div>
                <img src="<?php the_post_thumbnail_url(get_the_ID()); ?>" alt="">
                <h2>
                    <?php the_title(); ?>
                </h2>
                <div class="more-button">
                    <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                    <a href="<?php the_permalink(); ?>">Подробнее</a>
                </div>
            </li>
            <?php
                } 
                ?>

        </ul>
        <?php
            }
            ?>

        <?php wp_reset_postdata(); ?>



        <h2 class="main-title"><a class="main-title__link" href="#">О нас</a></h2>
        <div class="about-us-block">
            <div class="about-us-text">
                <h3>«TOBI BUD»: железобетонные гарантии</h3>
                <p>Компания – не новичок на украинском строительном рынке. Поэтому на вопрос, где купить тротуарную плитку, бордюр, фундамент или надежные перекрытия – ответит TOBI BUD.</p>
                <p>Железобетон – «универсальный солдат» в сфере строительства. Он сочетает в себе несгибаемую крепость арматуры и прочность бетона. Материал с успехом используется в формировании несущих конструкций, воплощении самых дерзких архитектурных решений. Бетонные блоки и другие жб изделия не боятся влаги, долговечны, удобны при монтаже и имеют массу преимуществ перед другими строительными конструкциями.</p>
                <p>Достоинства железобетона неисчислимы:</p>
                <ul>
                    <li>Устойчив к климатическим условиям.</li>
                    <li>Пожаробезопасен.</li>
                    <li>Не подвержен ржавчине.</li>
                    <li>Малочувствителен к механическим повреждениям.</li>
                    <li>Идеален в качестве теплоизоляции.</li>
                </ul>
            </div>
            <div class="about-us-photo">
                <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/about1.jpg" alt="">
                <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/about2.jpg" alt="">
            </div>
            <ul class="about-us-icon">
                <li>
                    <div class="about-us-icon2">
                        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/about-us-icon(2).png" alt="">
                    </div>
                    <strong>Доставка</strong>
                    <p>точно в срок</p>
                </li>
                <li>
                    <div class="about-us-icon1">
                        <span class="im-left-top-border"></span>
                        <span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/about-us-icon(1).png" alt="">
                    </div>
                    <strong>348</strong>
                    <p>довольных клиентов <span>за 2018 год</span></p>
                </li>
                <li>
                    <div class="about-us-icon3">
                        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/about-us-icon(3).png" alt="">
                    </div>
                    <strong>Сертифицированая</strong>
                    <p>продукция</p>
                </li>
            </ul>
        </div>
    </main>
</div>

<?php

get_footer();