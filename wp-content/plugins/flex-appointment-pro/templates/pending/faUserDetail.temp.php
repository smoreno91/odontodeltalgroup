<div id="fa-modal" class="fa-modal fa-user-modal">
    <div class="md-modal md-effect-13 md-show" id="modal-13">
        <div class="md-content">
            <h3><?php esc_html_e('Request An Appointment', 'flex-appointments') ?> <span
                        class="fa-ud-close dashicons dashicons-no"></span></h3>
            <div class="fa-contact-info">
                <div class="fa-cont-info-title"><?php esc_html_e('Contact Information', 'flex-appointments') ?>
                    (<?php echo $user['type'] ?>)
                </div>
                <div class="fa-ui-name"><?php esc_html_e('Name:', 'flex-appointments') ?><?php echo $user['name'] ?></div>
                <div class="fa-ui-name"><?php esc_html_e('Email:', 'flex-appointments') ?><?php echo $user['email'] ?></div>
                <?php
                if (!empty($user['phone'])) {
                    ?>
                    <div class="fa-ui-name"><?php esc_html_e('Phone number:', 'flex-appointments') ?><?php echo $user['phone'] ?></div>
                    <?php
                }
                if (!empty($user['gender'])) {
                    $gender = "";
                    switch ($user['gender']) {
                        case "male":
                            $gender = "Male";
                            break;
                        case "female" :
                            $gender = "Female";
                            break;
                    }
                    ?>
                    <div class="fa-ui-name"><?php esc_html_e('Gender:', 'flex-appointments') ?><?php echo $gender ?></div>
                    <?php
                }
                ?>
            </div>
            <div class="fa-app-info">
                <div class="fa-app-info-title"><?php esc_html_e('Appointment Information', 'flex-appointments') ?></div>
                <div class="fa-date"><?php esc_html_e('Date:', 'flex-appointments') ?><?php echo $info['date'] ?></div>
                <div class="fa-time"><?php esc_html_e('Time:', 'flex-appointments') ?><?php echo $info['time'] ?></div>
            </div>
        </div>
    </div>
    <div class="md-overlay" id="md-overlay"></div>
</div>