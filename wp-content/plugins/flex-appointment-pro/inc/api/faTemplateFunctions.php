<?php
	function convertTimeValue( $time_val ) {
		$hour   = $time_val / 60;
		$hour   = explode( '.', $hour )[0];
		$minute = $time_val % 60;
		if ( strlen( $hour ) < 2 ) {
			$hour = '0' . $hour;
		}
		if ( strlen( $minute ) < 2 ) {
			$minute = '0' . $minute;
		}
		$time_val            = $hour . $minute;
		$result['interface'] = $hour . ':' . $minute;
		$result['val']       = $time_val;
		
		return $result;
	}
	
	if ( ! function_exists( 'fa_convert_time' ) ) {
		function fa_convert_time( $time ) {
			$hour   = substr( $time, 0, 2 );
			$minute = substr( $time, 2, 2 );
			if ( 0 <= intval( $hour ) && intval( $hour ) < 12 ) {
				$result = $hour . ':' . $minute . ' AM';
			} elseif ( intval( $hour ) == 12 ) {
				$result = ( intval( $time ) ) . ':' . $minute . ' PM';
			} elseif ( 12 < intval( $hour ) && intval( $hour ) < 24 ) {
				$result = ( intval( $hour ) - 12 ) . ':' . $minute . ' PM';
			} elseif ( intval( $hour ) == 24 ) {
				$result = ( intval( $hour ) - 12 ) . ':' . $minute . ' AM (night)';
			}
			
			return $result;
		}
	}
	
	/**
	 * @param $time
	 *
	 * @return string
	 */
	function convertTimeToDisplay( $time ) {
		$time_arr   = explode( '-', $time );
		$start_hour = substr( $time_arr[0], 0, 2 );
		$end_hour   = substr( $time_arr[1], 0, 2 );
		
		if ( 0 <= intval( $start_hour ) && intval( $start_hour ) < 12 ) {
			$time_start = substr( $time_arr[0], 0, 2 ) . ':' . substr( $time_arr[0], 2, 2 ) . ' AM';
		} elseif ( intval( $start_hour ) == 12 ) {
			$time_start = ( intval( $start_hour ) ) . ':' . substr( $time_arr[0], 2, 2 ) . ' PM';
		} elseif ( 12 < intval( $start_hour ) && intval( $start_hour ) < 24 ) {
			$time_start = ( intval( $start_hour ) - 12 ) . ':' . substr( $time_arr[0], 2, 2 ) . ' PM';
		} elseif ( intval( $start_hour ) == 24 ) {
			$time_start = ( intval( $start_hour ) - 12 ) . ':' . substr( $time_arr[0], 2, 2 ) . ' AM (night)';
		}
		
		if ( 0 <= intval( $end_hour ) && intval( $end_hour ) < 12 ) {
			$time_end = substr( $time_arr[1], 0, 2 ) . ':' . substr( $time_arr[1], 2, 2 ) . ' AM';
		} elseif ( intval( $end_hour ) == 12 ) {
			$time_end = ( intval( $end_hour ) ) . ':' . substr( $time_arr[1], 2, 2 ) . ' PM';
		} elseif ( 12 < intval( $end_hour ) && intval( $end_hour ) < 24 ) {
			$time_end = ( intval( $end_hour ) - 12 ) . ':' . substr( $time_arr[1], 2, 2 ) . ' PM';
		} elseif ( intval( $end_hour ) == 24 ) {
			$time_end = ( intval( $end_hour ) - 12 ) . ':' . substr( $time_arr[1], 2, 2 ) . ' AM (night)';
		}
		
		return $time_start . ' - ' . $time_end;
	}
	
	function getGuestUserById( $gid ) {
		if ( $gid != 0 ) {
			global $table_prefix, $wpdb;
			$table_guest          = 'fa_guest';
			$wp_track_table_guest = $table_prefix . $table_guest;
			$sql                  = "SELECT * FROM  `" . $wp_track_table_guest . "` WHERE ";
			$sql                  .= "  `fa_guest_id`  = '" . $gid . "' LIMIT 1";
			$result               = $wpdb->get_results( $sql );
			
			return $result;
		} else {
			return false;
		}
	}
	
	function fa_get_time_slots_filter_day( $date ) {
		$d = date( 'D', strtotime( $date ) );
		$d = strtolower( $d );
		global $table_prefix, $wpdb;
		$table    = 'fa_timeslots';
		$wp_track = $table_prefix . $table;
		$sql      = "SELECT * FROM  `" . $wp_track . "` WHERE `fa_tl_day` ='" . $d . "' order by fa_tl_time";
		
		return $ts_by_day = $wpdb->get_results( $sql );
	}
	
	function fa_get_appointment_by_date_and_time( $date, $time ) {
		$d = date( 'd-m-Y', strtotime( $date ) );
		global $table_prefix, $wpdb;
		$table    = 'fa';
		$wp_track = $table_prefix . $table;
		$sql      = "SELECT * FROM  `" . $wp_track . "` WHERE `fa_date` ='" . $d . "' AND `fa_time` = '" . $time . "' order by fa_time ASC";
		
		return $appointment = $wpdb->get_results( $sql );
	}
	
	function fa_get_appointment_by_date_and_not_ts( $date, $list_time = array() ) {
		$time = implode( '\',\'', $list_time );
		$d    = date( 'd-m-Y', strtotime( $date ) );
		global $table_prefix, $wpdb;
		$table       = 'fa';
		$wp_track_fa = $table_prefix . $table;
		$sql         = "SELECT * FROM  `" . $wp_track_fa . "` WHERE `fa_date` ='" . $d . "' AND `fa_time` NOT IN ('" . $time . "') order by fa_time ASC";
		
		return $appointment = $wpdb->get_results( $sql );
	}
	
	function fa_get_pending_appointments() {
		global $table_prefix, $wpdb;
		$table    = 'fa';
		$wp_track = $table_prefix . $table;
		$sql      = "SELECT COUNT(*) FROM  `" . $wp_track . "` WHERE `fa_status` = 'pending' ";
		
		return $wpdb->get_var( $sql );
	}
	
	function fa_sent_email() {
	
	}
