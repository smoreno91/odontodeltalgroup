<?php 
$social_position  = $social_type = $social_layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$social_position = (!empty($social_position)) ? $social_position : 'header';
$social_type = (!empty($social_type)) ? $social_type : 'color-bg-icon';
$social_round = (!empty($social_round) && $social_round) ? 'round' : '';
$social_layout = (!empty($social_layout)) ? $social_layout : 'layout1';
 
if($social_layout == 'layout1'){
    medix_social_from_themeoption($social_position,$social_type,$social_round);
}
if($social_layout == 'layout2'){
    medix_social_from_themeoption_layout2($social_position,$social_type,$social_round);
}
 
