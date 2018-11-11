<div class="clearfix materialize">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs <?php echo htmlentities($tab_class) ?>" role="tablist">
            <?php foreach ($tabs as $slug => $tab): ?>
                <li role="presentation"
                    class="<?php if (isset($tab['actived']) && $tab['actived'] === true) echo 'active' ?>">
                    <a href="#<?php echo $slug ?>" data-toggle="tab">
                        <?php if (empty($tab['icon'])): ?>
                            <i class="material-icons"></i>
                            <?php
                        else:
                            echo $tab['icon'];
                        endif;
                        ?>
                        <?php if(isset($tab['title'])) echo $tab['title'] ?></a>
                </li>
            <?php endforeach ?>
        </ul>

        <div class="tab-content">
            <?php foreach ($tabs as $slug => $tab): ?>
                <div role="tabpanel"
                     class="tab-pane <?php if (isset($tab['actived']) && $tab['actived'] === true) echo 'active' ?>"
                     id="<?php echo $slug ?>">
                    <?php echo $tab['body'] ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
