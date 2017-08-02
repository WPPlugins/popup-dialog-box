<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$xyz_dbx_cache_enable=get_option('xyz_dbx_cache_enable');
if($xyz_dbx_cache_enable==1)
{	
    add_action ( 'get_footer', 'xyz_dbx_container');//, [priority], [accepted_args] );
}
else 
{
	add_action ( 'get_footer', 'xyz_dbx_action_callback');
}	

function xyz_dbx_container()
{
	
	echo "<span id='xyz_dbx_container'></span>";
}

	add_action( 'wp', 'xyz_dbx_create' );

function xyz_dbx_create()
{
	global $xyz_dbx_cache_enable;
	
	$ispage=is_page()?1:0;
	$ispost=is_single()?1:0;
	$ishome=is_home()?1:0;
	
	wp_enqueue_script('jquery');
	
	if($xyz_dbx_cache_enable==1)
	{
	wp_enqueue_script( 'xyz_dbx_ajax_script', plugins_url( 'dbx_request.js', __FILE__ ), array('jquery') );
	wp_localize_script( 'xyz_dbx_ajax_script', 'xyz_dbx_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'ispage'=>$ispage,'ispost'=>$ispost,'ishome'=>$ishome) );

	}
}	
add_action( 'wp_ajax_xyz_dbx_action', 'xyz_dbx_action_callback' );
add_action( 'wp_ajax_nopriv_xyz_dbx_action', 'xyz_dbx_action_callback' );
	
function xyz_dbx_action_callback()
{	
	global $xyz_dbx_cache_enable;
	
	$page_option=get_option('xyz_dbx_page_option');
	$xyz_dbx_enable=get_option('xyz_dbx_enable');
	$xyz_dbx_showing_option=get_option('xyz_dbx_showing_option');
	
	if($page_option==2)
	{
		if($xyz_dbx_cache_enable==1)
		{
		$page=$_POST['xyz_dbx_pg'];
		$post=$_POST['xyz_dbx_ps'];
		$home=$_POST['xyz_dbx_hm'];
		}
		else 
		{
			$page=is_page()?1:0;
			$post=is_single()?1:0;
			$home=is_home()?1:0;
		}	
	  $xyz_dbx_sh_arr=explode(",", $xyz_dbx_showing_option);
		if (!(($xyz_dbx_sh_arr[0]==1 && $page==1) || ($xyz_dbx_sh_arr[1]==1 && $post==1 ) || ($xyz_dbx_sh_arr[2]==1 && $home==1 )))
			return;
	}
	
	if($page_option==3)
	{
		if($xyz_dbx_cache_enable==1)
		{
		$shortcode=$_POST['xyz_dbx_shortcd'];
		if($shortcode!=1)
			return;
		}
		else 
			return;
	}
	
   if($xyz_dbx_enable==1)
   
	  echo xyz_dbx_display();
   if($xyz_dbx_cache_enable==1)
   {
      die();
   }   
   
}

function xyz_dbx_display()
{
	$imgpath=plugins_url()."/popup-dialog-box/images/";
	$closeimage=$imgpath."close.png";
	$dbcloseimage=$imgpath."dbclose.png";

	$html=get_option('xyz_dbx_html');
	$top=get_option('xyz_dbx_top');
	$width=get_option('xyz_dbx_width');
	$height=get_option('xyz_dbx_height');
	$left=get_option('xyz_dbx_left');
	$bottom=get_option('xyz_dbx_bottom');
	$right=get_option('xyz_dbx_right');
	$delay=get_option('xyz_dbx_delay');
	$page_count=get_option('xyz_dbx_page_count');
	if($page_count==0) $page_count=1;
	$mode=get_option('xyz_dbx_mode');
	$repeat_interval=get_option('xyz_dbx_repeat_interval');
	$repeat_interval_timing=get_option('xyz_dbx_repeat_interval_timing');
	if($repeat_interval_timing==1)
	{
		$repeat_interval=$repeat_interval*60;
	}
$z_index=get_option('xyz_dbx_z_index');
$corner_radius=get_option('xyz_dbx_corner_radius');
$top_dim=get_option('xyz_dbx_top_dim');
$left_dim=get_option('xyz_dbx_left_dim');
$bottom_dim=get_option('xyz_dbx_bottom_dim');
$right_dim=get_option('xyz_dbx_right_dim');
$height_dim=get_option('xyz_dbx_height_dim');
$width_dim=get_option('xyz_dbx_width_dim');
$border_color=get_option('xyz_dbx_border_color');
$bg_color=get_option('xyz_dbx_bg_color');

$border_width=get_option('xyz_dbx_border_width');
$close_button_option=get_option('xyz_dbx_close_button_option');
$iframe_option=get_option('xyz_dbx_iframe');

 $position_option=get_option("xyz_dbx_display_position");
 $dbx_title=get_option("xyz_dbx_title");
 $dbx_title_color=get_option("xyz_dbx_title_color");
$positioning=get_option('xyz_dbx_positioning');
$position_predefined=get_option('xyz_dbx_position_predefined');
$referar_message_show_option=get_option('xyz_dbx_referar_message_show_option');
global $wpdb;

$tmp=ob_get_contents();
ob_clean();
ob_start();
	
?>
<style type="text/css">

.dbx_content {
display: none;
position: fixed;
_position: fixed;
  
<?php  if($positioning==1){if($position_option==1){?>;
top: <?php echo $top; echo $top_dim;?>;
left: <?php echo $left; echo $left_dim;?>;
<?php }?>
<?php  if($position_option==2){?>
top: <?php echo $top; echo $top_dim;?>;
right: <?php echo $right; echo $right_dim;?>;
<?php }?>
<?php  if($position_option==3){?>
bottom: <?php echo $bottom; echo $bottom_dim;?>;
left: <?php echo $left; echo $left_dim;?>;
<?php }?>
<?php  if($position_option==4){?>
bottom: <?php echo $bottom; echo $bottom_dim;?>;
right: <?php echo $right; echo $right_dim;?>;
<?php }}?>
width: <?php echo $width; echo $width_dim;?>;
height: <?php echo $height; echo $height_dim;?>;
padding: 0;
margin:0;
border: <?php echo $border_width; ?>px solid <?php echo $border_color;?>;
background-color: <?php echo $bg_color;?>;
z-index:<?php echo $z_index+1;?>;
overflow: hidden;
border-radius:<?php echo $corner_radius;?>px;

box-sizing: content-box;
-moz-box-sizing: content-box;
-webkit-box-sizing: content-box;

}
.dbx_iframe{

width:100%;
height:100%;
border:0;


}
.dbx{
background-color: <?php echo $border_color;?>;
color: <?php echo $dbx_title_color?>;
padding:4px 0px;
}
#closediv{
position:absolute;
cursor:pointer;
top: 0px;
right: 0px;
}
</style>


<div id="dbx_light" class="dbx_content"><?php if(!isset($_COOKIE['_xyz_dbx_until'])) {?>
<div class="dbx"><?php echo $dbx_title;  if($close_button_option==1) {?><img id="closediv"   src="<?php  echo $dbcloseimage;?>" onclick = "javascript:dbx_hide_lightbox()"><?php }?></div>
<!-- <div width="100%" height="20px" style="text-align:right;padding:0px;margin:0px;"><a href = "javascript:void(0)" onclick = "javascript:dbx_hide_lightbox()">CLOSE</a></div> -->
<?php if($iframe_option==1) { ?><iframe  src="<?php echo  get_bloginfo('wpurl') ;?>/index.php?xyz_dbx=iframe" class="dbx_iframe" scrolling="no"></iframe><?php }else{  
echo do_shortcode($html);}
}?>
</div>

<script type="text/javascript">
function xyz_dbx_settings()
{
var hadjust;
var wiadjust;
var posit=<?php echo $positioning;?> 
var def_disp=<?php echo $position_predefined;?>;
var dbxwid=<?php echo $width; ?>;
var dbxwiddim="<?php echo $width_dim;?>";
var dbxhe=<?php echo $height; ?>;
var dbxhedim="<?php echo $height_dim;?>";
var dbxbordwidth=<?php echo $border_width;?>;
var screenheight=jQuery(window).height();
/*var screenheight=window.innerHeight;*/
var screenwidth=jQuery(window).width(); 


if(dbxhedim=="px")

{

hadjust=(screenheight-dbxhe)/2;

}
else
{
	hadjust=(100-dbxhe)/2;
}
if(dbxwiddim=="px")

{

wiadjust=(screenwidth-dbxwid)/2;

}
else
{
	wiadjust=(100-dbxwid)/2;
}





if(posit==2)

{
if(def_disp==2)
{
	document.getElementById("dbx_light").style.top=hadjust+dbxhedim;
	document.getElementById("dbx_light").style.left="0px";
}
if(def_disp==1)
{
	document.getElementById("dbx_light").style.top="0px";
	document.getElementById("dbx_light").style.left="0px";
}
if(def_disp==3)
{
	document.getElementById("dbx_light").style.bottom="0px";
	document.getElementById("dbx_light").style.left="0px";
}
if(def_disp==4)
{
	document.getElementById("dbx_light").style.bottom="0px";
	document.getElementById("dbx_light").style.left=wiadjust+dbxwiddim;
}
if(def_disp==5)
{
	document.getElementById("dbx_light").style.bottom="0px";
	document.getElementById("dbx_light").style.right="0px";
}
if(def_disp==6)
{
	document.getElementById("dbx_light").style.top=hadjust+dbxhedim;
	document.getElementById("dbx_light").style.right="0px";
}
if(def_disp==7)
{
	document.getElementById("dbx_light").style.top="0px";
	document.getElementById("dbx_light").style.right="0px";
}
if(def_disp==8)
{
	document.getElementById("dbx_light").style.top="0px";
	document.getElementById("dbx_light").style.left=wiadjust+dbxwiddim;
}
if(def_disp==9)
{
	document.getElementById("dbx_light").style.top=hadjust+dbxhedim;
	document.getElementById("dbx_light").style.left=wiadjust+dbxwiddim;
}

}

var bordwidth=<?php echo $border_width;?>;

	var newheight;
	var newwidth;
	if(dbxhedim=="%")

	{
	
		var hadnjust=(screenheight*dbxhe)/100;
		 newheight=hadnjust-(2*bordwidth);

		 if(newheight<0)
			 newheight=0;
		 
		 document.getElementById("dbx_light").style.height=newheight+'px';
	}
	
	if(dbxwiddim=="%")

	{

		
		var wiadnjust=(screenwidth*dbxwid)/100;
		 newwidth=wiadnjust-(2*bordwidth);
		 
		 if(newwidth<0)
			 newwidth=0;
		 
			document.getElementById("dbx_light").style.width=newwidth+'px';
	}

	
}	



var xyz_dbx_tracking_cookie_name="_xyz_dbx_until";
var xyz_dbx_pc_cookie_name="_xyz_dbx_pc";
var xyz_dbx_tracking_cookie_val=xyz_dbx_get_cookie(xyz_dbx_tracking_cookie_name);
var xyz_dbx_pc_cookie_val=xyz_dbx_get_cookie(xyz_dbx_pc_cookie_name);
var xyz_dbx_today = new Date();

if(xyz_dbx_pc_cookie_val==null)
xyz_dbx_pc_cookie_val = 1;
else
xyz_dbx_pc_cookie_val = (xyz_dbx_pc_cookie_val % <?php echo $page_count;?> ) +1;

expires_date = new Date( xyz_dbx_today.getTime() + (24 * 60 * 60 * 1000) );
document.cookie = xyz_dbx_pc_cookie_name + "=" + xyz_dbx_pc_cookie_val + ";expires=" + expires_date.toGMTString() + ";path=/";


function xyz_dbx_get_cookie( name )
{
var start = document.cookie.indexOf( name + "=" );
//alert(document.cookie);
var len = start + name.length + 1;
if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) )
{
return null;
}
if ( start == -1 ) return null;
var end = document.cookie.indexOf( ";", len );
if ( end == -1 ) end = document.cookie.length;
return unescape( document.cookie.substring( len, end ) );
}


function dbx_hide_lightbox()
{
document.getElementById("dbx_light").style.display="none";
document.getElementById("dbx_light").innerHTML="";

}

function dbx_show_lightbox()
{

	xyz_dbx_settings();
	
	jQuery(window).resize(function(){
		xyz_dbx_settings();

 });

if(xyz_dbx_tracking_cookie_val==1)
return;

if( "<?php echo $mode;?>" == "page_count_only"  || "<?php echo $mode;?>" == "both" )
{
if(xyz_dbx_pc_cookie_val != <?php echo $page_count;?>)
return;
}


document.getElementById("dbx_light").style.display="block";



//expires_date = new Date( xyz_dbx_today.getTime() + (24 * 60 * 60 * 1000) );
//alert(xyz_dbx_today.toGMTString());
	expires_date = new Date(xyz_dbx_today.getTime() + (<?php echo $repeat_interval;?> * 60 * 1000));
document.cookie = xyz_dbx_tracking_cookie_name + "=1;expires=" + expires_date.toGMTString() + ";path=/";


}

if("<?php echo $mode;?>" == "page_count_only")
dbx_show_lightbox();
else
setTimeout("dbx_show_lightbox()",<?php echo $delay*1000;?>);

</script>





<?php 


$lbc = ob_get_contents();
ob_clean();
echo $tmp;
return $lbc;

}


?>