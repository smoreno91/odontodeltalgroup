<input
    <?php echo (isset($required) && $required === true) ? 'required' : ''; ?>
        type="text"
        class="form-control <?php echo $class; ?>"
        placeholder="<?php echo $place_holder; ?>"
        name="<?php echo $name; ?>"
        id="<?php echo $id; ?>"
    <?php foreach ($attrs as $attr): ?>
        <?php echo $attr; ?>
    <?php endforeach; ?>
        value="<?php echo $value; ?>"
>
