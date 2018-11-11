<?php
/**
 * User: KP
 * Date: 5/27/2017
 * Time: 08:43
 */
$cus_reg_subject = (!empty(get_option('fa-setting')['fa-cus-reg-subject'])) ? get_option('fa-setting')['fa-cus-reg-subject'] : esc_html__('Thank you for registering!', 'flex-appointments');
$cus_reg_contents = (!empty(get_option('fa-setting')['fa-cus-reg-contents'])) ? get_option('fa-setting')['fa-cus-reg-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_after_reg");
$cus_app_subject = (!empty(get_option('fa-setting')['fa-cus-app-subject'])) ? get_option('fa-setting')['fa-cus-app-subject'] : esc_html__('You have a new appointment!', 'flex-appointments');
$cus_app_contents = (!empty(get_option('fa-setting')['fa-cus-app-contents'])) ? get_option('fa-setting')['fa-cus-app-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_after_book");
$cus_approval_subject = (!empty(get_option('fa-setting')['fa-cus-approval-subject'])) ? get_option('fa-setting')['fa-cus-approval-subject'] : esc_html__('Your appointment has been approved!', 'flex-appointments');
$cus_approval_contents = (!empty(get_option('fa-setting')['fa-cus-approval-contents'])) ? get_option('fa-setting')['fa-cus-approval-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_after_approved");
$cus_reject_subject = (!empty(get_option('fa-setting')['fa-cus-reject-subject'])) ? get_option('fa-setting')['fa-cus-reject-subject'] : esc_html__('Your appointment has been rejected!', 'flex-appointments');
$cus_reject_contents = (!empty(get_option('fa-setting')['fa-cus-reject-contents'])) ? get_option('fa-setting')['fa-cus-reject-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_after_reject");
$cus_cancel_subject = (!empty(get_option('fa-setting')['fa-cus-cancel-subject'])) ? get_option('fa-setting')['fa-cus-cancel-subject'] : esc_html__('Your appointment has been canceled!', 'flex-appointments');
$cus_cancel_contents = (!empty(get_option('fa-setting')['fa-cus-cancel-contents'])) ? get_option('fa-setting')['fa-cus-cancel-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_after_canceled");
$cus_reminder_subject = (!empty(get_option('fa-setting')['fa-cus-reminder-subject'])) ? get_option('fa-setting')['fa-cus-reminder-subject'] : esc_html__('Reminder: You have an appointment coming up soon!', 'flex-appointments');
$cus_reminder_contents = (!empty(get_option('fa-setting')['fa-cus-reminder-contents'])) ? get_option('fa-setting')['fa-cus-reminder-contents'] : fsa()->get_template_file__("email_layouts.customer.notice_before_time");
$admin_reminder_subject = (!empty(get_option('fa-setting')['fa-ad-reminder-subject'])) ? get_option('fa-setting')['fa-ad-reminder-subject'] : esc_html__('Reminder: You have appointments coming up soon!', 'flex-appointments');
$admin_reminder_contents = (!empty(get_option('fa-setting')['fa-ad-reminder-contents'])) ? get_option('fa-setting')['fa-ad-reminder-contents'] : fsa()->get_template_file__("email_layouts.admin.notice_before_time");
$admin_email = (!empty(get_option('fa-setting')['fa-admin-setmail-address'])) ? get_option('fa-setting')['fa-admin-setmail-address'] : get_bloginfo('admin_email');
?>
<div class="fa-email-options">
    <div class="fa-mailop-contents">
        <ul class="fa-mailop-tabs">
            <li class="fa-mailop-tab-link current" data-tab="fa-tab-1">
                <?php esc_html_e("Customer email", 'flex-appointments') ?>
            </li>
            <li class="fa-mailop-tab-link" data-tab="fa-tab-2">
                <?php esc_html_e("Admin/agent email", 'flex-appointments') ?>
            </li>
        </ul>
        <div id="fa-tab-1" class="fa-mailop-tab-content current">
            <div class="fa-custom-email fa-customer-reg">
                <h4 class="fa-cus-reg-title"><?php esc_html_e('User Registration', 'flex-appointments') ?></h4>
                <p class="fa-cus-reg-des"><?php esc_html_e('The content of the email will be sent to the user upon registration. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-reg-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-email">
                        <b>%email%</b>—<?php esc_html_e("To display the user email.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-username">
                        <b>%username%</b>—<?php esc_html_e("To display the username.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-password">
                        <b>%password%</b>—<?php esc_html_e("To display the password.", 'flex-appointments') ?></p>
                </div>
                <input type="text" name="fa-cus-reg-subject" class="fa-mail-op-subject fa-cus-reg-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_reg_subject ?>">
                <?php wp_editor($cus_reg_contents, 'fa-cus-reg-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
            <div class="fa-custom-email fa-customer-app">
                <h4 class="fa-cus-app-title"><?php esc_html_e('Appointment Notification', 'flex-appointments') ?></h4>
                <p class="fa-cus-app-des"><?php esc_html_e('The content of the email will be sent to the user upon appointment creation. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-app-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-date">
                        <b>%date%</b>—<?php esc_html_e("To display the appointment date.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-start-time">
                        <b>%time_start%</b>—<?php esc_html_e("To display the appointment start time.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-cus-token-stop-time">
                        <b>%time_stop%</b>—<?php esc_html_e("To display the appointment stop time.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-cus-app-subject" class="fa-mail-op-subject fa-cus-app-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_app_subject ?>">
                <?php wp_editor($cus_app_contents, 'fa-cus-app-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
            <div class="fa-custom-email fa-customer-approval">
                <h4 class="fa-cus-approval-title"><?php esc_html_e('Appointment Approval', 'flex-appointments') ?></h4>
                <p class="fa-cus-approval-des"><?php esc_html_e('The email content that is sent to the user upon appointment approval. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-approval-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-date">
                        <b>%date%</b>—<?php esc_html_e("To display the appointment date.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-start-time">
                        <b>%time_start%</b>—<?php esc_html_e("To display the appointment start time.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-cus-token-stop-time">
                        <b>%time_stop%</b>—<?php esc_html_e("To display the appointment stop time.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-cus-approval-subject" class="fa-mail-op-subject fa-cus-approval-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_approval_subject ?>">
                <?php wp_editor($cus_approval_contents, 'fa-cus-approval-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
            <div class="fa-custom-email fa-customer-reject">
                <h4 class="fa-cus-reject-title"><?php esc_html_e('Appointment reject', 'flex-appointments') ?></h4>
                <p class="fa-cus-reject-des"><?php esc_html_e('The email content that is sent to the user upon appointment rejected. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-reject-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-date">
                        <b>%date%</b>—<?php esc_html_e("To display the appointment date.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-start-time">
                        <b>%time_start%</b>—<?php esc_html_e("To display the appointment start time.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-cus-token-stop-time">
                        <b>%time_stop%</b>—<?php esc_html_e("To display the appointment stop time.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-cus-reject-subject" class="fa-mail-op-subject fa-cus-reject-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_reject_subject ?>">
                <?php wp_editor($cus_reject_contents, 'fa-cus-reject-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
            <div class="fa-custom-email fa-customer-cancel">
                <h4 class="fa-cus-cancel-title"><?php esc_html_e('Appointment cancel', 'flex-appointments') ?></h4>
                <p class="fa-cus-cancel-des"><?php esc_html_e('The content of the email is sent to the user when they cancel the them appointment. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-cancel-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-date">
                        <b>%date%</b>—<?php esc_html_e("To display the appointment date.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-start-time">
                        <b>%time_start%</b>—<?php esc_html_e("To display the appointment start time.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-cus-token-stop-time">
                        <b>%time_stop%</b>—<?php esc_html_e("To display the appointment stop time.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-cus-cancel-subject" class="fa-mail-op-subject fa-cus-cancel-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_cancel_subject ?>">
                <?php wp_editor($cus_cancel_contents, 'fa-cus-cancel-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
            <div class="fa-custom-email fa-custom-reminder">
                <h4 class="fa-cus-reminder-title"><?php esc_html_e('Customer Appointment Reminder Contents', 'flex-appointments') ?></h4>
                <p class="fa-cus-reminder-des"><?php esc_html_e('This is the email content for appoinment reminders. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-cus-reminder-tokens">
                    <p class="fa-cus-token-name">
                        <b>%name%</b>—<?php esc_html_e("To display the user full name.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-date">
                        <b>%date%</b>—<?php esc_html_e("To display the appointment date.", 'flex-appointments') ?></p>
                    <p class="fa-cus-token-start-time">
                        <b>%time_start%</b>—<?php esc_html_e("To display the appointment start time.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-cus-token-stop-time">
                        <b>%time_stop%</b>—<?php esc_html_e("To display the appointment stop time.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-cus-reminder-subject" class="fa-mail-op-subject fa-cus-reminder-subject"
                       placeholder="Subject"
                       value="<?php echo $cus_reminder_subject ?>">
                <?php wp_editor($cus_reminder_contents, 'fa-cus-reminder-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
        </div>
        <div id="fa-tab-2" class="fa-mailop-tab-content">
            <div class="fa-admin-email fa-admin-setmail">
                <h4 class="fa-admin-setmail-title"><?php esc_html_e('Admin or Agent email', 'flex-appointments') ?></h4>
                <p class="fa-admin-setmail-des"><?php esc_html_e('This is the mail address will receive the notification from the website.', 'flex-appointments') ?></p>
                <input type="email" name="fa-admin-setmail-address" class="fa-mail-op-subject fa-admin-setmail-address"
                       placeholder="Email address"
                       value="<?php echo $admin_email ?>">
            </div>
            <div class="fa-admin-email fa-admin-reminder">
                <h4 class="fa-ad-reminder-title"><?php esc_html_e('Customer Appointment Reminder Contents', 'flex-appointments') ?></h4>
                <p class="fa-ad-reminder-des"><?php esc_html_e('This is the email content for appoinment reminders. Some tokens you can use:', 'flex-appointments') ?></p>
                <div class="fa-ad-reminder-tokens">
                    <p class="fa-ad-token-number">
                        <b>%number_appointments%</b>—<?php esc_html_e("To display the number of appointments.", 'flex-appointments') ?>
                    </p>
                    <p class="fa-ad-token-table">
                        <b>%table_appointments%</b>—<?php esc_html_e("To display the appointments table details.", 'flex-appointments') ?>
                    </p>
                </div>
                <input type="text" name="fa-ad-reminder-subject" class="fa-mail-op-subject fa-ad-reminder-subject"
                       placeholder="Subject"
                       value="<?php echo $admin_reminder_subject ?>">
                <?php wp_editor($admin_reminder_contents, 'fa-ad-reminder-contents', array(
                    'editor_height' => 380
                )) ?>
            </div>
        </div>
    </div>
</div>

