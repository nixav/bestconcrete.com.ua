<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tobi
 */

get_header();
?>


		<main>
			<div class="feedbacks" id="wrapper">
			<?php
			while ( have_posts() ) :
				the_post();
				echo '<h1>' . get_the_title() . '</h1>';
				echo '<a href="#comment-form">Оставить свой отзыв</a>';

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div>
		</main><!-- #main -->


<?php
get_footer();
