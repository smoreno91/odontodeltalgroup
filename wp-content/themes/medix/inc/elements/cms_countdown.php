<?php
vc_map(
	array(
		"name" => esc_html__("CMS Countdown",  'medix'),
	    "base" => "cms_countdown",
	    "class" => "vc-cms-countdown",
	    "category" => esc_html__("CmsSuperheroes Shortcodes",  'medix'),
	    "params" => array(
	        array(
	            "type" => "cms_time",
	            "heading" => esc_html__("Date count down", 'medix'),
	            "param_name" => "date_count_down",
	            "value" => "",
	            'admin_label' => true
	        ),
             
	    )
	)
);
class WPBakeryShortCode_cms_countdown extends CmsShortCode{ 
	protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}