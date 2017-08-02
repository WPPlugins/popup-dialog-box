<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$xyz_dbx_cache_enable=get_option('xyz_dbx_cache_enable');
$xyz_dbx_enable=get_option('xyz_dbx_enable');
$page_option=get_option('xyz_dbx_page_option');
if($xyz_dbx_enable==1)
{
	if($xyz_dbx_cache_enable==1)
	{
		add_shortcode( 'xyz_dbx_default_code', 'xyz_dbx_shortcode' );
	}
	else 
	{
		if($page_option==3)
		   add_shortcode( 'xyz_dbx_default_code', 'xyz_dbx_display' );
	}			
}


function xyz_dbx_shortcode()
{
	return "<span id='xyz_dbx_shortcode'></span>";
}

?>