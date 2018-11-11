<div class="multi-select-special-wrapper <?php echo $wrapper_class ?>">
    <label class="custom_label" for="<?php echo isset($group) ? $group : 'optgroup'; ?>"><?php echo isset($label) ? $label : 'Multi select' ?></label>
    <select name="<?php echo isset($name) ? $name : 'multi-select'; ?>"
            id="<?php echo isset($group) ? $group : 'optgroup'; ?>"
            class="<?php echo $class ?> <?php echo 'ms ' . ($value == 'default' ? 'optgroup-hidden' : 'optgroup') ?>"
            multiple="multiple">
        <?php
        if (isset($optgroup)):
            foreach ($optgroup as $group_key => $group_value): ?>
                <optgroup label="<?php echo $group_value['label']; ?>">
                    <?php foreach ($group_value['option'] as $option_key => $option_value): ?>
                        <option value="<?php echo $option_key ?>" <?php echo (isset($option_value) && in_array($option_key, (array)$value)) ? 'selected' : ''; ?>><?php echo $option_value; ?></option>
                    <?php endforeach; ?>
                </optgroup>
                <?php
            endforeach;
        endif;
        ?>
    </select>
</div>