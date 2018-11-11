<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
$_get_sidebar = medix_archive_sidebar();
 
get_header(); ?>

<section id="primary" class="container">
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php medix_archive_class(); ?>">
            <main id="main" class="site-main">
                
                <?php
                if ( have_posts() ) :
                     
                    while ( have_posts() ) : the_post();
                         
                        get_template_part( 'single-templates/content/content', get_post_format() );
                         
                    endwhile; // end of the loop.
                     
                    /* blog nav. */
                    medix_paging_nav();

                else :
                    /* content none. */
                    get_template_part( 'single-templates/content', 'none' );

                endif; ?>

            </main><!-- #content -->
        </div>

        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
</section><!-- #primary -->

<?php get_footer(); ?>