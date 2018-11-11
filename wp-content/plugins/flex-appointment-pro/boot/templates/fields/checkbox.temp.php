<input
    type="checkbox"
    id="<?php echo $id; ?>"
    name="<?php echo $name; ?>"
    class="chk-col-light-blue"
    value="<?php echo $value?>"
    <?php if(isset($checked) && $checked === true): ?>
        checked
    <?php endif ?>
>
<label for="<?php echo $id; ?>"><?php echo $label ?></label>