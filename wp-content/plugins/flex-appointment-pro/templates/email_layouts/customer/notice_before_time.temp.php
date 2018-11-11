<?php
	/**
	 * Created by PhpStorm.
	 * User: Nic
	 * Date: 27/5/2017
	 * Time: 9:30 AM
	 */
	?>
<p>Hi %name%!</p>
<p><?php echo get_bloginfo( "name" ) ?> want reminder that you have an appointment coming up soon!</p>
<p>Your appointment information:</p>
<p>Date: %date%</p>
<p>Time: From %time_start% to %time_stop%.</p>
<p>Sincerely,
<?php echo get_bloginfo( "name" ) ?></p>