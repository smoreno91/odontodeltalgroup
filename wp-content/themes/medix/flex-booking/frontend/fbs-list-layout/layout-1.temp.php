<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
?>
<form class="booking-form layout1" method="post" action="./" style="position: relative">
    <div class="row">
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<input type="text" aria-required="true" size="30" value="" name="fa-app-name" id="fa-app-name" class="form-control fa-app-name" placeholder="<?php esc_html_e('Full name','medix');?>"/>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<input type="text" aria-required="true" size="30" value="" name="fa-app-phone" id="fa-app-phone" class="form-control fa-app-phone" placeholder="<?php esc_html_e('Phone number','medix');?>"/>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<div class="input-group with_button">
    				<input type="text" aria-required="true" class="form-control fa-app-date" value="" name="fa-app-date" id="datepicker" placeholder="<?php esc_html_e('Date','medix');?>"/>
    				<i class="fa fa-calendar" aria-hidden="true"></i>
    			</div>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		 <div class="bottommargin_10">
    			<div class="select-group no-bs-caret">
    				<select class="fa-app-time" id="fa-app-time" name="fa-app-time" title="<?php esc_html_e('Time','medix');?>">
    					<option value=""><?php echo esc_html('Time');?></option>
    				</select>
    				<i class="fa fa-clock-o" aria-hidden="true"></i>
    			</div>
    		 </div>
    	</div>
    	<div class="col-sm-6">
            <div class="bottommargin_10">
            <textarea aria-required="true" rows="2" cols="45" name="fa-app-message" id="fa-app-message" class="form-control fa-app-message" placeholder="<?php esc_html_e('Message','medix');?>"></textarea>
            </div>
        </div> 
    	<div class="col-sm-6">
            <div class="bottommargin_10">
    		<input type="submit" id="fa-app-form-submit" name="fa-app-form-submit" class="btn-white fa-app-form-submit" value="<?php echo esc_html__('Make an appointment','medix');?>"/>
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
