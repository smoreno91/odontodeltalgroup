<?php
if ( class_exists( 'Tribe__Events__Main' ) ) {
	class Medix_ContinualMonthViewPagination {
	    public function __construct() {
	        add_filter( 'tribe_events_the_next_month_link', array( $this, 'medix_next_month' ) );
	        add_filter( 'tribe_events_the_previous_month_link', array( $this, 'medix_previous_month' ) );
            add_filter( 'tribe_events_the_next_list_link', array( $this, 'medix_next_month' ) );
	        add_filter( 'tribe_events_the_previous_list_link', array( $this, 'medix_previous_month' ) );
	    }
	    public function medix_next_month() {
	        $url = tribe_get_next_month_link();
	        $text = tribe_get_next_month_text();
	        $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
	        return '<a data-month="' . $date . '" href="' . $url . '" rel="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>';
	    }
	    public function medix_previous_month() {
	        $url = tribe_get_previous_month_link();
	        $text = tribe_get_previous_month_text();
	        $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
	        return '<a data-month="' . $date . '" href="' . $url . '" rel="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';
	    }
	}
	new Medix_ContinualMonthViewPagination;
}