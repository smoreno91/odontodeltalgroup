<div class="<?php echo isset($group) ? $group : 'radio-group'; ?>">
    <?php
    if (isset($element)):
        foreach ($element as $value):
            ?>
            <input name="<?php echo isset($group_name) ? $group_name : 'group1'; ?>" type="radio"
                   id="<?php echo $value['id']; ?>"
                <?php echo $value['checked'] == true ? 'checked' : ''; ?>
            >
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            <?php
        endforeach;
    endif;
    ?>
</div>