jQuery(document).ready(function($) {
	
	var xyz_dbx_shortcode=0;
	
	if(jQuery("#xyz_dbx_shortcode").length>0)
	{	
		 xyz_dbx_shortcode=1;
		
	}   
		
	//alert(shortcode);
	var data = {
		action: 'xyz_dbx_action',
		xyz_dbx_shortcd:xyz_dbx_shortcode,
		xyz_dbx_pg:xyz_dbx_ajax_object.ispage,
		xyz_dbx_ps:xyz_dbx_ajax_object.ispost,
		xyz_dbx_hm:xyz_dbx_ajax_object.ishome// Pass php values
	};
	// Pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(xyz_dbx_ajax_object.ajax_url, data, function(response) {
		if(xyz_dbx_shortcode==1)
		{
			if(response!=0)
			    jQuery("#xyz_dbx_shortcode").append(response);
		}	
		else
		{
			if(response!=0)
		        jQuery("#xyz_dbx_container").append(response);
		}
	});
});