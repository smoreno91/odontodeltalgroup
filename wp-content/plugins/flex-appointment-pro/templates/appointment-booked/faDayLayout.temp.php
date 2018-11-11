<div class="booked-list" style="display: block;">
    <h2>Appointments for <strong><?php echo $date ?></strong></h2>
    <div class="fa-booked-appt-list">
        <?php
        foreach ($list_ts as $ts) :
            $list_time[] = $ts->fa_tl_time;
            $booked_list = fa_get_appointment_by_date_and_time($date, $ts->fa_tl_time);
            $title = (count($booked_list) <= 1) ? 'Appointment:' : 'Appointments:';
            ?>
            <div class="fa-booked-ts">
                <div class="fa-booked-ts-time">
                    <i class="dashicons dashicons-clock"></i>
                    <p class="fa-ts-time-val"><?php echo convertTimeToDisplay($ts->fa_tl_time) ?></p>
                </div>
                <div class="fa-booked-count">
                    <div class="fa-booked-count-title"><?php echo count($booked_list) . ' ' . $title ?></div>
                    <?php
                    foreach ($booked_list as $appointment):
                        if ($appointment->fa_uid != 0) {
                            $u = get_user_by('ID', $appointment->fa_uid);
                            $display_name = $u->display_name;
                        } else {
                            $guid = getGuestUserById($appointment->fa_gid);
                            $display_name = $guid[0]->fa_guest_name;
                        }
                        ?>
                        <div class="fa-booked-app" data-app-id="<?php echo $appointment->fa_id ?>">
                            <div class="fa-booked-delete" data-appt-id="<?php echo $appointment->fa_id ?>"
                                 data-appt-date="<?php echo $appointment->fa_date ?>">
                                <span class="dashicons dashicons-no"></span>
                            </div>
                            <a class="fa fa-user fa-app-user" data-uid="<?php echo $appointment->fa_uid ?>"
                               data-gid="<?php echo $appointment->fa_gid ?>"
                               data-date="<?php echo $appointment->fa_date ?>"
                               data-time="<?php echo convertTimeToDisplay($appointment->fa_time) ?>"><?php echo $display_name ?></a>
                            <?php
                            if ($appointment->fa_status == "pending"):
                                ?>
                                <button data-appt-id="<?php echo $appointment->fa_id ?>"
                                        data-appt-date="<?php echo $appointment->fa_date ?>"
                                        class="fa-approve-btn button-primary"><?php esc_html_e('Approve', 'flex-appointments') ?>
                                </button>
                                <?php
                            endif;
                            ?>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <?php
    $apps = fa_get_appointment_by_date_and_not_ts($date, $list_time);
    if (!empty($apps)):
        ?>
        <div class="fa-additional-ts">
            <p class="fa-additional-ts-title">There are additional appointments booked from previously available time
                slots:</p>
            <?php
            foreach ($apps as $app):
                if ($app->fa_uid != 0) {
                    $u = get_user_by('ID', $app->fa_uid);
                    $display_name = $u->display_name;
                } else {
                    $guid = getGuestUserById($app->fa_gid);
                    $display_name = $guid[0]->fa_guest_name;
                }
                ?>
                <div class="fa-booked-ts">
                    <div class="fa-booked-ts-time">
                        <i class="dashicons dashicons-clock"></i>
                        <p class="fa-ts-time-val"><?php echo convertTimeToDisplay($app->fa_time) ?></p>
                    </div>
                    <div class="fa-booked-count">
                        <div class="fa-additional-booked-app" data-app-id="<?php echo $app->fa_id ?>">
                            <div class="fa-booked-delete" data-appt-id="<?php echo $app->fa_id ?>"
                                 data-appt-date="<?php echo $app->fa_date ?>">
                                <span class="dashicons dashicons-no"></span>
                            </div>
                            <a class="fa fa-user fa-app-user" data-uid="<?php echo $app->fa_uid ?>"
                               data-gid="<?php echo $app->fa_gid ?>"
                               data-date="<?php echo $app->fa_date ?>"
                               data-time="<?php echo convertTimeToDisplay($app->fa_time) ?>"><?php echo $display_name ?></a>
                            <?php
                            if ($app->fa_status == "pending"):
                                ?>
                                <button data-appt-id="<?php echo $app->fa_id ?>"
                                        data-appt-date="<?php echo $app->fa_date ?>"
                                        class="fa-approve-btn button-primary">Approve
                                </button>
                                <?php
                            endif;
                            ?>
                        </div>

                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <?php
    endif;
    ?>
</div>
