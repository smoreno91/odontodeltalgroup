<div class="form-line <?php echo isset($class) ? $class : ''; ?>">
    <textarea
            rows="<?php echo isset($rows) ? $rows : 4; ?>"
            class="form-control no-resize <?php echo isset($class) ? $class : ''; ?>"
            name="<?php echo $name; ?>"
            id="<?php echo $id; ?>"
            placeholder="<?php echo $place_holder; ?>"
        <?php foreach ($attrs as $attr): ?>
            <?php echo $attr; ?>
        <?php endforeach; ?>
    ><?php echo $value; ?></textarea>
</div>