<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
$_get_sidebar = medix_event_sidebar();
$theme_options = medix_get_theme_option();
?>
<div class="container">
<div class="row row-single <?php echo esc_attr($_get_sidebar); ?>">
    <div class="<?php medix_event_class(); ?>">
        <div id="tribe-events-pg-template" class="tribe-events-pg-template">
        	<?php tribe_events_before_html(); ?>
        	<?php tribe_get_view(); ?>
        	<?php tribe_events_after_html(); ?>
        </div> <!-- #tribe-events-pg-template -->
    </div> 
    <?php
    if($_get_sidebar != 'is-sidebar-full'):
        if ( tribe_is_event_query() && is_singular() ) get_sidebar();
    endif; ?>

    </div>
</div>
<?php
get_footer();
