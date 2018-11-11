<div class="wrap materialize">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" jstcache="0">
        <div class="custom_card">
            <div class="header">
                <h2><?php echo htmlentities($title) ?>
                    <small><?php echo htmlentities($description)?></small>
                </h2>
            </div>
            <div class="body">
                <?php echo $this->autoCheckNotice() ?>
                <form method="POST">
                    <?php echo $body ?>
                    <button id="" type="submit" class="btn <?php echo htmlentities($button_class) ?> waves-effect" name="<?php echo $page_slug?>">Save Change</button>
                </form>
            </div>
        </div>
    </div>
</div>
