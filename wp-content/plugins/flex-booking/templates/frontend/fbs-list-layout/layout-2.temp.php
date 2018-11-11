<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
?>


<form class="booking-form layout2" method="post" action="./">
    <div class="row">
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<input type="text" aria-required="true" size="30" value="" name="name" id="name" class="form-control" placeholder="<?php esc_html_e('Full name','medix');?>"/>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<input type="text" aria-required="true" size="30" value="" name="phone" id="phone" class="form-control" placeholder="<?php esc_html_e('Phone number','medix');?>"/>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		<div class="bottommargin_10">
    			<div class="input-group with_button">
    				<input type="text" aria-required="true" class="form-control" value="" name="date" id="datepicker" placeholder="<?php esc_html_e('Date','medix');?>"/>
    				<i class="fa fa-calendar" aria-hidden="true"></i>
    			</div>
    		</div>
    	</div>
    	<div class="col-sm-6">
    		 <div class="bottommargin_10">
    			<div class="select-group no-bs-caret">
    				<select class="selectpicker" id="time" name="time" title="<?php esc_html_e('Time','medix');?>">
    					<option value="8:00"><?php echo esc_html('8:00');?></option>
    					<option value="8:30"><?php echo esc_html('8:30');?></option>
    					<option value="9:00"><?php echo esc_html('9:00');?></option>
    					<option value="9:30"><?php echo esc_html('9:30');?></option>
    					<option value="10:00"><?php echo esc_html('10:00');?></option>
    					<option value="10:30"><?php echo esc_html('10:30');?></option>
    					<option value="11:00"><?php echo esc_html('11:00');?></option>
    					<option value="11:30"><?php echo esc_html('11:30');?></option>
    					<option value="12:00"><?php echo esc_html('12:00');?></option>
    					<option value="12:30"><?php echo esc_html('12:30');?></option>
    					<option value="1:00"><?php echo esc_html('13:00');?></option>
    					<option value="1:30"><?php echo esc_html('13:30');?></option>
    					<option value="2:00"><?php echo esc_html('14:00');?></option>
    					<option value="2:30"><?php echo esc_html('14:30');?></option>
    					<option value="3:00"><?php echo esc_html('15:00');?></option>
    					<option value="3:30"><?php echo esc_html('15:30');?></option>
    					<option value="4:00"><?php echo esc_html('16:00');?></option>
    					<option value="4:30"><?php echo esc_html('16:30');?></option>
    					<option value="5:00"><?php echo esc_html('17:00');?></option>
    					<option value="5:30"><?php echo esc_html('17:30');?></option>
    					<option value="6:00"><?php echo esc_html('18:00');?></option>
    					<option value="6:30"><?php echo esc_html('18:30');?></option>
    					<option value="7:00"><?php echo esc_html('19:00');?></option>
    					<option value="7:30"><?php echo esc_html('19:30');?></option>
    					<option value="8:00"><?php echo esc_html('20:00');?></option>
    				</select>
    				<i class="fa fa-clock-o" aria-hidden="true"></i>
    			</div>
    		 </div>
    	</div>
    	<div class="col-sm-12">
            <div class="bottommargin_10">
            <textarea aria-required="true" rows="6" cols="45" name="appointment-message" id="appointment-message" class="form-control" placeholder="<?php esc_html_e('Message','medix');?>"></textarea>
            </div>
        </div> 
    	<div class="col-sm-12">
            <div class="bottommargin_10 text-center">
    		<input type="submit" id="contact_form_submit" name="contact_submit" class="btn-white" value="<?php echo esc_html__('Make an appointment','medix');?>"/>
            </div>
    	</div>
    </div>
</form>
