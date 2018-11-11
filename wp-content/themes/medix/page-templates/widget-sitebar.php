<?php
/**
 * Template Name: Widget Sitebar
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author Fox
 */

get_header(); ?>

<div id="primary" class="container left-side-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <main id="main" class="site-main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the page content template.
                    get_template_part( 'single-templates/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    // End the loop.
                endwhile;
                ?>

            </main><!-- .site-main -->
        </div>
        <?php if ( is_active_sidebar( 'sidebar-second' ) ) : ?>
        	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 sidebar">
        		<div id="widget-area" class="widget-area sidebar-second" role="complementary">
        
        			<?php dynamic_sidebar( 'sidebar-second' ); ?>
        
        		</div><!-- .widget-area -->
        	</div><!-- #sidebar -->
        <?php endif; ?>
    </div>
</div><!-- .content-area -->

<?php get_footer(); ?>
