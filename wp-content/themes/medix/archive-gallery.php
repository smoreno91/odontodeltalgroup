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

/* get side-bar position. */
$_get_sidebar = medix_gallery_archive_sidebar();
 
get_header(); ?>

<section id="primary" class="container">
    <div class="row <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php medix_gallery_archive_class(); ?>">
            <main id="main" class="site-main">
                <div class="row">
                <?php
                if ( have_posts() ) :
                     
                    while ( have_posts() ) : the_post();?>
                        <div class="<?php medix_get_gallery_cols();?>"> 
                        <?php get_template_part( 'single-templates/gallery/content', '' ); ?>
                        </div> 
                    <?php endwhile; // end of the loop.
                     
                    medix_paging_nav();

                else :
                    /* content none. */
                    get_template_part( 'single-templates/content', 'none' );

                endif; ?>
                </div>
            </main><!-- #content -->
        </div>

        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
</section><!-- #primary -->

<?php get_footer(); ?>