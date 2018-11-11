<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
?>

<div class="appointment-form-wrap">
    <i class="fa fa-hospital-o corner-icon main_bg_color black" aria-hidden="true"></i>
    <form class="booking-form layout3" method="post" action="./" style="position: relative">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="bottommargin_10">
                    <input type="text" aria-required="true" size="30" value="" name="fa-app-name" id="fa-app-name"
                           class="form-control fa-app-name" placeholder="<?php esc_html_e('Full name', 'medix'); ?>"/>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="bottommargin_10">
                    <input type="text" aria-required="true" size="30" value="" name="fa-app-phone" id="fa-app-phone"
                           class="form-control fa-app-phone"
                           placeholder="<?php esc_html_e('Phone number', 'medix'); ?>"/>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="bottommargin_10">
                    <input type="email" aria-required="true" size="30" value="" name="fa-app-email" id="fa-app-email"
                           class="form-control fa-app-email" placeholder="<?php esc_html_e('Email', 'medix'); ?>"/>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="bottommargin_10">
                    <div class="input-group with_button">
                        <input type="text" aria-required="true" class="form-control fa-app-date" value=""
                               name="fa-app-date" id="datepicker" placeholder="<?php esc_html_e('Date', 'medix'); ?>"/>
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="bottommargin_10">
                    <div class="select-group no-bs-caret">
                        <select class="fa-app-time" id="fa-app-time" name="fa-app-time"
                                title="<?php esc_html_e('Time', 'medix'); ?>">
                            <option value="8:00"><?php echo esc_html('Time'); ?></option>
                        </select>
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="container-flex">
                    <div>
                        <div class="radio inline-block rightmargin_10">
                            <input type="radio" name="fa-app-gender" id="fa-app-gender1" class="fa-app-gender"
                                   value="male" checked=""/>
                            <label for="fa-app-gender1" class="small-text black">
                                Male
                            </label>
                        </div>
                        <div class="radio inline-block rightmargin_10">
                            <input type="radio" name="fa-app-gender" id="fa-app-gender2" class="fa-app-gender"
                                   value="female" checked=""/>
                            <label for="fa-app-gender2" class="small-text black">
                                Female
                            </label>
                        </div>
                    </div>
                    <div>
                        <input type="submit" id="fa-app-form-submit" name="fa-app-form-submit"
                               class="btn-white fa-app-form-submit"
                               value="<?php echo esc_html__('Appointment', 'medix'); ?>"/>
                    </div>
                </div>

            </div>

        </div>
        <div class="fsb-wait"
             style="display: none;top: 0;left: 0;background: rgba(128, 116, 116, 0.2);width: 100%;height: 100%;position: absolute;z-index: 100;">
            <div class="la-ball-clip-rotate-multiple la-dark la-2x" style="top: 36%; left: 45%;">
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="fsb-modal" class="fsb-modal" style="display: none;">
            <div class="md-modal md-effect-13 md-show" id="modal-13">
                <div class="md-content fsb-booking-cnt">
                </div>
            </div>
            <div class="md-overlay" id="md-overlay"></div>
        </div>

    </form>
</div>
