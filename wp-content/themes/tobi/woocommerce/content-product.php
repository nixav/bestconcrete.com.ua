<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>
<li <?php wc_product_class(); ?>>
    <a href="<?php the_permalink(); ?>">
        <img src="<?php echo get_the_post_thumbnail_url( $product->get_id(), 'single_post_thumbnail' ); ?>" alt="">
    </a>
    <div class="name-and-charasteristics">
        <a href="<?php the_permalink(); ?>" class="good-name">
            <?php echo $product->get_title(); ?></a>

        <?php
                if($product->has_attributes()){
                            ?>
                            <ul class="characteristics">
                                <?php 
                                    $attributes = $product->get_attributes();
                                    $first_six_attributes = array_slice($attributes, 0, 6);

                                    foreach( $first_six_attributes as $attribute ){
                                        $attribute_taxonomy = $attribute->get_taxonomy_object();
                                        $attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
                                        $values = array();
                                        foreach($attribute_values as $attribute_value){
                                            $values[] = $attribute_value->name;
                                        }
                                        echo '<li><span>' .  wc_attribute_label( $attribute->get_name() ) . '</span><span>' . join(', ', $values) . '</span></li>';
                                    }
                                
                                ?>
        </ul>
        <?php 
                                }
                            ?>
    </div>
    <div class="add-to-cart-wrap">

        <?php


                            do_action( 'woocommerce_before_add_to_cart_quantity' );

                            woocommerce_quantity_input( array(
                                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                            ) );

                            do_action( 'woocommerce_after_add_to_cart_quantity' );
                            ?>

                            <div class="price-and-btn">
                                <div class="price-block">
                                    <?php if( $product->is_on_sale() ){ ?>
                                                <div class="sale">
                                                    <p class="last-price"><span><?php echo $product->get_regular_price(); ?></span> грн</p>
                                                    <p class="new-price"><span><?php echo $product->get_sale_price(); ?></span> грн</p>
                                                </div>
                                    <?php } else { ?>
                                                <p class="good-price"> <?php echo $product->get_price(); ?> грн</p>
                                    <?php } ?>
                                </div>
                                <?php woocommerce_template_loop_add_to_cart();?>
                            </div>
                        </div>

</li>