<?php
?>
<div id="booked-defaults" class="tab-content" style="display: block;">
    <div id="bookedTimeslotsWrap">
        <table class="booked-timeslots">
            <tbody>
            <tr>
                <?php
                foreach ($option as $key => $day_data):
                    ?>
                    <td>
                        <table>
                            <thead>
                            <tr>
                                <th data-day="<?php echo $key ?>"><p class="fa_title_day"><?php echo $day_data ?></p>
                                    <a class="fa-btn-add-timeslot button">Add...</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td data-day="<?php echo $key ?>"
                                    class="fa-add-area fa-add-time-slot-<?php echo $key ?>"></td>
                            </tr>
                            <tr class="fa-ts-content">
                                <td class="dayTimeslots" id="fa-day-ts-<?php echo $key ?>"
                                    data-day="<?php echo $key ?>">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <?php
                endforeach;
                ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="fa-add-timeslots-temp" class="bookedClearFix fa-add-timeslots-temp" style="display: none;">
        <div class="timeslotTabs bookedClearFix">
            <h3 class="fa-add-title"><?php esc_html_e('Add Time Slot','flex-appointments')?></h3>
        </div>
        <div class="fa-add-content" style="display: block;">

        </div>
        <span class="fa-cancel-add btn"><?php esc_html_e('Cancel','flex-appointments')?></span>
        <a class="fa-add-submit_ts btn btn-primary"><?php esc_html_e('Add','flex-appointments')?></a>
        <div class="fa-add-noti">
            <div class="fa-add-wait la-ball-clip-rotate-multiple la-dark la-sm">
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>
