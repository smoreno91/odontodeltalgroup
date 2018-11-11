<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 27/5/2017
 * Time: 10:34 AM
 */
?>
<p>Hi %name%!</p>
<p>The appointment you requested at <?php echo get_bloginfo("name") ?> has been approved!</p>
<p>Your appointment information:</p>
<p>Date: %date%</p>
<p>Time: From %time_start% to %time_stop%.</p>
<p>Sincerely, <?php echo get_bloginfo("name") ?></p>
