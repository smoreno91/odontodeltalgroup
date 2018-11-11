<?php
/**
 * The Template for displaying all single team
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
 
get_header(); ?>
<?php
$meta_options = medix_get_meta_option();
?>
<div id="primary" class="container">
    <div class="row row-team-single">
        <div class="col-xs-12">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                    $titles = explode(' ', get_the_title());
                    $first  = $titles[0];
                    $rest   = ltrim(get_the_title(), $first.' ');
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('medix-team-single'); ?>>
                    <div class="row">
                        <div class="col-md-5 single-team-left">
							<div class="left-wrap text-center">
								<div class="item-media">
									<?php medix_post_thumbnail('full'); ?>
								</div>
								<div class="item-content with_padding">
									<div class="display_table">
										<div class="display_table_cell">
                                            <h4 class="module-header">
                                                <?php if(!empty($titles[0])):?>
                        						<span class="thin"><?php echo esc_html($titles[0])?></span><br/>
                                                <?php endif;?>
                                                <?php if(!empty($rest)):?>
                        						<?php echo esc_html($rest)?>
                                                <?php endif;?>
                            				</h4>
                                            <?php medix_team_meta_layout1(); ?> 
										</div>
									</div>
								</div>
							</div>

						</div>
                        <div class="col-md-7 single-team-right">
                            <div class="entry-content">
                        			<?php the_content(); ?>
                        	</div> 
                        </div>
                	</div> 
                    
                </article> 
            <?php endwhile; ?>
        </div>
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>