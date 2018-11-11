<?php
/**
 * User: KP
 * Date: 5/29/2017
 * Time: 13:56
 */
$options = get_option('fa-setting');
?>
<div class="fa-pages-select">
    <select name="page_id_redirect">
        <?php
        foreach ($pages as $page) {
            ?>
            <option value="<?php echo $page->ID ?>" <?php if(isset($options['page_id_redirect']) && $options['page_id_redirect'] == $page->ID) echo "selected"?>><?php echo $page->post_title ?></option>
            <?php
        }
        ?>
    </select>
</div>
