<?php

/*
Plugin Name: Our Metabox
Plugin URI: https://learnwith.yusuf.com
Description: Metabox API Demo
Version: 1.0
Author: yusuf
Author URI: https://www.facebook.com/
License: GPLv2 or later
Text Domain: our-metabox
Domain Path: /languages/
*/   
 

//OOP STYLE
class Ourmetabox{
public function __construct(){
		add_action('plugins_loaded',array($this,'omb_load_textdomain'));
		add_action('admin_menu',array($this,'omb_add_metabox'));
		add_action('save_post',array($this,'omb_save_location'));

	}
	//meta box bar bar na likhe shorcut method
	private function is_secured($nonce_field, $action, $post_id){
		//secutiry parpass 11.3
		$nonce = isset($_POST['nonce_field']) ? $_POST['nonce_field'] :'';
		

		if($nonce==''){
			return false;
		}
 		 
 		//nonce verify korte
		if(!wp_verify_nonce($nonce,$action)){
			return false;
		}

		//current user post edit korte parbe 
		if(!current_user_can('edit_post',$post_id)){
			return false;
		}

		//post auto save
		if(wp_is_post_autosave($post_id)){
			return false;
		}
		//reviston

		if(wp_post_revision($post_id)){
			return false;
		}
 		return true;

	}


	//save add korar function
	function omb_save_location($post_id){
		//chake secured
		if(!$this->is_secured('omb_location_field','omb_location', $post_id)){
			return $post_id;
		}


		$location = isset($_POST['omb_location'])?$_POST['omb_location']:'';

		if($location==''){
			return $post_id;
		}
		update_post_meta($post_id,'omb_location',$location);

	}
	//metabox add korar function 
 
	function omb_add_metabox(){
		add_meta_box('omb_post_location',
			__('Location  info','our-metabox'), 
			array($this,'omb_display_post_location'),
			'post'

		); 
	}

	//funtion use by from display korte

	function omb_display_post_location($post){
		$location = get_post_meta($post->ID,'omb_location',true);
		$label = __('Location','our-metabox');
		//secutiry parpass 11.3
		wp_nonce_field('omb_location','omb_location_field');
		$metabox_html = <<<EOD
<p>
<label for="omb_location">{$label}</label>
<input type="text" name="omb_location" id="omb_location" value="{$location}"/>
</p>

EOD;
		echo $metabox_html;

	}


	public function omb_load_textdomain(){
		load_plugin_textdomain('our-metabox',false,dirname(__FILE__)."/languages");
	}
}

new OurMetabox();