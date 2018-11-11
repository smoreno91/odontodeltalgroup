<div class="row clearfix materialize">
    <div class="col-lg-2 form-control-label">
        <?php if (isset($label) && isset($id)): ?>
            <label class="custom_label" for="<?php echo $id ?>"><?php echo $label ?></label>
        <?php endif ?>
    </div>
    <div class="col-lg-10">
        <div class="form-group">
            <div class="form-line">
            <textarea
                rows="4"
                class="form-control no-resize"
                name="<?php echo $name; ?>"
                id="<?php echo $id; ?>"
                placeholder="<?php echo $place_holder; ?>"
                <?php foreach ($attrs as $attr): ?>
                    <?php echo $attr; ?>
                <?php endforeach; ?>
                ><?php echo $value; ?></textarea>
            </div>
            <?php if (isset($description)): ?>
                <div class="note" style="font-style: italic;color:gray">(<?php echo $description ?>)</div>
            <?php endif ?>
        </div>
    </div>
</div>
