<?php
/**
 * User: KP
 * Date: 5/25/2017
 * Time: 09:39
 */
if (isset($_POST['fa-success-book']) && $_POST['fa-success-book'] == 'done') {
    echo '<div class="fa-success-prof">Your appointment has been requested! It will be updated below if approved.</div>';
}
if ($current_user !== 0):
    ?>
    <div class="fa-u-profile">
        <div class="fa-prof-head">
            <p class="fa-prof-title"><?php esc_html_e("Hello, ", "flex-appointments") ?>
                <span class="fs-acc-name"><?php echo wp_get_current_user()->display_name ?></span>
            </p>
            <a class="fa-signout"
               href="<?php echo wp_logout_url(get_home_url()); ?>"><?php esc_html_e('Sign Out!', 'flex-appointments') ?></a>
        </div>
        <div class="fa-prof-contents">
            <ul class="fa-prof-tabs">
                <li class="fa-tab-link current" data-tab="fa-tab-1">
                    <p class="fa-tab-head"><?php esc_html_e("Upcoming Appointments", 'flex-appointments') ?></p>
                </li>
                <li class="fa-tab-link" data-tab="fa-tab-2">
                    <p class="fa-tab-head"><?php esc_html_e("Appointments History", 'flex-appointments') ?></p>
                </li>
            </ul>
            <div id="fa-tab-1" class="fa-tab-content current">
                <h4 class="fa-tab-title"><?php echo count($upcoming_app) > 1 ? count($upcoming_app) . " " . esc_html__("Upcoming Appointments", "flex-appointments") : count($upcoming_app) . " " . esc_html__("Upcoming Appointment", "flex-appointments") ?> </h4>
                <?php
                foreach ($upcoming_app as $app):
                    ?>
                    <div class="fa-app-prof clearfix">
                        <i class="dashicons dashicons-clock"></i>
                        <span class="fa-app-prof-date">
                        <?php $date = date_create($app->fa_date);
                        $date = date_format($date, "l, M d, Y");
                        $time = convertTimeToDisplay($app->fa_time) ?>
                        <?php echo $date . " from " . $time; ?>
                        </span>
                        <?php
                        if ($app->fa_status == "approved") {
                            echo '<span class="fa-prof-status fa-approved">' . esc_attr__("Approved", "flex-appointments") . '</span>';
                        } else {
                            echo '<span class="fa-prof-status fa-pending">' . esc_attr__("Pending", "flex-appointments") . '</span>';
                        }
                        ?>

                        <div class="fa-prof-cancel" data-id="<?php echo $app->fa_id ?>">Cancel Appointment</div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
            <div id="fa-tab-2" class="fa-tab-content">
                <h4 class="fa-tab-title"><?php echo count($history_app) > 1 ? count($history_app) . " " . esc_html__("History Appointments", "flex-appointments") : count($history_app) . esc_html__(" History Appointment", "flex-appointments") ?> </h4>
                <?php
                foreach ($history_app as $app):
                    ?>
                    <div class="fa-app-prof clearfix">
                        <i class="dashicons dashicons-clock"></i>
                        <span class="fa-app-prof-date">
                        <?php $date = date_create($app->fa_date);
                        $date = date_format($date, "l, M d, Y");
                        $time = convertTimeToDisplay($app->fa_time) ?>
                        <?php echo $date . " from " . $time; ?>
                        </span>
                        <?php
                        if ($app->fa_status == "approved") {
                            echo '<span class="fa-prof-status fa-approved">' . esc_attr__("Approved", "flex-appointments") . '</span>';
                        } else {
                            echo '<span class="fa-prof-status fa-pending">' . esc_attr__("Pending", "flex-appointments") . '</span>';
                        }
                        ?>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <?php

else:
    ?>
    <div class="fa-u-profile">
        <div class="fa-prof-contents">
            <ul class="fa-prof-tabs">
                <li class="fa-tab-link current" data-tab="fa-tab-1">
                    <?php esc_html_e("Login", 'flex-appointments') ?>
                </li>
                <li class="fa-tab-link" data-tab="fa-tab-2">
                    <?php esc_html_e("Register", 'flex-appointments') ?>
                </li>
            </ul>
            <div id="fa-tab-1" class="fa-tab-content current">
                <div class="fa-notice-log" data-action="profile"></div>
                <div class="fa-log-prof-mail fa-prof-field">
                    <label for="fa-log-email"><?php esc_html_e('Username or Email Address', 'flex-appointments') ?></label>
                    <input type="text" name="fa-log-email" class="fa-log-email"/>
                </div>
                <div class="fa-log-prof-pass fa-prof-field">
                    <label for="fa-log-password"><?php esc_html_e('Password', 'flex-appointments') ?></label>
                    <input type="password" name="fa-log-password" class="fa-log-password"/>
                </div>
                <div class="fa-button-request">
                    <button class="fa-login-button"
                            data-requesttype="register"><?php esc_html_e('Sign In', 'flex-appointments') ?></button>
                    <button class="md-close"><?php esc_html_e('Cancel', 'flex-appointments') ?></button>
                    <div class="fa-fr-submit la-ball-clip-rotate-multiple la-dark la-3x"
                         style="display:none;">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div id="fa-tab-2" class="fa-tab-content">
                <div class="fa-notice-reg" data-action="profile"></div>
                <div class="fa-prof-username fa-prof-field">
                    <label for="fa-userlogin"><?php esc_html_e('User Name', 'flex-appointments') ?></label>
                    <input type="text" name="fa-userlogin" class="fa-userlogin"/>
                </div>
                <div class="fa-prof-fisrtname fa-prof-field">
                    <label for="fa-firstname"><?php esc_html_e('First Name', 'flex-appointments') ?></label>
                    <input type="text" name="fa-firstname" class="fa-firstname"/>
                </div>
                <div class="fa-prof-lastname fa-prof-field">
                    <label for="fa-lastname"><?php esc_html_e('Last Name', 'flex-appointments') ?></label>
                    <input type="text" name="fa-lastname" class="fa-lastname"/>
                </div>
                <div class="fa-prof-email fa-prof-field">
                    <label for="fa-email"><?php esc_html_e('Email', 'flex-appointments') ?></label>
                    <input type="text" name="fa-email" class="fa-reg-email"/>
                </div>
                <div class="fa-prof-pass fa-prof-field">
                    <label for="fa-password"><?php esc_html_e('Password', 'flex-appointments') ?></label>
                    <input type="password" name="fa-reg-password" class="fa-reg-password"/>
                </div>
                <div class="fa-button-request">
                    <button class="fa-register-button"
                            data-requesttype="register"><?php esc_html_e('Create Account', 'flex-appointments') ?></button>
                    <button class="md-close"><?php esc_html_e('Cancel', 'flex-appointments') ?></button>
                    <div class="fa-fr-submit la-ball-clip-rotate-multiple la-dark la-3x"
                         style="display:none;">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;


