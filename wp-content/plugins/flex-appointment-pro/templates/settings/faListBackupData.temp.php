<?php
/**
 * @team: FsFlex Team
 * @since: 1.0.0
 * @author: KP
 */
foreach ($list_zip as $item) {
    $name = basename($item);
    $size = round(filesize($item) / 1024, 2);
    ?>
    <div class="fa-item">
        <div class="fa-item-name">
            <h3><?php echo $name ?></h3>
            <div class="fa-item-size">(<?php echo $size . ' KB'; ?>)</div>
        </div>
        <div class="fa-item-btn">
            <a class="dashicons dashicons-download fa-btn-download"
               href="?file=<?php echo base64_encode($item) ?>"></a>
            <a class="dashicons dashicons-no fa-btn-delete" item-data="<?php echo base64_encode($item) ?>"></a>
        </div>
    </div>
    <?php
}
