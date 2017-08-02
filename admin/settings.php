<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if(isset($_GET['popup_notice']) && $_GET['popup_notice'] == 'hide')
{
	
	if (
			! isset( $_REQUEST['_wpnonce'] )
			|| ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'hide_notice' )
	) {
		wp_nonce_ays( 'hide_notice' );
	
		exit();
	
	}
	
	
	
	update_option('xyz_popup_dnt_shw_notice', "hide");
	?>
<style type='text/css'>
#popup_notice_td
{
display:none;
}
</style>
<div class="system_notice_area_style1" id="system_notice_area">
Thanks again for using the plugin. We will never show the message again.
&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}

$xyz_dbx_tinymce=get_option("xyz_dbx_tinymce");
$xyz_credit_link=get_option('xyz_credit_link');

$xyz_dbx_enable=get_option('xyz_dbx_enable');
$xyz_dbx_adds_enable=get_option('xyz_dbx_adds_enable');
$xyz_dbx_cache_enable=get_option('xyz_dbx_cache_enable');
?>
<h2>Basic Settings</h2>
<form method="post" >
<?php wp_nonce_field( 'add-basic-setting' );?>
<table  class="widefat" style="width:98%">

<tr valign="top" id="xyz_dbx">

<td scope="row" colspan="1" width="50%"><label for="xyz_dbx_tinymce">Enable tiny MCE filter to prevent auto removal of &lt br &gt and &lt p &gt tags ?</label>	</td>

<td><select name="xyz_dbx_tinymce" id="xyz_dbx_tinymce" >

<option value ="1" <?php if($xyz_dbx_tinymce=='1') echo 'selected'; ?> >Yes </option>

<option value ="0" <?php if($xyz_dbx_tinymce=='0') echo 'selected'; ?> >No </option>
</select>
</td>

</tr>

<tr valign="top" id="xyz_dbx">

<td scope="row" colspan="1"><label for="xyz_dbx_credit_link">Enable credit link to author ?</label>	</td><td><select name="xyz_credit_link" id="xyz_dbx_credit_link" >

<option value ="dbx" <?php if($xyz_credit_link=='dbx') echo 'selected'; ?> >Yes </option>

<option value ="<?php echo $xyz_credit_link!='dbx'?$xyz_credit_link:0;?>" <?php if($xyz_credit_link!='dbx') echo 'selected'; ?> >No </option>
</select>
</td></tr>




<tr valign="top" id="xyz_dbx">

<td scope="row" colspan="1" width="50%"><label for="xyz_dbx_enable">Enable Dialogbox Popup ?</label>	</td>

<td><select name="xyz_dbx_enable" id="xyz_dbx_enable" >

<option value ="1" <?php if($xyz_dbx_enable=='1') echo 'selected'; ?> >Yes </option>

<option value ="0" <?php if($xyz_dbx_enable=='0') echo 'selected'; ?> >No </option>
</select>
</td>

</tr>

<tr valign="top" id="xyz_dbx">

<td scope="row" colspan="1" width="50%"><label for="xyz_dbx_cache_enable">Compatible with cache plugin ?</label>	</td>

<td><select name="xyz_dbx_cache_enable" id="xyz_dbx_cache_enable" >
<option value ="0" <?php if($xyz_dbx_cache_enable=='0') echo 'selected'; ?> >No </option>
<option value ="1" <?php if($xyz_dbx_cache_enable=='1') echo 'selected'; ?> >Yes </option>


</select>
</td>

</tr>


<tr valign="top" id="xyz_dbx">

<td scope="row" colspan="1" width="50%"><label for="xyz_dbx_adds_enable">Enable premium version ads ?</label>	</td>

<td><select name="xyz_dbx_adds_enable" id="xyz_dbx_adds_enable" >
<option value ="0" <?php if($xyz_dbx_adds_enable=='0') echo 'selected'; ?> >No </option>
<option value ="1" <?php if($xyz_dbx_adds_enable=='1') echo 'selected'; ?> >Yes </option>


</select>
</td>

</tr>




<tr>
<td scope="row"> </td>
<td>
<input type="submit" value=" Update Settings " /></td>
</tr>


</table></form>
<?php 










































?>
