<div class="row clearfix <?php echo isset($class) ? $class : ''; ?>">

    <div class="col-xs-4 col-sm-4 form-control-label">
        <?php if (!isset($label_mode) || $label_mode !== false): ?>
            <label class="custom_label"><?php echo isset($label) ? $label : ''; ?></label>
        <?php endif; ?>
    </div>
    <div class="col-xs-8 col-sm-6">
        <div class="form-group">
            <?php if (isset($form_line) && ($form_line == false)): ?>
                <?php echo isset($content) ? $content : ''; ?>
            <?php else: ?>
                <div class="form-line">
                    <?php echo isset($content) ? $content : ''; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>