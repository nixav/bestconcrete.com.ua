<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' ); ?>

<div id="wrapper-category">


<?php

get_sidebar('left');

?>
<div class="main-container">
	<?php if(is_shop()){ ?>
                <ul class="info-icon">
                    <li>
                        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/delivery.png" alt="">
                        <p>Своевременная доставка</p>
                    </li>
                    <li>
                        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/walet.png" alt="">
                        <p>Оплата по факту доставки или по предоплате</p>
                    </li>
                    <li>
                        <span class="im-left-top-border"></span><span class="im-right-bottom-border"></span>
                        <img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/ua.png" alt="">
                        <p>Доставка во все регионы Украины</p>
                    </li>
                </ul>
                <div class="baner">
                    <a href="#"><img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/baner.png" alt=""></a>
                    <a href="#"><img src="<?php echo TEMPLATE_DIRECTORY_URI; ?>/img/baner2.jpg" alt=""></a>
                </div>
               

<?php } ?>

 				<h1><?php woocommerce_page_title(); ?></h1>
                <a class="price-link" href="#">Скачать прайс</a>

                <form class="search-form" action="<?php echo wc_get_page_permalink( 'shop' ); ?>">

                    <input type="text" name="s" placeholder="Например: ЗК 4.100 звено круглой трубы">
                    <input type="submit" src="img/search-white.png" id="before" value="Поиск" required><label for="before"></label>


                </form>


<?php



if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	//do_action( 'woocommerce_before_shop_loop' );
	?>

	<?php 

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end(); ?>

	<div class="category-information">
		<?php echo term_description(); ?>
	</div>
	
	<?php

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
	?>






 <?php
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

?>

</div>
</div>


<?php
get_footer( 'shop' );
