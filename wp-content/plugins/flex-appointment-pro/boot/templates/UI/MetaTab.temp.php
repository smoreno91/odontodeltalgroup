<div class="materialize">
    <ul class="nav nav-tabs" role="tablist">
        <?php if (isset($tabs) && is_array($tabs)): foreach ($tabs as $key => $tab):
            $active = false;
            $icon = '';
            $title = '';
            $description = '';
            extract($tab);
            ?>
            <li role="presentation" class="<?php echo $active == true ? 'active' : ''; ?>"
                title="<?php echo $description; ?>">
                <a href="<?php echo '#' . $key; ?>" data-toggle="tab">
                    <i class="material-icons"><?php echo $icon; ?></i>
                    <?php
                    echo $title;
                    ?>
                </a>
            </li>
        <?php endforeach; endif; ?>
    </ul>

    <div class="tab-content">
        <?php if (isset($tabs) && is_array($tabs)): foreach ($tabs as $key => $tab):
            $active = false;
            $content = '';
            extract($tab);
            ?>
            <div role="tabpanel" class="tab-pane <?php echo $active == true ? 'active' : ''; ?>"
                 id="<?php echo $key; ?>">
                <?php echo $content; ?>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>