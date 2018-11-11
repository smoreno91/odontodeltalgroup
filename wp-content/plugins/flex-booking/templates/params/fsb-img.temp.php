<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
if (!defined("ABSPATH")) {
    exit();
}
foreach ($settings['value'] as $key => $layout) {
    ?>
    <div class="fsb-img-item <?php echo (isset($value) && $value === $key) ? 'fsb-img-active' : '' ?>"
         fsb-data="<?php echo $key ?>">
        <img class="fsb-img-images" src="<?php echo $layout ?>" alt="<?php echo $key ?>">
    </div>
    <?php
}
?>
<input type="hidden" class="wpb_vc_param_value wpb-textinput fsb-img-val <?php echo $settings['param_name'] ?>"
       name="<?php echo $settings['param_name'] ?>" value="<?php echo isset($value) ? $value : '' ?>">