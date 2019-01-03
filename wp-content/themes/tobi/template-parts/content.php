<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tobi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('article-page')); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			echo '<div class="article-name">'; 
 			tobi_post_thumbnail();
 			echo '<div class="img-bg"></div>';
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo '</div>';
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
?>
	</header><!-- .entry-header -->

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
	<div class="entry-content article-text">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tobi' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
