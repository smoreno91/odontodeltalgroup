<?php
/**
 * The Template for displaying all single portfolio
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();
 
?>

<div class="tribe-events-single">
    
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    			<!-- Event featured image, but exclude link -->
    			<?php echo tribe_event_featured_image( $event_id, 'large', false ); ?>
                <div class="entry-wrap">
                    <header class="entry-header">
        
                		<?php the_title( '<h4 class="entry-title highlight">', '</h4>' ); ?>
                
                		<div class="entry-meta content-justify">
                
                			<?php medix_event_detail(); ?>
                            <?php medix_event_cats(); ?>
                
                		</div><!-- .entry-meta -->
                	</header><!-- .entry-header -->
                    <div class="entry-content">
            			<!-- Event content -->
            		 
            			<div class="tribe-events-single-event-description tribe-events-content">
            				<?php the_content(); ?>
            			</div>
            			 
            			<!-- Event meta -->
            			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
            			<?php tribe_get_template_part( 'modules/meta' ); ?>
            			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
                        <?php medix_single_event_share(); ?>
                    </div>
                </div>
    		</div> <!-- #post-x -->
    		<?php comments_template() ?>
        <?php
        endwhile;
        ?>
 
</div>