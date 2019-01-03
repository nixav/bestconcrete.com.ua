<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="wrapper-category" class="good-cart">
	<?php get_sidebar( 'left' ); ?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class('main-good-cart main-container'); ?>>

		<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */

			//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );

			//do_action( 'woocommerce_before_single_product_summary' );
		?>
		
<?php 
				global $product;
			    $attachment_ids = $product->get_gallery_attachment_ids();

			    

?>

				<div class="block-left">
                    <h1 class="goods-name"><?php the_title(); ?></h1>
                    <div class="img-slider">
                        <div class="main-img">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                        </div>
                        <ul class="slider-img-list">
                        <li> <img src="<?php the_post_thumbnail_url(); ?>" alt=""></li>
                        	<?php 

                        	foreach( $attachment_ids as $attachment_id ) {
						        echo '<li> <img src="' . wp_get_attachment_url( $attachment_id ) . '" alt=""></li>';
						    }

                        	?>
                        </ul>
                    </div>
                </div>




                <div class="block-right">
                    <!-- <div class="delivery-and-pay">
                        <button>Доставка и оплата<span><span class="arrow"></span></span></button>
                        <div>
                            Доставка здійснюється тільки по передоплаті. <br><br> Способи доставки:
                            <ul>
                                <li>самовивіз</li>
                                <li>автотранспортом на будівельний майданчик</li>
                                <li>Транспортна компанія НОВА ПОШТА</li>
                                <li>“Ін-Тайм”</li>
                                <li>"ДЕЛІВЕРІ"</li>
                            </ul> <br> Способи оплати:
                            <ul>
                                <li>готівкою</li>
                                <li>безготівковий розрахунок</li>
                            </ul> <br> Регіони доставки:<strong> Україна, всі регіони</strong>
                        </div>
                    </div> -->
                    <div class="price-and-btn">
                        <div class="price-block">
                            <?php _e('Цена:', 'tobi'); ?>
                            <?php if( $product->is_on_sale() ){ ?>
                                        <div class="sale">
                                            <p class="last-price"><span><?php echo $product->get_regular_price(); ?></span> грн</p>
                                            <p class="new-price"><span><?php echo $product->get_sale_price(); ?></span> грн</p>
                                        </div>
                            <?php } else { ?>
                                        <p class="good-price"> <?php echo $product->get_price(); ?> грн</p>
                            <?php } ?>
                        </div>
					<?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

					<?php 
                            if($product->has_attributes()){
                            ?>
                            <div class="charasterisrics">
                            	 <h3><?php _e('Характеристики', 'tobi');?></h3>
                            	<ul>
                                <?php 
                                    $attributes = $product->get_attributes(); 

                                    foreach( $attributes as $attribute ){
                                        $attribute_taxonomy = $attribute->get_taxonomy_object();
                                        $attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
                                        $values = array();
                                        foreach($attribute_values as $attribute_value){
                                            $values[] = $attribute_value->name;
                                        }
                                        echo '<li>' .  wc_attribute_label( $attribute->get_name() ) . '<span>' . join(', ', $values) . '</span></li>';
                                    }
                                
                                ?>
                            	</ul>
                        	</div>
                            <?php 
                                }
                            ?>

                    <h3>Связь с менеджером</h3>
                    <?php echo do_shortcode( '[contact-form-7 id="432" title="Связь с менеджером" html_class="contact-form"]' ); ?>
                </div>

                <h3 class="text-align__center description__title">Описание</h3>
                <div class="good-information">
					<?php echo $product->get_description(); ?>
				</div>
			<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				//do_action( 'woocommerce_single_product_summary' );
				
			?>


		<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			//do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
