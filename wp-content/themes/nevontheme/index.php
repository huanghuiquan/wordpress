<?php 
$home_layout = ot_get_option('home_slider_layout','nevon');
if(is_home()){
	if($home_layout == "nevon"){
		get_header();
		include_once(TEMPLATEPATH.'/ui/home-design.php');
		get_footer();
	}else if($home_layout == "iview"){
		get_header();
		include_once(TEMPLATEPATH.'/home_layout_iview.php');
		get_footer();
	}
}else{
	include_once(TEMPLATEPATH.'/category.php');
}
?>