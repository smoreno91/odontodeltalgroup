<?php
/**
 * The template for displaying Search Results pages
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
                        
                        get_template_part( 'single-templates/content/content','search' );
                         
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