<div class="row clearfix materialize">
    <div class="col-lg-2 form-control-label">
        <?php if(isset($label) && isset($id)): ?>
            <label class="custom_label" for="<?php echo $id ?>"><?php echo $label ?></label>
        <?php endif ?>
    </div>
    <div class="col-lg-10">
        <div class="form-group">
            <div class="form-line">
                <input
                    type="text"
                    class="tagsinput form-control <?php echo $class; ?>"
                    placeholder="<?php echo $place_holder; ?>"
                    name="<?php echo $name; ?>"
                    data-value="<?php echo $value ?>"
                    <?php if(isset($tags) && count($tags) > 0): ?>
                        data-tags="<?php echo base64_encode(json_encode($tags)) ?>"
                    <?php endif ?>
                    id="<?php echo $id; ?>"
                    <?php foreach($attrs as $attr): ?>
                        <?php echo $attr; ?>
                    <?php endforeach; ?>
                >
            </div>
            <?php if(isset($description)): ?>
                <div class="note" style="font-style: italic;color:gray">(<?php echo $description ?>)</div>
            <?php endif ?>
        </div>
    </div>
</div>