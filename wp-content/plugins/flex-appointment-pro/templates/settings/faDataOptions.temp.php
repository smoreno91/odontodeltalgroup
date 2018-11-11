<?php
/**
 * User: KP
 * Date: 6/9/2017
 * Time: 08:55
 */
?>
<div class="fa-data-options">
    <div class="fa-data-contents">
        <ul class="fa-data-tabs">
            <li class="fa-data-tab-link current" tab-data="fa-data-tab-1">
                <?php esc_html_e("Setup Default Data", 'flex-appointments') ?>
            </li>
            <li class="fa-data-tab-link" tab-data="fa-data-tab-2">
                <?php esc_html_e("Import data", 'flex-appointments') ?>
            </li>
            <li class="fa-data-tab-link" tab-data="fa-data-tab-3">
                <?php esc_html_e("Export data", 'flex-appointments') ?>
            </li>
        </ul>
        <div id="fa-data-tab-1" class="fa-data-tab-content current">
            <div class="fa-reset-data">
                <div class="fa-reset-intro">
                    <img src="<?php echo fsa()->plugin_url . 'assets/img/appointment.png' ?>" class="fa-reset-img">
                    <div class="fa-process-bar">
                        <div class="fa-process-stt"></div>
                    </div>
                    <div class="fa-process-text"></div>
                </div>
                <div class="fa-reset-contents">
                    <h1 class="fa-rs-title">Current Data</h1>
                    <div class="fa-reset-info">
                        <div class="fa-row-data fa-rs-booked">
                            <div class="fa-rs-info-title"><?php esc_html_e("Booked appointments: ", 'flex-appointments'); ?></div>
                            <div class="fa-data-number fa-booked-numbers"><?php echo $booked_count; ?></div>
                        </div>
                        <div class="fa-row-data fa-rs-pending">
                            <div class="fa-rs-info-title"><?php esc_html_e("Pending appointments: ", 'flex-appointments'); ?></div>
                            <div class="fa-data-number fa-pending-numbers"><?php echo $pending_count; ?></div>
                        </div>
                        <div class="fa-row-data fa-rs-ts">
                            <div class="fa-rs-info-title"><?php esc_html_e("Time slots numbers: ", 'flex-appointments'); ?></div>
                            <div class="fa-data-number fa-ts-numbers"><?php echo $ts_count; ?></div>
                        </div>
                    </div>
                    <div class="fa-btn-reset btn"><?php esc_html_e('Reset to default', 'flex-appointments') ?></div>
                </div>
            </div>
        </div>
        <div id="fa-data-tab-2" class="fa-data-tab-content">
        </div>
        <div id="fa-data-tab-3" class="fa-data-tab-content">
            <div class="fa-ex-handling">
                <div class="fa-ex-title">
                    <?php
                    esc_html_e("Select data to export", 'flex-appointments');
                    ?>
                </div>
                <div class="fa-ex-select">
                    <input class="fa-ex-check" type="checkbox" id="fa-ex-booked"><label class="fa-ex-select-lb"
                                                                                        for="fa-ex-booked"><?php esc_html_e("Appointments", 'flex-appointments') ?></label>
                    <input class="fa-ex-check" type="checkbox" id="fa-ex-guest"><label class="fa-ex-select-lb"
                                                                                       for="fa-ex-guest"><?php esc_html_e("Guest users", 'flex-appointments') ?></label>
                    <input class="fa-ex-check" type="checkbox" id="fa-ex-ts"><label class="fa-ex-select-lb"
                                                                                    for="fa-ex-ts"><?php esc_html_e("Time slots", 'flex-appointments') ?></label>
                    <input class="fa-ex-check" type="checkbox" id="fa-ex-options"><label class="fa-ex-select-lb"
                                                                                         for="fa-ex-options"><?php esc_html_e("Settings", 'flex-appointments') ?></label>
                </div>
                <div class="fa-ex-button btn"><?php esc_html_e('Export data', 'flex-appointments') ?></div>
                <canvas id="fa-ex-process"></canvas>
            </div>
            <div class="fs-ex-file"></div>
        </div>
    </div>
</div>