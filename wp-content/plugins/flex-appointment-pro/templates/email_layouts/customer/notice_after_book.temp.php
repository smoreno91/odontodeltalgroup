<?php
/**
 * Created by PhpStorm.
 * User: Nic
 * Date: 27/5/2017
 * Time: 10:34 AM
 */
?>
<p>Hi %name%!</p>
<p>Thanks for the appointment to <?php echo get_bloginfo("name") ?>. Please wait approved email from the administrator.</p>
<p>Your appointment information:</p>
<p>Date: %date%</p>
<p>Time: From %time_start% to %time_stop%.</p>
<p>Sincerely,
    <?php echo get_bloginfo("name") ?></p>
