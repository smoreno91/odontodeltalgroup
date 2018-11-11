<?php
/**
 * The Template for displaying all single posts
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
$_get_sidebar = medix_post_sidebar();
$theme_options = medix_get_theme_option();
get_header(); ?>

<div id="primary" class="container">
    <div class="row row-single <?php echo esc_attr($_get_sidebar); ?>">
        <div class="<?php medix_post_class(); ?>">
            <main id="main" class="site-main">

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the single content template.
                    get_template_part( 'single-templates/single/content', get_post_format() );
 
                    medix_post_user_profile();
                    // If comments are open or we have at least one comment, load up the comment template.
                    if( !isset($opt_theme_options['single_post_nav']) || (isset($theme_options['single_comment_form']) && $theme_options['single_comment_form'] ))
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    // Get single post nav.
                    medix_post_nav();
                    // End the loop.
                endwhile;
                ?>

            </main>
        </div><!-- #main -->

        <?php
        if($_get_sidebar != 'is-sidebar-full'):
            get_sidebar();
        endif; ?>

    </div>
</div><!-- #primary -->

<?php get_footer(); ?>