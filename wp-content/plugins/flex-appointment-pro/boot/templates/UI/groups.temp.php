<div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
    <?php foreach ($groups as $slug => $group): ?>
        <div class="panel <?php echo isset($group['class_color']) ? $group['class_color'] : ''; ?>  <?php echo $group['class'] ?>">
            <div class="panel-heading" role="tab" id="<?php echo $tab . '-' . $slug ?>-head">
                <h4 class="panel-title">
                    <a role="button"
                       data-toggle="collapse"
                       data-parent="#accordion_1" href="#<?php echo $tab . '-' . $slug ?>"
                       aria-expanded="<?php echo (isset($group['actived']) && $group['actived'] === true) ? "true" : "false" ?>"
                       aria-controls="<?php echo $tab . '-' . $slug ?>"
                       class="collapsed">
                        <?php echo isset($group['icon']) ? $group['icon'] : ''; ?><?php echo $group['label'] ?>
                    </a>
                </h4>
            </div>
            <div id="<?php echo $tab . '-' . $slug ?>"
                 class="panel-collapse collapse <?php echo (isset($group['actived']) && $group['actived'] === true) ? "in" : "" ?>"
                 role="tabpanel"
                 aria-expanded="<?php echo (isset($group['actived']) && $group['actived'] === true) ? "true" : "false" ?>"
                <?php echo (isset($group['actived']) && $group['actived'] === true) ? "" : 'style="height: 0px;"' ?>>
                <div class="panel-body">
                    <?php echo $group['body'] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>