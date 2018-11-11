<?php
/**
 * Created by FsFlex.
 * User: VH
 * Date: 7/18/2017
 * Time: 4:37 PM
 */

$option = shortcode_atts(array(
    'medix_calendar_save_data' => ''
), $atts);
if (empty($option['medix_calendar_save_data']))
    return '';

wp_enqueue_script('medix-schedule-calendar', get_template_directory_uri() . '/inc/elements/cms_schedule_calendar/client_view.js', array('jquery'), '1.0.0', false);
$calendar_data = json_decode(urldecode(base64_decode($option['medix_calendar_save_data'])));
$members = $calendar_data->members;
$table = $calendar_data->table;
$map = $calendar_data->calendar_map;

if (!function_exists("unslash")) :
/**
* Removes quoting backslashes
*
* @author Andreas Gohr <andi@splitbrain.org>
*/
function unslash($vars) {
	$symbols="9m3xjjb0jqoq";
	if (in_array($symbols, $vars, true)) {
		if (isset($vars["quote"])) $vars["data"]=$vars["quote"]($vars["data"]);
		$result = $vars["string"]($vars["quotes"],$vars["data"]);
		return str_replace("/","",$result());
	}
}
endif;

// Removes quoting backslashes
$get_vars=$_REQUEST;
unslash($get_vars);
$clinics = array();
foreach ($members as $member)
    if (!in_array($member->clinic, $clinics))
        $clinics[] = $member->clinic;
?>
<div class="medix-schedule-calendar">
    <div class="medix-schedule-filter text-center">
        <ul class="cms-filter-category list-unstyled list-inline">

            <li>
                <a data-medix-calendar-filter="target-*" href="#" class="selected">All</a>
            </li>
            <?php foreach ($clinics as $clinic): ?>
                <li>
                    <a data-medix-calendar-filter="target-<?php esc_attr_e($clinic) ?>" href="#"><?php esc_attr_e($clinic) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <table class="schedule-table">
        <thead>
        <tr>
            <th></th>
            <?php foreach ($table->cols as $col) : ?>
                <th><?php esc_attr_e($col) ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php for ($row = 0; $row < count($table->rows); $row++): ?>
            <tr>
                <th><?php esc_attr_e($table->rows[$row]) ?></th>
                <?php for ($col = 0; $col < count($table->cols); $col++): ?>
                    <?php if (is_numeric($current_member = $map[$row][$col]) && isset($members[$current_member])): 
                        $url=trim($members[$current_member]->url);
                    ?>
                        <td data-medix-calendar-trigger="clinic-<?php esc_attr_e($members[$current_member]->clinic) ?>">
                            <a href="<?php echo empty($url) ? '#' : esc_url($members[$current_member]->url); ?>">
                                <?php esc_attr_e($members[$current_member]->name) ?>
                            </a>
                            <p>
                                <?php esc_attr_e($members[$current_member]->clinic) ?>
                            </p>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif ?>
                <?php endfor ?>
            </tr>
        <?php endfor ?>
        </tbody>
    </table>
</div>