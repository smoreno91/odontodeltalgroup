<div class="col-lg-2 form-control-label">
    <label class="custom_label"><?php echo isset($label) ? $label : ''; ?></label>
</div>
<div class="col-lg-10">
    <?php
    foreach ($options as $key => $radio_label) {
        ?>
        <div class="fs-list-radio">
            <input name="<?php echo $name ?>"
                   type="radio"
                   class="with-gap <?php echo $class ?>"
                   id="<?php echo $key ?>"
                   value="<?php echo $key ?>"
                <?php if (isset($value) && $value === $key): ?>
                    checked
                <?php endif ?>>
            <label for="<?php echo $key ?>"><?php echo $radio_label ?></label>
        </div>

        <?php
    }
    ?>
</div>