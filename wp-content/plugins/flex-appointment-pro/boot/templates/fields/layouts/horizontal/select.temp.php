<div class="row clearfix materialize">
    <div class="col-lg-2 form-control-label">
        <?php if (isset($label) && isset($id)): ?>
            <label class="custom_label" for="<?php echo $id ?>"><?php echo $label ?></label>
        <?php endif ?>
    </div>
    <div class="col-lg-10">
        <div>
            <div>
                <select
                        <?php echo (isset($multiple) && $multiple == true) ? 'multiple' : "" ?>
                        class="form-control show-tick"
                        name="<?php echo $name; ?>"
                        id="<?php echo $id; ?>"
                    <?php echo $select_type ?>
                >
                    <?php if (!empty($default_option)): ?>
                        <?php
                        $first_key = $default_option;
                        reset($first_key);
                        $first_key = key($first_key);
                        ?>
                        <option value="<?php echo $first_key; ?>"><?php echo $default_option[$first_key]; ?></option>                    <?php endif ?>
                    <?php foreach ($options as $key => $value_option): ?>
                        <?php if (!is_array($value)): ?>
                            <?php $checked = ($value == $key) ? 'selected' : ''; ?>
                        <?php else: ?>
                            <?php $checked = (in_array($key, $value)) ? 'selected' : ''; ?>
                        <?php endif ?>
                        <option value="<?php echo $key; ?>" <?php echo $checked ?>><?php echo $value_option; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
        </div>
    </div>
</div>
