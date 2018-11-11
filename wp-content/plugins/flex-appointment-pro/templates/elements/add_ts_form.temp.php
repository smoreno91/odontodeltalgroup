<select name="startTime" class="select_start_time">
    <option value="">Start time ...</option>
    <option value="allday">All Day</option>
    <?php
    for ($i = 0; $i <= 1440; $i += $time_intervals):
        ?>
        <option value="<?php echo convertTimeValue($i)['val'] ?>"><?php echo convertTimeValue($i)['interface'] ?></option>
        <?php
    endfor;
    ?>
</select>
<select name="endTime" class="select_end_time">
    <option value="">End time ...</option>
    <?php
    for ($i = 0; $i <= 1440; $i += $time_intervals):
        ?>
        <option value="<?php echo convertTimeValue($i)['val'] ?>"><?php echo convertTimeValue($i)['interface'] ?></option>
        <?php

    endfor;
    ?>
</select>
<select name="fa-count" class="select_space_count">
    <option value="1">1 space available</option>
    <?php
    for ($i = 2; $i <= 100; $i++) :
        ?>
        <option value="<?php echo $i ?>"><?php echo $i ?> spaces available</option>
        <?php
    endfor;
    ?>
</select>