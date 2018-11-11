<?php
$current_uid = get_current_user_id();
$booking_type = isset($options['fa_booking_type']) ? $options['fa_booking_type'] : 'guest';
if ($booking_type == 'guest' && $current_uid == 0):
    ?>
    <div id="fa-modal" class="fa-modal fa-RequestForm" data-usertype="guest">
        <div class="md-modal md-effect-13 md-show" id="modal-13">
            <div class="md-content">
                <h3><?php esc_html_e('Request An Appointment', 'flex-appointments') ?></h3>
                <div class="fa-app-form">
                    <p><?php esc_html_e('Please confirm that you would like to request the appointment:', 'flex-appointments') ?></p>
                    <div class="fa-booked-app">
                        <div class="fa-booked-app-details" data-appt-key="0">
                            <p class="fa-app-info">
                                <i class="fa fa-calendar-o"></i><?php $date = date_create($date_time[0]);
                                echo date_format($date, "F d, Y"); ?>
                                at <?php echo convertTimeToDisplay($date_time[1]) ?></p>
                            <input type="hidden" name="fa-app-date" class="fa-app-date"
                                   value="<?php echo $date_time[0] ?>">
                            <input type="hidden" name="fa-app-time" class="fa-app-time"
                                   value="<?php echo $date_time[1] ?>">
                        </div>
                    </div>
                    <h4 class="fa-label-info"><?php esc_html_e('Your Information:', 'flex-appointments') ?></h4>
                    <p><?php esc_html_e('Please enter in the form:', 'flex-appointments') ?></p>
                    <div class="fa-request-name clearfix">
                        <label><?php esc_html_e('Name', 'flex-appointments') ?></label>
                        <input type="text" name="fa-app-name" class="fa-app-name">
                    </div>
                    <?php
                    if (isset($options['booked_require_guest_email_address_checkbox']) && $options['booked_require_guest_email_address_checkbox'] == 'yes'):
                        ?>
                        <div class="fa-request-email clearfix">
                            <label><?php esc_html_e('Email', 'flex-appointments') ?></label>
                            <input type="text" name="fa-app-email" class="fa-app-email">
                        </div>
                        <?php
                    endif;
                    ?>
                    <?php
                    if (isset($options['booked_require_guest_phone_number_checkbox']) && $options['booked_require_guest_phone_number_checkbox'] == 'yes'):
                        ?>
                        <div class="fa-request-phone clearfix">
                            <label><?php esc_html_e('Phone', 'flex-appointments') ?></label>
                            <input type="text" name="fa-app-phone" class="fa-app-phone">
                        </div>
                        <?php
                    endif;
                    ?>
                    <div class="fa-button-request">
                        <button class="fa-request-app"><?php esc_html_e('Request', 'flex-appointments') ?></button>
                        <button class="md-close"><?php esc_html_e('Cancel', 'flex-appointments') ?></button>
                        <div class="fa-fr-submit la-ball-clip-rotate-multiple la-dark la-3x" style="display:none;">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <form id="fa-redirect" style="display: none" action="<?php echo $link ?>" method="post">
                    <input type="hidden" name="fa-success-book" value="done">
                </form>
            </div>
        </div>
        <div class="md-overlay" id="md-overlay"></div>
    </div>
    <?php
elseif ($current_uid !== 0):
    ?>
    <div id="fa-modal" class="fa-modal fa-RequestForm" data-usertype="logined">
        <div class="md-modal md-effect-13 md-show" id="modal-13">
            <div class="md-content">
                <h3><?php esc_html_e('Request An Appointment', 'flex-appointments') ?></h3>
                <div class="fa-app-form">
                    <p><?php esc_html_e('You want to request the following appointment with your account', 'flex-appointments') ?>
                        "<b><?php echo wp_get_current_user()->display_name ?>":</b></p>
                    <div class="fa-booked-app">
                        <div class="fa-booked-app-details" data-appt-key="0">
                            <p class="fa-app-info">
                                <i class="fa fa-calendar-o"></i><?php $date = date_create($date_time[0]);
                                echo date_format($date, "F d, Y"); ?>
                                at <?php echo convertTimeToDisplay($date_time[1]) ?></p>
                            <input type="hidden" name="fa-app-date" class="fa-app-date"
                                   value="<?php echo $date_time[0] ?>">
                            <input type="hidden" name="fa-app-time" class="fa-app-time"
                                   value="<?php echo $date_time[1] ?>">
                        </div>
                    </div>
                    <div class="fa-button-request">
                        <button class="fa-request-app"><?php esc_html_e('Request', 'flex-appointments') ?></button>
                        <button class="md-close"><?php esc_html_e('Cancel', 'flex-appointments') ?></button>
                        <div class="fa-fr-submit la-ball-clip-rotate-multiple la-dark la-3x" style="display:none;">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <form id="fa-redirect" style="display: none" action="<?php echo $link ?>" method="post">
                    <input type="hidden" name="fa-success-book" value="done">
                </form>
            </div>
        </div>
        <div class="md-overlay" id="md-overlay"></div>
    </div>
    <?php

endif;
if ($current_uid == 0 && $booking_type == 'registered'):
    ?>
    <div id="fa-modal" class="fa-modal fa-RequestForm" data-usertype="registed">
        <div class="md-modal md-effect-13 md-show" id="modal-13">
            <div class="md-content">
                <h3><?php esc_html_e('Request An Appointment', 'flex-appointments') ?></h3>
                <div class="fa-forms">
                    <ul class="fa-tab-group">
                        <li class="fa-tab fa-active"><a
                                    href="#fa-signup"><?php esc_html_e('New customer', 'flex-appointments') ?></a></li>
                        <li class="fa-tab"><a
                                    href="#fa-login"><?php esc_html_e('Have an account', 'flex-appointments') ?></a>
                        </li>
                    </ul>
                    <div class="fa-tab-content" action="#" id="fa-signup" style="display: block;">
                        <p><?php esc_html_e('Please confirm that you would like to request the appointment:', 'flex-appointments') ?></p>
                        <div class="fa-booked-app">
                            <div class="fa-booked-app-details" data-appt-key="0">
                                <p class="fa-app-info">
                                    <i class="fa fa-calendar-o"></i><?php $date = date_create($date_time[0]);
                                    echo date_format($date, "F d, Y"); ?>
                                    at <?php echo convertTimeToDisplay($date_time[1]) ?></p>
                                <input type="hidden" name="fa-app-date" class="fa-app-date"
                                       value="<?php echo $date_time[0] ?>">
                                <input type="hidden" name="fa-app-time" class="fa-app-time"
                                       value="<?php echo $date_time[1] ?>">
                            </div>
                        </div>
                        <h4 class="fa-label-info"><?php esc_html_e('Registration:', 'flex-appointments') ?></h4>
                        <div class="fa-notice-reg"></div>
                        <p><?php esc_html_e('Please enter in the form:', 'flex-appointments') ?></p>
                        <div class="input-field">
                            <label for="fa-userlogin"><?php esc_html_e('User Name', 'flex-appointments') ?></label>
                            <input type="text" name="fa-userlogin" class="fa-userlogin"/>
                            <label for="fa-firstname"><?php esc_html_e('First Name', 'flex-appointments') ?></label>
                            <input type="text" name="fa-firstname" class="fa-firstname"/>
                            <label for="fa-lastname"><?php esc_html_e('Last Name', 'flex-appointments') ?></label>
                            <input type="text" name="fa-lastname" class="fa-lastname"/>
                            <label for="fa-email"><?php esc_html_e('Email', 'flex-appointments') ?></label>
                            <input type="text" name="fa-email" class="fa-reg-email"/>
                            <label for="fa-password"><?php esc_html_e('Password', 'flex-appointments') ?></label>
                            <input type="password" name="fa-reg-password" class="fa-reg-password"/>
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
                    <div class="fa-tab-content" action="#" id="fa-login">
                        <h4 class="fa-label-info"><?php esc_html_e('Welcome you come back, please login:', 'flex-appointments') ?></h4>
                        <div class="fa-notice-log"></div>
                        <div class="input-field">
                            <label for="fa-log-email"><?php esc_html_e('Username or Email Address', 'flex-appointments') ?></label>
                            <input type="text" name="fa-log-email" class="fa-log-email"/>
                            <label for="fa-log-password"><?php esc_html_e('Password', 'flex-appointments') ?></label>
                            <input type="password" name="fa-log-password" class="fa-log-password"/>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="md-overlay" id="md-overlay"></div>
    </div>
    <?php
endif;
?>