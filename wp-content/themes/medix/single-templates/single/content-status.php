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
<?php
 
$style ='';
if(has_post_thumbnail()){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $image_url = esc_url($image[0]);
    $style = 'style="background-image:url('.$image_url.'); background-size: cover;"';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('medix-post-single'); ?> >

	 
    <div class="entry-wrap" <?php echo $style;?>>
        <div class="entry-inner">
            <?php medix_post_status(); ?>
            <header class="entry-header">
                <div class="status-links"><a href="<?php echo esc_url( get_permalink() ); ?>" title=""><?php echo get_post_format();?></a></div>
        		<div class="entry-meta">
        			<?php medix_post_detail(); ?>
        		</div><!-- .entry-meta -->
        	</header><!-- .entry-header -->
            
        	<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
       </div>
    </div>
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
</article><!-- #post-## -->
