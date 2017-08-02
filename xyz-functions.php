<?php

if ( ! defined( 'ABSPATH' ) ) exit;
if(!function_exists('xyz_dbx_plugin_get_version'))
{
	function xyz_dbx_plugin_get_version() 
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( XYZ_DBX_PLUGIN_FILE ) ) );
		// 		print_r($plugin_folder);
		return $plugin_folder['popup-dialog-box.php']['Version'];
	}
}



add_filter( 'plugin_row_meta','xyz_dbx_links',10,2);
function xyz_dbx_links($links, $file) 
{
	$base = plugin_basename(XYZ_DBX_PLUGIN_FILE);
	if ($file == $base) 
	{
		
		$links[] = '<a href="http://help.xyzscripts.com/docs/popup-dialog-box/faq/"  title="FAQ">FAQ</a>';
		$links[] = '<a href="http://help.xyzscripts.com/docs/popup-dialog-box/"  title="Read Me">README</a>';
		$links[] = '<a href="http://xyzscripts.com/donate/1" title="Donate">DONATE</a>';
		
		$links[] = '<a href="http://xyzscripts.com/support/" class="xyz_support" title="Support"></a>';
		$links[] = '<a href="http://twitter.com/xyzscripts" class="xyz_twitt" title="Follow us on twitter"></a>';
		$links[] = '<a href="https://www.facebook.com/xyzscripts" class="xyz_fbook" title="Facebook"></a>';
		$links[] = '<a href="https://plus.google.com/+Xyzscripts/" class="xyz_gplus" title="+1 us on Google+"></a>';
		$links[] = '<a href="http://www.linkedin.com/company/xyzscripts" class="xyz_linkedin" title="Follow us on linkedin"></a>';

	}
	return $links;
}

?>