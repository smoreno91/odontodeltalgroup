<div class="fa-booked-appt-list">
    <h4>
        <span><?php esc_html_e('Available Appointments on','medix')?> </span><strong><?php echo $date ?></strong><span></span>
    </h4>
    <?php
    foreach ($time_slots as $time => $spaces) {
        if ($spaces == 0) {
            $title = '<p class="over_spaces">' . $spaces . ' time slot available </p>';
        }
        if ($spaces == 1) $title = '<p class="fa_spaces">' . $spaces . ' time slot available </p>';
        if ($spaces > 1) $title = '<p class="fa_spaces">' . $spaces . ' time slots available </p>';

        ?>
        <div class="fa-timeslot clearfix <?php echo $spaces == 0 ? "fa-ts-unvanible" : ""; ?>">
            <span class="fa-timeslot-time">
                <i class="dashicons dashicons-clock"></i>
                <span class="fa-time_ts"><?php echo convertTimeToDisplay($time) ?></span>
            </span>
            <span class="fa-spaces-available"><?php echo $title ?></span>
            <span class="fa-timeslot-book">
                <?php
                if ($spaces == 0):?>
                    <button class="fa-new-appt-unavaiabale">
                        <span class="fa-button-text btn btn-white"><?php esc_html_e('UNAVAILABLE','medix')?></span>
                    </button>
                    <?php
                else:
                    ?>
                    <button data-timeslot="<?php echo $time ?>" data-date="<?php echo $format_date ?>"
                            class="fa-new-appt">
                        <span class="btn btn-secondary fa-button-text"><?php esc_html_e('APPOINTMENT','medix')?></span>
                    </button>
                    <?php
                endif;
                ?>
            </span>
        </div>
        <?php
    }
    ?>
</div>

