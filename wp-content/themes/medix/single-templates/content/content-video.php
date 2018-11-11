<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('medix-blog-loop'); ?>>
    <div class="entry-video">
	   <?php medix_post_video(); ?>
    </div>
    <div class="entry-wrap">
    	<header class="entry-header">
    
    		<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
    
    		<div class="entry-meta content-justify">
    
    			<?php medix_archive_detail(); ?>
                <?php medix_archive_cats(); ?>
    
    		</div><!-- .entry-meta -->
    	</header><!-- .entry-header -->
    
    
    	<div class="entry-content">
    		<?php
    		/* translators: %s: Name of current post */
    		echo medix_limit_words(strip_tags(get_the_excerpt()));  
    
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'medix' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    		) );
    		?>
    	</div><!-- .entry-content -->
     
    </div>
</article><!-- #post-## -->
