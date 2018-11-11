<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, CMS Theme already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

get_header();
?>
<div id="primary" class="container">
    <main id="main" class="site-main">
        
        <?php
			$terms = get_term_by('slug', get_query_var('gallery_category'), get_query_var('taxonomy'));
			$args = array(
				'post_type' => 'gallery', 
				'posts_per_page' => get_option('posts_per_page'), 
				'orderby' => 'date',
				'tax_query' => array(
				    array(
				      'taxonomy' => 'gallery_category',
				      'field' => 'id',
				      'terms' => $terms->term_id,
				      'include_children' => false
				    )
			  	)
			);
			$gallery_post = new WP_Query($args);
		?>
        <?php if ( $gallery_post->have_posts() ) : ?>
            <div class="cms-grid-gallery cms-gallerys layout1">
                <?php
                $size = 'medix-555-405';
                while ( $gallery_post->have_posts() ){
                    $gallery_post->the_post();
                    ?>
                    <div class="cms-grid-item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="gallery-item mutted-hover text-center" onclick="">
                            <?php 
                                if(has_post_thumbnail() && !post_password_required() && !is_attachment() &&  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false)):
                                    $class = ' has-thumbnail';
                                    $thumbnail = get_the_post_thumbnail(get_the_ID(),$size);
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                    $image_url = esc_url($image[0]);
                                else:
                                    $class = ' no-image';
                                    $thumbnail = '<img src="'.esc_url(get_template_directory_uri().'/assets/images/no-image.jpg').'" alt="'.get_the_title().'" />';
                                    $image_url = esc_url(get_template_directory_uri().'/assets/images/no-image-thumbnail.jpg');
                                endif;
                            ?>
        					<div class="item-media">
        						<div class="cms-grid-media <?php echo esc_attr($class);?>"><?php echo $thumbnail;?></div>
        						<div class="media-links">
        							<div class="links-wrap">
                                        <a class="magic-popups" title="" href="<?php echo esc_url($image_url);?>"></a>
        							</div>
        						</div>
        					</div>
                        </div>
                        <div class="item-title text-center">
        					<span class="categories-links">
                                <?php echo get_the_term_list( get_the_ID(), 'gallery_category', '', ' / ', '' ); ?>
        					</span>
        					<h3>
        						<a class="port-link" href="<?php the_permalink();?>" title="<?php the_title()?>"><?php the_title();?></a>
        					</h3>
        				</div>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php else : ?>
			<?php get_template_part( 'single-templates/content', 'none' ); ?>
		<?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>