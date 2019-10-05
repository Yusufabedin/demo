<?php

/*
Plugin Name: posts to qrcode
Plugin URI: https://learnwith.yusuf.com
Description: Display QR Code under ever posts 
Version: 1.0
Author: yusuf
Author URI: https://www.facebook.com/
License: GPLv2 or later
Text Domain: posts-to-qrcode
Domain Path: /languages/
*/
// funtion wordcount_activation_hook(){}
// register_activation_hook(__FILE__,"wordcount_activation_hook");
// funtion wordcount_deactivation_hook(){}
// register_deactivation_hook(__FILE__,"wordcount_deactivation_hook");*/

/*chekebox & select er county list */
 $pqrc_countries = array(
     __('Afganistan','posts-to-qrcode'),
     __('Bangladesh','posts-to-qrcode'),
     __('Bhutan','posts-to-qrcode'),
     __('India','posts-to-qrcode'),
     __('Maldives', 'posts-to-qrcode'),
     __('Nepal','posts-to-qrcode'),
     __('Pakisthan','posts-to-qrcode'),
     __('Sri Lanka','posts-to-qrcode')

	);

	function pqrc_init(){
		global $pqrc_countries;
 		$pqrc_countries = apply_filters('pqrc_s_countries',$pqrc_countries);
	}
 	add_action("init",'pqrc_init');




function wordcount_load_textdomain(){
  load_plugin_textdomain('posts-to-qrcode',false,dirname(__FILE__)."/languages");
}

function pqrc_display_Qr_code($content){
	$current_post_id = get_the_ID();
	 $current_post_title = get_the_title($current_post_id);
	$current_post_url = urlencode(get_the_permalink($current_post_id));
	$current_post_type = get_post_type($current_post_id);

  // post type check
   $excluded_post_types = apply_filters('pqrc_excluded_post_types',array());
 
  if(in_array($current_post_type,$excluded_post_types)){
 	return $content; 
 }
 //Dimension Hook
 $height = get_option('pqrc_height');
 $width = get_option('pqrc_width');
 $height = $height ? $height : 180;
 $width = $width ? $width : 180;
 $dimension = apply_filters('pqrc_qrcode_dimension',"{$width}x{$height}");

// image Attributes
 $image_attributes = apply_filters('pqrc_image_attributes','');

$image_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&data=%s',$dimension,$current_post_url);
$content .= sprintf("<div class='Qrcode'><img %s src='%s' alt='%s'/></div>",$image_attributes,$image_src,$current_post_title);
return $content;
}
add_filter('the_content' ,'pqrc_display_Qr_code');

//setting option creat
function pqrc_settings_init(){
	//fild gulo group e rakhte
	add_settings_section('pqrc_section',__('Posts to QR code','posts-to-qrcode'),'pqrc_section_callback','general');
 //add field
add_settings_field('pqrc_height',__('QR_Code_Height','posts-to-qrcode'),'pqrc_display_field','general','pqrc_section',array('pqrc_height'));

	add_settings_field('pqrc_width',__('QR_Code_Width ','posts-to-qrcode'),'pqrc_display_field','general','pqrc_section',array('pqrc_width'));
	//extra field   
	// add_settings_field('pqrc_extra',__('Extra Field','posts-to-qrcode'),'pqrc_display_field','general','pqrc_section',array('pqrc_extra'));

	//select field by country 7.4 vedio
	add_settings_field('pqrc_select',__('Dropdown','posts-to-qrcode'),'pqrc_display_select_field','general','pqrc_section'); 

		//group checkbox 7.5 vedio
	 add_settings_field('pqrc_checkbox',__('Select Countries','posts-to-qrcode'),'pqrc_display_checkboxgroup_field','general','pqrc_section'); 
	 //loggle field
	  add_settings_field('pqrc_toggle',__('Toggle Field','posts-to-qrcode'),'pqrc_display_toggle_field','general','pqrc_section'); 

    //registertion
    register_setting('general','pqrc_height',array('sanitize_callback'=>'esc_attr'));
    register_setting('general','pqrc_width',array('sanitize_callback'=>'esc_attr')); 
     // register_setting('general','pqrc_extra',array('sanitize_callback'=>'esc_attr'));
     register_setting('general','pqrc_select',array('sanitize_callback'=>'esc_attr'));
      register_setting('general','pqrc_checkbox');
      //toggle reg
      register_setting('general','pqrc_toggle');
   

}  

//chekebox function
function pqrc_display_checkboxgroup_field(){
	global $pqrc_countries;
	$option = get_option('pqrc_checkbox');
	 foreach ($pqrc_countries as $country) {
		$selected = '';
		if ( is_array($option) && in_array($country,$option)){
			$selected = 'checked';
		}
		
		printf('<input type="checkbox" name="pqrc_checkbox[]" value="%s" %s /> %s <br/>',$country,$selected,$country);
	}
	
}

//function countries
function pqrc_display_select_field(){
	global $pqrc_countries;
	$option = get_option('pqrc_select');
	// $countries = array(
 //     'None',
 //     'Afganistan',
 //     'Bangladesh',
 //     'Bhutan',
 //     'India',
 //     'Maldives',
 //     'Nepal',
 //     'Pakisthan',
 //     'Sri Lanka', 

	// );
	printf('<select id="%s" name="%s">','pqrc_select','pqrc_select');
	foreach ($pqrc_countries as $country) {
		$selected = '';
		if ($option == $country) {
		 $selected='selected';
		}
		printf('<option value="%s" %s>%s</option>',$country,$selected,$country);
	}
	echo "</select> ";
}

 
function pqrc_section_callback(){
	echo "<p>".__('Settings for Posts To QR Plugin','posts-to-qrcode')."</p>";
}
//singel call back
function pqrc_display_field($args){
	$option = get_option($args[0]);
	printf("<input type='text' id='%s' name='%s' value='%s'/>", $args[0],$args[0],$option);
} 
//call backs
function pqrc_display_height(){
	$height = get_option('pqrc_height');
	printf("<input type='text' id='%s' name='%s' value='%s'/>",'pqrc_height','pqrc_height',$height);
}
function pqrc_display_width(){
	$width = get_option('pqrc_width');
	printf("<input type='text' id='%s' name='%s' value='%s'/>",'pqrc_width','pqrc_width',$width);
}

 
add_action("admin_init",'pqrc_settings_init'); 

//Toggle button 7.7
function pqrc_display_toggle_field(){
	$option = get_option('pqrc_toggle');
	echo '<div id="toggle1"></div>';
	echo "<input type ='hidden' name = 'pqrc_toggle' id='pqrc_toggle' value='".$option."'/>";
}
function pqrc_assets($screen){
	if ('options-general.php'==$screen ) {
	wp_enqueue_style('pqrc-minitoogl-css',plugin_dir_url(__FILE__)."/assets/css/minitoggle.css");	

	wp_enqueue_script('pqrc-minitoogl-js',plugin_dir_url(__FILE__)."/assets/js/minitoggle.js", array('jquery'),"1.0",true);

	wp_enqueue_script('pqrc-main-js',plugin_dir_url(__FILE__)."/assets/js/main.js", array('jquery'),time(),true);
	}
}

add_action('admin_enqueue_scripts','pqrc_assets');