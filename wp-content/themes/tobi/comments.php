<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tobi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>

		<?php the_comments_navigation(); ?>

		<ul class="container">
			<?php
				//Get only the approved comments 
				$args = array(
				    'status' => 'approve'
				);
				 
				// The comment Query
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( $args );
				 
				// Comment Loop
				if ( $comments ) {
				    foreach ( $comments as $comment ) { 
				    	$comm_rating = get_comment_meta( $comment->comment_ID, 'rating', true );
				    	?>
				        <li>
		                    <div class="commentator-info">
		                        <p class="name"><?php echo $comment->comment_author; ?></p>
		                        <ul class="stars">
								<?php 

                                    for ($max_rating = 1; $max_rating <= 5; $max_rating++) {
                                        if($max_rating <= $comm_rating){
                                            echo '<li class="star-plus"></li>';
                                        }else{
                                            echo '<li class="star-minus"></li>';                                        
                                        }
                                    }
                                ?>
		                        </ul>
		                        <p class="assesment"><span><?php echo !empty($comm_rating) ? $comm_rating-- :  '0'; ?></span> из <span>5</span></p>
		                    </div>
		                    <span class="line"></span>
		                    <div class="comment-text">
		                        <?php echo $comment->comment_content; ?>
		                    </div>
		                </li>
					<?php 
				    }
				}
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tobi' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$commenter = wp_get_current_commenter();
	$defaults = array(
		'fields'               => array(
								'author' => '<input id="author" class="feedback-small-input" name="author" type="text" placeholder="' . __('Имя') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' />',
								'email'  => '<input id="email" class="feedback-small-input" placeholder="' . __('E-mail') . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />'
							),
		'id_form'              => 'comment-form',
		'comment_field'        => '<p class="comment-form-comment"><textarea placeholder="' . __('Что вы хотите сказать?') . '" class="feedback-big-input" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
		'title_reply'          => __( 'Оставить отзыв:' ),

		'comment_notes_before' => '',
		'comment_notes_after'  => '',

		'title_reply_before'   => '<h2>',
		'title_reply_after'    => '</h2>',
		'comment_notes_after' => '',
		'class_submit'         => 'feedback-small-input',
		'submit_field'			=> '%1$s %2$s',
		'label_submit' => __('Отправить'),
				);

	add_action('comment_form_before_fields', function(){
		echo '<div class="fb-right-block">';
	});

	add_action('comment_form', function(){
		echo '</div>';
	});

	if(function_exists('wpcr_change_comment_form_defaults')){
		remove_action( 'comment_form_top', 'wpcr_change_comment_form_defaults');
		add_action('comment_form_after_fields', 'wpcr_change_comment_form_defaults');
	}

	comment_form($defaults);
	?>

</div><!-- #comments -->
