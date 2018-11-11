<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
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
    $commenter = wp_get_current_commenter();
	 
	$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => esc_html__( 'Leave a Comment','medix'),
			'title_reply_to'    => esc_html__( 'Leave a Reply To %s','medix'),
			'cancel_reply_link' => esc_html__( 'Cancel Reply','medix'),
			'label_submit'      => esc_html__( 'Send Message','medix'),
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' =>
				'<div class="row"><div class="col-md-4 col-sm-12"><p class="comment-form-author">'.
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" aria-required="true" required="required" placeholder="'.esc_html__('FULL NAME','medix').'"/></p></div>',

				'email' =>
				'<div class="col-md-4 col-sm-12"><p class="comment-form-email">'.
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" required="required" placeholder="'.esc_html__('EMAIL ADDRESS','medix').'"/></p></div>',
                
                'phone' =>
				'<div class="col-md-4 col-sm-12"><p class="comment-form-phone">'.
				'<input id="phone" name="phone" type="text" size="30" placeholder="'.esc_html__('PHONE NUMBER','medix').'"/></p></div></div>',
			)
			),
			'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true" required="required" placeholder="'.esc_html__('COMMENT...','medix').'"></textarea></p>',
	);
	comment_form($args);
    ?>
    
	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title heading-heebo">
			<?php
            printf( _nx( '0 Comment ', '%1$s Comments', get_comments_number(), 'comments title', 'medix' ), number_format_i18n( get_comments_number() ));
			?>
		</h4>
 
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 75,
                'callback'          => 'medix_comment',
			) );
			?>
		</ol><!-- .comment-list -->

		<?php medix_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'medix' ); ?></p>
	<?php endif; ?>

	

</div><!-- .comments-area -->
