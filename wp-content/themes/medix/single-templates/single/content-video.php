<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('medix-post-single'); ?>>
    <div class="entry-video">
	<?php medix_post_video(); ?>
    </div>
    <div class="entry-wrap">
    	<header class="entry-header">
    
    		<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
    
    		<div class="entry-meta content-justify">
    			<?php medix_post_detail(); ?>
                <?php medix_post_cats(); ?>
    		</div><!-- .entry-meta -->
    	</header><!-- .entry-header -->
    
    
    	<div class="entry-content">
    		<?php
    		/* translators: %s: Name of current post */
    		the_content( sprintf(
    			__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'medix' ),
    			the_title( '<span class="screen-reader-text">', '</span>', false )
    		) );
    
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medix' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    		) );
    		?>
    	</div><!-- .entry-content -->
        <?php medix_entry_footer(); ?>  
    </div>
</article><!-- #post-## -->
