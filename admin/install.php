<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function xyz_dbx_network_install($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				dbx_install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	dbx_install();
}

function dbx_install()
{
	global $wpdb;
	if(get_option('xyz_credit_link')=="")
	{
		add_option("xyz_credit_link", '0');
	}
	
	
	
	$popup_installed_date = get_option('popup_installed_date ');
	if ($popup_installed_date =="") {
		$popup_installed_date = time();
		update_option('popup_installed_date', $popup_installed_date);
	}
	
	
	
	
	
	
	
	
	
	add_option("xyz_dbx_tinymce", '1');

add_option("xyz_dbx_enable", '1');
add_option('xyz_dbx_showing_option','0,0,0');
add_option("xyz_dbx_adds_enable", '1');
add_option("xyz_dbx_cache_enable", '0');
	add_option("xyz_dbx_html", 'Hello world.');
	add_option("xyz_dbx_top", '25');
	add_option("xyz_dbx_width", '500');
	add_option("xyz_dbx_height", '50');
	add_option("xyz_dbx_left", '25');
	add_option("xyz_dbx_right", '25');
	add_option("xyz_dbx_bottom", '25');
	add_option("xyz_dbx_display_position", '1');
	add_option("xyz_dbx_delay", '0');
	add_option("xyz_dbx_page_count", '1');
	add_option("xyz_dbx_mode", 'delay_only'); //page_count_only,both are other options
	add_option("xyz_dbx_repeat_interval", '1');
	add_option("xyz_dbx_repeat_interval_timing", '1');//hrs or  minute
	add_option("xyz_dbx_z_index",'10000');
		
	add_option("xyz_dbx_corner_radius",'5');
	add_option("xyz_dbx_width_dim",'px');
	add_option("xyz_dbx_height_dim",'px');
		add_option("xyz_dbx_right_dim",'%');
		add_option("xyz_dbx_bottom_dim",'%');
		add_option("xyz_dbx_left_dim",'%');
		add_option("xyz_dbx_top_dim",'%');
	add_option("xyz_dbx_border_color",'#c33c3c');
	add_option("xyz_dbx_bg_color",'#ffffff');
	add_option("xyz_dbx_title",'Title');
	add_option("xyz_dbx_title_color",'#fcfcfa');
	add_option("xyz_dbx_border_width",'5');
	add_option("xyz_dbx_page_option",'1');
	add_option("xyz_dbx_close_button_option",'1');
	add_option("xyz_dbx_iframe",'0');
	
	add_option("xyz_dbx_positioning",'1');
	add_option("xyz_dbx_position_predefined","4");
	
	$version=get_option('xyz_dbx_free_version');
	$currentversion=xyz_dbx_plugin_get_version();
	if($version=="")
	{
		add_option("xyz_dbx_free_version", $currentversion);
	}
	else
	{
	
		update_option('xyz_dbx_free_version', $currentversion);
	}
	
}
//register_activation_hook(XYZ_DBX_PLUGIN_FILE,'dbx_install');
register_activation_hook( XYZ_DBX_PLUGIN_FILE ,'xyz_dbx_network_install');

?>
