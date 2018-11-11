<div class="row clearfix materialize">
    <div class="col-lg-2 form-control-label">
        <label class="custom_label" for="<?php echo $id; ?>"><?php echo $label ?></label>
    </div>
    <div class="col-lg-10">
        <div class="form-group">
            <input
                type="checkbox"
                id="<?php echo $id; ?>"
                name="<?php echo $name; ?>"
                class="chk-col-light-blue"
                value="<?php echo $value?>"
                <?php if($value=='yes'): ?>
                    checked
                <?php endif ?>
            >

            <label for="<?php echo $id; ?>"></label>
            <?php if(isset($description)): ?>
            <div class="note" style="font-style: italic;color:gray">(<?php echo $description ?>)</div>
            <?php endif ?>
        </div>
        <input type="hidden" name="<?php echo $name ?>_checkbox" value="<?php echo $value?>">
    </div>
</div>