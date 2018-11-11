<div class="row clearfix materialize">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
        <?php if(isset($label)){ ?>
        <label class="custom_label" <?php if(isset($id)){?> for="<?php echo $id ?>"<?php }?> style="display: inline-block;"><?php echo $label ?></label>
        <?php } ?>
    </div>
    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
        <div class="form-group">
            <div class="form-line">
                <input
                    type="text"
                    class="form-control <?php echo isset($class) ? $class : ''; ?>"
                    placeholder="<?php echo isset($place_holder) ? $place_holder : ''; ?>"
                    name="<?php echo $name; ?>"
                    id="<?php echo isset($id) ? $id : ''; ?>"
                    <?php
                    if(isset($attrs))
                    foreach($attrs as $attr): ?>
                        <?php echo $attr; ?>
                    <?php endforeach; ?>
                    value="<?php echo $value; ?>"
                >
            </div>
            <?php if(isset($description)): ?>
                <div class="note" style="font-style: italic;color:gray">(<?php echo $description ?>)</div>
            <?php endif ?>
        </div>
    </div>
</div>