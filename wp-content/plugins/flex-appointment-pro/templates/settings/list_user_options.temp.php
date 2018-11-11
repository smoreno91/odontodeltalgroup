<?php
$depen = (!empty($dependency)) ? 'fa-dependency' : '';
$class_depen = (!empty($dependency)) ? $dependency['element'] : '';
$value_parent = (!empty($dependency)) ? $dependency['value'] : '';
$data_options = get_option('fa-setting');
?>
<div class="row clearfix materialize <?php echo $depen ?>" data-parent="<?php echo $class_depen ?>"
     data-value="<?php echo $value_parent ?>">
    <div class="col-lg-2 form-control-label">
        <label><?php echo $label ?></label>
    </div>
    <div class="col-lg-10">
        <?php
        foreach ($options as $key => $checkbox):
            $value = (!empty($data_options[$key.'_checkbox']))? $data_options[$key.'_checkbox']:'';
            ?>
            <div class="form-group">
                <input
                    type="checkbox"
                    id="<?php echo $key; ?>"
                    name="<?php echo $key ?>"
                    class="chk-col-light-blue"
                    value="<?php echo $value ?>"
                    <?php if ($value == 'yes'): ?>
                        checked
                    <?php endif ?>
                >
                <label for="<?php echo $key ?>"><?php echo $checkbox['label'] ?></label>
            </div>
            <input type="hidden" class="tagsinput" name="<?php echo $key ?>_checkbox" value="<?php echo $value ?>">
            <?php
        endforeach;
        ?>
    </div>
</div>