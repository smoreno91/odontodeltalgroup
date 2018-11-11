<?php
vc_map(array(
    "name" => 'CMS Schedule Calendar',
    "base" => "cms_schedule_calendar",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" =>  '',
    "admin_enqueue_js"=>get_template_directory_uri() . '/inc/elements/cms_schedule_calendar/admin_editor.js',
    "admin_enqueue_css"=>get_template_directory_uri() . '/inc/elements/cms_schedule_calendar/admin_editor.css',
    "params" => array(
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Members', 'medix' ),
            'param_name' => 'medix_calendar_members',
            'description' => esc_html__( 'Enter values for feature', 'medix' ),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Name",'medix'),
                    "param_name" => "name",
                    'admin_label' => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Clinic",'medix'),
                    "param_name" => "clinic",
                    'admin_label' => true,
                ),
                array(
                    "type" => "vc_link",
                    "heading" =>esc_html__("Url",'medix'),
                    "param_name" => "url",
                    'admin_label' => true,
                ),
            ),
        ),
        array(
            'type'=>'textarea_raw_html',
            'class'=>'hidden',
            'param_name' => 'medix_calendar_save_data',
            'dependency'=>array(
                'callback'=>'medix_calendar_init_trigger'
            ),
        ),
        array(
            'type'=>'medix_calendar_editor',
            'param_name' => 'medix_calendar_editor',
            'title'=> __('Edit Calendar Table','medix')
        )

    )
));
vc_add_shortcode_param( 'medix_calendar_editor', 'medix_calendar_set_html_calendar_editor_vc_map' );
if(!function_exists('medix_calendar_set_html_calendar_editor_vc_map'))
{
    function medix_calendar_set_html_calendar_editor_vc_map( $settings, $value ) {
        ob_start();
        ?>
        <div class="medix_calendar_button">
                <span>
                    <?php esc_attr_e($settings['title']) ?>
                </span>
        </div>


        <div id="medix_calendar_editor_" class="admin-calendar-editor" style="display: none">
            <div>
                <label class="lbl"><?php _e('Set Calendar For','medix') ?></label>
                <select id="medix_calendar_select_">
                </select>
            </div>
            <div id="medix_calendar_table_" class="admin-calendar-table" >

            </div>
        </div>
        <?php
        return ob_get_clean(); // New button element
    }
}
class WPBakeryShortCode_cms_schedule_calendar extends CmsShortCode
{
    protected function content($atts, $content = null){
        return parent::content($atts, $content);
    }

}
