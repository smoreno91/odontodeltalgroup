<div class="input-group custom_spinner <?php echo isset($class) ? $class : ''; ?>" data-trigger="spinner">
    <div class="form-line">
        <input name="<?php echo isset($name) ? $name : 'spinner' ?>" type="text"
               class="form-control text-center"
               value="<?php echo isset($value) ? $value : ''; ?>" data-rule="<?php echo isset($rule) ? $rule : ''; ?>">
    </div>
    <span class="input-group-addon">
        <a href="javascript:;" class="spin-up" data-spin="up">
            <i class="glyphicon glyphicon-chevron-up"></i>
        </a>
        <a href="javascript:;" class="spin-down" data-spin="down">
            <i class="glyphicon glyphicon-chevron-down"></i>
        </a>
    </span>
</div>