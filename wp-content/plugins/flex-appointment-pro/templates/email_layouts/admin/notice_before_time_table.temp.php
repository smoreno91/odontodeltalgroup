<?php
	/**
	 * Created by PhpStorm.
	 * User: Nic
	 * Date: 27/5/2017
	 * Time: 9:30 AM
	 */ ?>
<table>
    <tr>
        <thead>
        <tr>
            <th>Date</th>
            <th>Time Start</th>
            <th>Time Stop</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $appointments as $appointment ):
			$time = $appointment->fa_time;
			$time = explode( '-', $time );
			$time_start = fa_convert_time( $time[0] );
			$time_stop = fa_convert_time( $time[1] );
			$date = DateTime::createFromFormat( 'd-m-Y', $appointment->fa_date, new DateTimeZone( 'UTC' ) );
			if ( $appointment->fa_uid != 0 ) {
				$user  = get_user_by( 'id', $appointment->fa_uid );
				$name  = $user->display_name;
				$email = $user->user_email;
				$phone = get_user_meta( $user->ID, 'fa_phone', true );
			} else {
				$wp_table_guest = $table_prefix . "fa_guest";
				$sql            = "SELECT * FROM  `" . $wp_table_guest . "` WHERE 'fa_guest_id' = '" . $result->fa_gid . "'";
				$user           = $wpdb->get_results( $sql )[0];
				$name           = $user->fa_guest_name;
				$email          = $user->fa_guest_email;
				$phone          = $user->fa_guest_phone;
			}
			?>
            <tr>
                <td><?php esc_html_e( date( get_option( 'date_format', 'F j, Y' ), $date->getTimestamp() ) ) ?></td>
                <td><?php esc_html_e( $time_start ) ?></td>
                <td><?php esc_html_e( $time_stop ) ?></td>
                <td><?php esc_html_e( $name ) ?></td>
                <td><?php esc_html_e( $email ) ?></td>
                <td><?php esc_html_e( $phone ) ?></td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </tr>
</table>
