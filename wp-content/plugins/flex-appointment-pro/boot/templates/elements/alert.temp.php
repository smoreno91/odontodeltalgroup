<div class="alert <?php echo $class; ?>" >
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <h4 class="title" style="font-weight:bold"><?php echo $title ?></h4>
    <p>
        <?php if (is_array($body)): ?>
        <ul>
            <?php foreach($body as $message): ?>
                <li><?php echo $message ?></li>
            <?php endforeach ?>
        </ul>
        <?php else: ?>
            <?php echo $body ?>
        <?php endif ?>
    </p>
</div>