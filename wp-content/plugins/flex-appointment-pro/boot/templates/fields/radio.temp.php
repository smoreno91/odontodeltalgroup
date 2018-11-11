<?php
/**
 * Created by PhpStorm.
 * User: Mạnh Ninh
 * Date: 27/3/2017
 * Time: 3:27 PM
 */
?>
<?php if (isset($label)): ?>
    <label class="custom_label" <?php echo (isset($label_style) && $label_style === 'hidden') ? 'style="display:none;"' : ''; ?>><?php echo $label; ?></label>
<?php endif; ?>
<div class="fs-list-radio">
    <?php
    foreach ($options as $key => $radio_label) {
        ?>
        <input name="<?php echo $name ?>"
               type="radio"
               class="with-gap <?php echo $class ?>"
               id="<?php echo $key . $name ?>"
               value="<?php echo $key ?>" <?php echo (isset($value) && $value === $key) ? 'checked' : ''; ?>>
        <label for="<?php echo $key . $name ?>"><?php echo $radio_label; ?></label>

        <?php
    }
    ?>
</div>

