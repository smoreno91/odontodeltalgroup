
<div class="row clearfix materialize">
    <div class="col-lg-2 form-control-label">
        <?php if(isset($label) && isset($id)): ?>
        <label class="custom_label" for="<?php echo $id ?>"><?php echo $label ?></label>
        <?php endif ?>
    </div>
    <div class="col-lg-10">
        <div>
            <div>
				<select
                    <?php echo (isset($multiple) && $multiple == true) ? 'multiple' : "" ?>
					class="form-control show-tick <?php echo $class; ?>" 
					data-live-search="true" 
					name="<?php echo $name; ?>" 
					id="<?php echo $id; ?>" >					
                    <?php if(!empty($default_option)): ?>
                        <?php
                            $first_key = $default_option;
                            reset($first_key);
                            $first_key = key($first_key);
                        ?>
                   	<?php endif ?>
				    <?php foreach($options as $key => $option_value): ?>
				        <?php if(!is_array($value)): ?>
                            <?php $checked = ($value == $key)? 'selected': ''; ?>
                        <?php else: ?>
                            <?php $checked = (in_array($key, $value))? 'selected': ''; ?>
                        <?php endif ?>
				        <option value="<?php esc_html_e($key); ?>" <?php echo $checked; ?>><?php esc_html_e($option_value)?></option>
				    <?php endforeach ?>
				</select>
            </div>
        </div>
    </div>
</div>
