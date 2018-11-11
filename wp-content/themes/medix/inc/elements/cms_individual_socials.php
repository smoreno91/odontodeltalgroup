<?php
vc_map(array(
    "name" => 'CMS Individual Social',
    "base" => "cms_individual_social",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CmsSuperheroes Shortcodes', 'medix'),
    "description" => esc_html__('Show social from theme option', 'medix'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Select social", 'medix'),
            "param_name" => "social_position",
            "value" => array(
                esc_html__('From Header Top Setting', 'medix') => 'header_top',
                esc_html__('From Header Setting', 'medix') => 'header',
                esc_html__('From Footer Top Layout 1', 'medix') => 'footer_top_layout1',
                esc_html__('From Footer Top Layout 3', 'medix') => 'footer_top_layout3',
                esc_html__('From Footer Bottom Layout 4', 'medix') => 'footer_bottom_layout4',
            ),
            'std' => 'header',
        ),
        
        array(
            'type' => 'dropdown',
            'heading' => 'Type',
            'param_name' => 'social_type',
            'value' => array(
                esc_html__('Color background icon', 'medix') => 'color-bg-icon',
                esc_html__('Color icon and background icon', 'medix') => 'color-icon bg-icon',
                esc_html__('Color icon', 'medix') => 'color-icon',
            ),
            'std' => 'color-bg-icon',
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__("Round", 'medix'),
            'param_name' => 'social_round',
            'value' => array(
                'Yes' => true
            ),
            'std' => false,
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Layout',
            'param_name' => 'social_layout',
            'value' => array(
                esc_html__('Layout 1 (Default)', 'medix') => 'layout1',
                esc_html__('Layout 2 (vertical with title)', 'medix') => 'layout2',
            ),
            'std' => 'layout1',
        ),
    )
));
class WPBakeryShortCode_cms_individual_social extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}