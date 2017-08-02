<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function xyz_dbx_network_destroy($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				dbx_destroy();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	dbx_destroy();
}

function dbx_destroy()
{
	global $wpdb;
	delete_option("xyz_dbx_tinymce");
	if(get_option('xyz_credit_link')=="dbx")
	{
		update_option("xyz_credit_link", '0');
	}
	delete_option("xyz_dbx_html");
	delete_option("xyz_dbx_top");
	delete_option("xyz_dbx_width");
	delete_option("xyz_dbx_height");
	delete_option("xyz_dbx_left");
	
	delete_option("xyz_dbx_enable");
	delete_option("xyz_dbx_showing_option");
	delete_option("xyz_dbx_adds_enable");
	delete_option("xyz_dbx_cache_enable");
	
	delete_option("xyz_dbx_delay");
	delete_option("xyz_dbx_page_count");
	delete_option("xyz_dbx_mode"); //page_count_only,both are other options
	delete_option("xyz_dbx_repeat_interval");
	delete_option("xyz_dbx_repeat_interval_timing");//hrs or  minute
	delete_option("xyz_dbx_z_index");
	delete_option("xyz_dbx_color");	
	delete_option("xyz_dbx_corner_radius");
	delete_option("xyz_dbx_width_dim");
	delete_option("xyz_dbx_height_dim");
	delete_option("xyz_dbx_left_dim");
	delete_option("xyz_dbx_top_dim");
	delete_option("xyz_dbx_border_color");
	delete_option("xyz_dbx_bg_color");
	delete_option("xyz_dbx_opacity");
	delete_option("xyz_dbx_border_width");
	delete_option("xyz_dbx_page_option");
	delete_option("xyz_dbx_close_button_option");
	delete_option("xyz_dbx_iframe");
	
	delete_option("xyz_dbx_positioning");
	delete_option("xyz_dbx_position_predefined");
	delete_option("xyz_dbx_display_position");
	
	delete_option("popup_installed_date");
	

}

register_uninstall_hook(XYZ_DBX_PLUGIN_FILE,'xyz_dbx_network_destroy');


?>
