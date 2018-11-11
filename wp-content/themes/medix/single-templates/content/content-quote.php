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
<?php
 
$style ='';
if(has_post_thumbnail()){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $image_url = esc_url($image[0]);
    $style = 'style="background-image:url('.$image_url.'); background-size: cover;"';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('medix-blog-loop'); ?> >
 
    <div class="entry-wrap" <?php echo $style;?>>
        <div class="entry-inner">
        	<header class="entry-header">
        		<div class="entry-meta content-justify">
        			<?php medix_archive_detail(); ?>
                    <?php medix_archive_cats(); ?>
        		</div><!-- .entry-meta -->
        	</header><!-- .entry-header -->
            <?php medix_post_quote(); ?>
        </div>
    	<div class="entry-content">
    		<?php
    		  
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
