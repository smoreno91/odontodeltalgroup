<?php
/**
 * Template Name: Blog Classic
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 * @author Fox
 */

/* get side-bar position. */
$_get_sidebar = medix_archive_sidebar();
 
get_header(); ?>
 
<section id="primary" class="container">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile;  ?> 
<?php
global $wp_query, $paged; 
$wp_query->query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$paged);
if ( have_posts() ) :
?>
    <div class="row blog-two-top">
        <?php
        while ( have_posts() ) : 
        the_post();
        ?>
        <?php if(is_sticky()): ?>
        <div class="col-md-6 text-center feature-post">
            <?php get_template_part( 'single-templates/content/content', get_post_format() ); ?>
        </div>
        <?php endif;?> 
        <?php endwhile; ?>
    </div>
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php medix_archive_class(); ?>">
            <main id="main" class="site-main">
                <?php
                     
                    while ( have_posts() ) : the_post();
                        if(!is_sticky())
                        get_template_part( 'single-templates/content/content', get_post_format() );
                        
                    endwhile; // end of the loop.
                     
                    /* blog nav. */
                    medix_paging_nav();
                ?>
            </main><!-- #content -->
        </div>
        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
<?php 
else : 
    ?>
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php medix_archive_class(); ?>">
            <main id="main" class="site-main">
            <?php get_template_part( 'single-templates/content', 'none' ); ?>
            </main><!-- #content -->
        </div>
        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>
    </div>
<?php endif; ?>
</section><!-- #primary -->

<?php get_footer(); ?>