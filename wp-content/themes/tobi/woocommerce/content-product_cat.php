<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<li class="category-item">
 		<h3 class="category-item__title"><?php echo $category->name; ?></h3>
        <div class="ctgr-img">
            <?php woocommerce_subcategory_thumbnail( $category ); ?>
        </div>
        <a class="category-item__link" href="<?php echo esc_url( get_term_link( $category ) ) ; ?>">Перейти в категорию</a>
</li>
