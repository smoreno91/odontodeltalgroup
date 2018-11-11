<?php
/**
 * The Template for displaying all single services
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */

if ( is_active_sidebar( 'sidebar-services' ))
    $sb_cls = 'col-sm-7 col-md-8 col-sm-push-5 col-md-push-4';
else
    $sb_cls = 'col-sm-12 col-md-12';
get_header(); ?>

<div id="primary" class="container">
    <div class="row row-services">
        <div class="<?php echo esc_attr($sb_cls);?>">
            <main id="main" class="site-main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('medix-service-single'); ?>>
                    	<?php medix_post_thumbnail(); ?>
                        <div class="service-entry-wrap">
                        	<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
                        	<div class="entry-content"><?php the_content(); ?> </div> 
                        </div>
                    </article> 
                <?php endwhile; ?>
            </main>
        </div><!-- #main -->
        <?php
        if ( is_active_sidebar( 'sidebar-services' )): 
        ?>
            <div class="col-sm-5 col-md-4 col-sm-pull-7 col-md-pull-8 widget-area">
            <?php dynamic_sidebar('sidebar-services'); ?>
            </div>
            <?php
        endif; ?>
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>