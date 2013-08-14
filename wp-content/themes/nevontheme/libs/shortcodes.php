<?php

function makeHeaderText($atts) {  
	$return = "";
	if(!isset($atts['link'])){
		
		$return = '<div class="header-text-container">
			<span class="left"></span>
			<span class="header-text">'.__($atts['header']).'</span>
			<span class="right"></span>
			</div>
			<div class="clearFix"></div>';
	}else{
		$return = '<div class="header-text-container">
        <span class="left"></span>
        <span class="header-text">'.__($atts['header']).'</span>
        <a href="'.$atts['link'].'" class="right view-all">';
		if(isset($atts['text'])) $return .= $atts['text'];
		else $return .= 'View All';
		$return .= '</a>
        <span class="right" style="width:29%;"></span>
    </div>
    <div class="clearFix"></div>';
	}
	return $return;
}  

add_shortcode("headerText","makeHeaderText");

function makeSmallHeader($atts,$content = null) {  
	$return = '<div class="small-header-text-container" >
		<span class="small-header-text">'.__($content).'</span>
        <span class="right"></span>
        </div>
';
	return $return;
}  

add_shortcode("hSmall","makeSmallHeader");

function makeBreak($atts,$content = null) {  
	return '<div style="height:10px;"></div>';
}  

add_shortcode("br","makeBreak");

function makeh1($atts,$content = null) {  
	$return = '<h1>'.$content.'</h1>';
	return $return;
}  

add_shortcode("h1","makeh1");

function makeh2($atts,$content = null) {  
	$return = '<h2>'.$content.'</h2>';
	return $return;
}  

add_shortcode("h2","makeh2");

function makeh3($atts,$content = null) {  
	$return = '<h3>'.$content.'</h3>';
	return $return;
}  

add_shortcode("h3","makeh3");

function makeh4($atts,$content = null) {  
	$return = '<h4>'.$content.'</h4>';
	return $return;
}  

add_shortcode("h4","makeh4");

function makeh5($atts,$content = null) {  
	$return = '<h5>'.$content.'</h5>';
	return $return;
}  

add_shortcode("h5","makeh5");

function makeh6($atts,$content = null) {  
	$return = '<h6>'.$content.'</h6>';
	return $return;
}  

add_shortcode("h6","makeh6");


function addtyping($atts, $content = null) {  
	extract( shortcode_atts( array(
			'size' => '50',
			'float'=> 'left',
			'top'  => '-10',
			'weight' => '600'
		), $atts ) );	
	
	
	$return = '<div style="float:'.$float.'; font-size:'.$size.'px; position:relative; display:block; margin-right:10px; margin-bottom:-15px; margin-top:'.$top.'px; font-weight:'.$weight.'; color:#333333; " >'.$content.'</div>';
	
	return $return;
}  

add_shortcode("type","addtyping");


function makeHighlight($atts, $content = null) {  
	extract( shortcode_atts( array(
			'bgcolor' => '#ec4f2c',
			'textcolor' => '#fefeff'
		), $atts ) );	
	
	$return .= '<span style="background-color:'.$bgcolor.'; color:'.$textcolor.'; padding-left:5px; padding-right:5px;">'.$content.'</span>';
	
	return $return;
}  

add_shortcode("highlight","makeHighlight");


function makeBlockquote($atts, $content = null) {  
	extract( shortcode_atts( array(
			'width' => '400px',
		), $atts ) );	

	$return .= '<blockquote class="testimonial-intext" style="width:'.$width.'; ">'.$content.'</blockquote>';
	
	return $return;
}  

add_shortcode("blockquote","makeBlockquote");


function makeColumn($atts,$content = null) {  
	extract( shortcode_atts( array(
			'float' => 'left',
			'number'  => 'two',
			'last'   => 'false'
		), $atts ) );	
	
	if($last === 'false'){
		$return = '<div class="hun-'.$number.'" style="float:'.$float.'; ">'.do_shortcode($content).'</div>';
	}else{
		$return = '<div class="hun-'.$number.'" style="float:'.$float.'; margin-right:0px">'.do_shortcode($content).'</div>';
	}
	return $return;
}  

add_shortcode("column","makeColumn");


function makeContainer($atts,$content = null) {  
	$short = do_shortcode($content);

	
	$return = '<div class="container">'.$short.'</div>';
	return $return;
}  

add_shortcode("container","makeContainer");

function makeContainerColumn($atts,$content = null) {  
	extract( shortcode_atts( array(
			'column' => 'two',
		), $atts ) );	
	
	$return = '<div class="'.$column.' columns">'.do_shortcode($content).'</div>';
	
	return $return;
}  

add_shortcode("inColumn","makeContainerColumn");


function clearFunc($atts,$content = null) {  
	$return = '<div class="clearFix">
        </div>
';
	return $return;
}  

add_shortcode("clear","clearFunc");

function makeStrong($atts,$content = null) {  
	$return = '<span style="font-weight:600;">'.$content.'
        </span>
';
	return $return;
}  

add_shortcode("strong","makeStrong");

function makeHR($atts,$content = null) {  
	$return = '<hr />';
	return $return;
}  

add_shortcode("hr","makeHR");


function makeLink($atts,$content = null) {  
	extract( shortcode_atts( array(
			'href' => 'http://as3doctor.com',
			'alt'  => get_bloginfo('name'),
			'text' => 'Your link text text'
		), $atts ) );	

	$return = '<a href="'.$href.'" alt="'.$alt.'">'.$text.'</a>';
	return $return;
}  

add_shortcode("link","makeLink");

function makeUlList($atts,$content = null) {  
	extract( shortcode_atts( array(
			'type' => 'approve'
		), $atts ) );	
	$GLOBALS['list-type'] = $type;
	$back = strip_tags_general(do_shortcode($content), '<li>');
	
	$return = '<ul class="list-group">'.$back.'</ul>';
	//var_dump($return);
	return $return;
}  

add_shortcode("ul","makeUlList");
function makeListLi($atts,$content = null) {  
	//var_dump(do_shortcode($content));
	return '<li class="list-'.$GLOBALS['list-type'].'">'.do_shortcode($content).'</li>';
}  

add_shortcode("li","makeListLi");




function iconicText4($atts) {  
	extract( shortcode_atts( array(
			'icon' => 'shield',
			'header' => 'HEADER TEXT',
			'text' => 'Your description text',
			'style' => '',
			'link' => null
		), $atts ) );	
	
	if($link !== null){
		$return = '<div class="text-box-five" style="'.$style.'">
			<div class="icon-five-'.$icon.'"></div>
			<a href="'.$atts['link'].'"><h2>'.$header.'</h2></a>
			<p>'.$text.'</p>
		</div>';	
	}else{
		$return = '<div class="text-box-five" style="'.$style.'">
			<div class="icon-five-'.$icon.'"></div>
			<h2>'.$header.'</h2>
			<p>'.$text.'</p>
		</div>';	
	}
	
	return $return;
}  

add_shortcode("iconic4","iconicText4");

function makeHRText($atts) {  
	extract( shortcode_atts( array(
			'header' => 'Nevon - Awesome Responsive Wordpress Theme',
			'text' => 'We focus on quality on everywork we do, and the success is our followers'
		), $atts ) );	
	
	$return = '	<div class="header-under-text">
    <hr />
    <h1>'.$header.'</h1>
    <p style="font-size:16px; font-style:italic; color:#666666;">'.$text.'</p>
    <hr />
    </div>
    <div class="space-twenty"></div>
';	
	
	return $return;
}  

add_shortcode("hrText","makeHRText");


function makeButtonFunc($atts) {  
	extract( shortcode_atts( array(
			'link' => 'Your Link',
			'text' => 'Your description text',
			'style'=> '',
			'class' => '',
			'target' => '_parent'
		), $atts ) );	
	
	
	$return = '
		    <div class="generalBtn '.$class.'" style="'.$style.'">
				<a href="'.$link.'" class="btn" target="'.$target.'">'.$text.'</a>
			</div>
	';
	
	
	return $return;
}  

add_shortcode("makeButton","makeButtonFunc");

function makeBuyButton($atts) {  
	extract( shortcode_atts( array(
			'text' => 'Purchase Now!',
			'link' => 'http://themeforest.net/user/XanderRock/portfolio',
			'style' => ''
		), $atts ) );	
		
	$return = '<a href="'.$link.'" style="'.$style.'">
					<div class="buy-button-container">
						<div class="buy-button-buy-icon"></div>
						<div class="buy-button-text">
							'.$text.'
						</div>
					</div>
				</a>';
	return $return;
}  

add_shortcode("buyButton","makeBuyButton");

function addImgFunc($atts) {  
	extract( shortcode_atts( array(
			'src' => 'Your Image Path',
			'alt' => 'Your description text',
			'float' => 'none'
		), $atts ) );	
	
	
	$return = '<img class="incontent-img" src="'.$src.'" style="float:'.$float.'" alt="'.$alt.'" />';
	
	return $return;
}  

add_shortcode("addImg","addImgFunc");




function addSocialIcons($atts) {  
	$return = "";
	
	if(ot_get_option('social_icons_instagram') != "") $return .='<a href="'.ot_get_option('social_icons_instagram').'" class="social-icon-class social-instagram" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_vimeo') != "") $return .='<a href="'.ot_get_option('social_icons_vimeo').'" class="social-icon-class social-vimeo" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_skype') != "") $return .='<a href="'.ot_get_option('social_icons_skype').'" class="social-icon-class social-skype" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_youtube') != "") $return .='<a href="'.ot_get_option('social_icons_youtube').'" class="social-icon-class social-youtube" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_google') != "") $return .='<a href="'.ot_get_option('social_icons_google').'" class="social-icon-class social-google" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_digg') != "") $return .='<a href="'.ot_get_option('social_icons_digg').'" class="social-icon-class social-digg" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_pinterest') != "") $return .='<a href="'.ot_get_option('social_icons_pinterest').'" class="social-icon-class social-pinterest" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_twitter') != "") $return .='<a href="'.ot_get_option('social_icons_twitter').'" class="social-icon-class social-twitter" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_linkedin') != "") $return .='<a href="'.ot_get_option('social_icons_linkedin').'" class="social-icon-class social-linkedin" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(ot_get_option('social_icons_facebook') != "") $return .='<a href="'.ot_get_option('social_icons_facebook').'" class="social-icon-class social-facebook" target="_blank" style="float:'.$atts["float"].'"></a>';
	
	return $return;
}  

add_shortcode("socialIcons","addSocialIcons");


function addSocialIconsSingle($atts) {  
		extract( shortcode_atts( array(
			'facebook' => '',
			'twitter'  => '',
			'google'   => '',
			'youtube'  => '',
			'linkedin' => '',
			'vimeo'    => '',
			'pinterest' => '',
			'instagram' => '',
			'id'    => make_unique_text(),
			'float' => 'left',
			'last'  => 'false'
		), $atts ) );	


	$return = "";
	
	if(strlen($instagram) > 0)  $return .='<a href="'.$instagram.'" class="social-icon-class social-instagram" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($vimeo) > 0)  $return .='<a href="'.$vimeo.'" class="social-icon-class social-vimeo" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($linkedin) > 0)  $return .='<a href="'.$linkedin.'" class="social-icon-class social-linkedin" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($youtube) > 0)  $return .='<a href="'.$youtube.'" class="social-icon-class social-youtube" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($google) > 0)  $return .='<a href="'.$google.'" class="social-icon-class social-google" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($pinterest) > 0)  $return .='<a href="'.$pinterest.'" class="social-icon-class social-pinterest" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($twitter) > 0)  $return .='<a href="'.$twitter.'" class="social-icon-class social-twitter" target="_blank" style="float:'.$atts["float"].'"></a>';
	if(strlen($facebook) > 0)  $return .='<a href="'.$facebook.'" class="social-icon-class social-facebook" target="_blank" style="float:'.$atts["float"].'"></a>';
	
	
	return $return;
}  

add_shortcode("socialSingle","addSocialIconsSingle");





function addTabs($atts,$content){
	$GLOBALS['tabsArray'] = array();
		extract( shortcode_atts( array(
			'width' => '100%',
			'id'    => make_unique_text(),
			'float' => 'none',
			'last'  => 'false'
		), $atts ) );	
		
	do_shortcode($content);
	if($last === 'true'){
		$return = '<div class="tabs-wrapper" id="'.$id.'" style="width:'.$width.'; float:'.$float.'; margin-right:0px;">';
	}else{
		$return = '<div class="tabs-wrapper" id="'.$id.'" style="width:'.$width.'; float:'.$float.';">';
	}
	$return .= '<div class="tabs_container"><ul class="tabs">';
	
	$counter = 1;
	//var_dump($GLOBALS['tabsArray'][0]);
	foreach ($GLOBALS['tabsArray'] as $tabs){
		if($counter === 1){
			$return .= '<li class="active"><a href="#tab1">'.$tabs[0].'</a></li>';
		}else{
			$return .= '<li><a href="#tab'.$counter.'">'.$tabs[0].'</a></li>';
		}
		$counter++;
	}
	
	$return .= '</ul></div>';
	
	$counter = 1;
	
	$return .= '<div class="tabs_content_container">';
	
	foreach($GLOBALS['tabsArray'] as $details){
		if($counter === 1){
			$return .= '<div id="tab1" class="tab_content" style="display: block;"><p>';
		}else{
			$return .= '<div id="tab'.$counter.'" class="tab_content">';
		}
		
		$return .= $details[1].'</p></div>';
		
		$counter++;
	}
	
	$return .= '</div></div>';
	
	if($last === 'true'){
		$return .= '<div class="clearFix"></div>';	
	}
	
	$return = strip_tags_general($return);
	
	$return .= '<script type="text/javascript">
	    jQuery("#'.$id.' .tabs li").click(function() {
        //  First remove class "active" from currently active tab
        jQuery("#'.$id.' .tabs li").removeClass("active");
 
        //  Now add class "active" to the selected/clicked tab
        jQuery(this).addClass("active");
 
        //  Hide all tab content
        jQuery("#'.$id.' .tab_content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = jQuery(this).find("a").attr("href");
 
        //  Show the selected tab content
        jQuery("#'.$id.' "+ selected_tab).fadeIn("slow");
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });

	</script>';

	//var_dump($return);
	return $return;
}

function returnTab($atts,$content){
		extract( shortcode_atts( array(
			'title' => 'Your Tab Section'
		), $atts ) );	
		$GLOBALS['tabsArray'][] = array($title,do_shortcode($content));
}

add_shortcode("tabs","addTabs");
add_shortcode("tab","returnTab");

//VERY VERY IMPORTANT
add_filter('widget_text', 'do_shortcode');

function makeCodeBlock($atts,$content){
	return '<pre><code>'.str_replace(array("<p>","</p>"), "",$content).'</code></pre>';
}

add_shortcode("codes","makeCodeBlock");


function makeToggle($atts,$contents = null){
	extract( shortcode_atts( array(
		'width' => '100%',
		'float' => 'none',
		'header'=> 'Your Header',
		'id'    => make_unique_text(),
		'last'  => "false",
		'open'  => "false"
	), $atts ) );	
	
	$return = '<div class="toggle-holder" id="'.$id.'" style="width:'.$width.'; float:'.$float.'; ';
	if($last !== "false") $return .= 'margin-right:0px;';
	
	$return .='">
	<div class="toggle-header">'.$header.'</div>
	<div class="togglebox">'.do_shortcode($contents).'</div></div>';
	if($last !== "false") $return .= '<div class="clearFix"></div>';
	
	$return .= '<script type="text/javascript">
		jQuery(document).ready(function(){
	';
	if($open === "false"){ 
		$return .= 'jQuery("#'.$id.' .togglebox").hide();
					jQuery("#'.$id.' .toggle-header").css({"background-position":"0px -32px"});'; 
	}else{
		$return .= 'if(!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version > 8)){
						jQuery("#'.$id.' .toggle-header").css({"background-position":"0px 0px"});
						jQuery("#'.$id.' .togglebox").css("display","block");
					}';	
	}
	$return .= 'jQuery("#'.$id.' .toggle-header").click(function(){
			if(!jQuery.browser.msie || (jQuery.browser.msie && jQuery.browser.version > 8)){
				if(jQuery(this).next(".togglebox").is(":visible")){
					jQuery(this).stop().animate({"background-position":"0px -32px"},{duration:400, easing:"easeInSine"});
				}else{
					jQuery(this).stop().animate({"background-position":"0px 0px"},{duration:400, easing:"easeOutSine"});
				}
			}
			jQuery(this).next(".togglebox").slideToggle("slow");
			return true;
		});
		});
	</script>';

	return $return;
}

add_shortcode("toggle","makeToggle");

/*
SOCIAL SHARE
*/


function twitter_follow($atts, $content=null){
    extract(shortcode_atts(array(
        'show_count' => false,
        'button' => 'blue', // blue, grey
        'text_color' => '',
        'link_color' => '',
        'lang' => '', // en, fr, de, it, es, ko, ja | ref: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
        'width' => '',
        'align' => 'left'
        ), $atts));
		
		$return .= '<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		return $return;
}
add_shortcode('tf', 'twitter_follow');

function fb_like($atts, $content = null){
	
    extract(shortcode_atts(array(
			'send' => 'false',
			'layout' => 'standart',
			'show_faces' => 'true',
			'width' => '400px',
			'action' => 'like',
			'font' => '',
			'colorscheme' => 'light',
			'ref' => '',
			'locale' => 'en_US',
			'appId' => ''// Put your AppId here is you have one
			), $atts));
			$return = '<div id="fb-root" style="float:left;"><script src="http://connect.facebook.net/'.$locale.'/all.js#appId='.$appId.'&amp;xfbml=1"></script>';
			$return .= '<fb:like ref="'.$ref.'" href="'.$content.'" layout="'.$layout.'"  colorscheme="'.$colorscheme.'" action="'.$action.'" send="'.$send.'" width="'.$width.'" show_faces="'.$show_faces.'" font="'.$font.'"></fb:like></div>';
			
			//return $return;
			
			$like = '<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));</script>';
			
			$like .= '<div class="fb-like" data-href="'.get_permalink().'" data-send="false" data-layout="button_count" data-width="80" data-show-faces="true" data-font="lucida grande"></div>';
			
			return $like;
}
add_shortcode('fb', 'fb_like');






function plus1( $atts, $content=null ){
    extract(shortcode_atts(array(
	'lang' => 'en-US',
	'parsetags' => 'onload',
	'count' => 'true',
	'size' => 'medium',
	'callback' => ''
	), $atts));
	
	if($content != null){ $url = 'href="'.$content.'"';};
	$plus1_code = '<div class="g-plus" data-action="share" data-annotation="bubble"></div>';
	return $plus1_code;
}
// Add meta tag for front page
function addPlus1Meta(){
	if(is_home()){
		echo "<link rel='canonical' href='".site_url()."' />";
	}
	echo '<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    po.src = "https://apis.google.com/js/plusone.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';
}
add_shortcode('p1', 'plus1');
add_action('wp_footer', 'addPlus1Meta');


function addPinterest($atts,$content=null){
	$return;
	$return .= '
	<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>';

	$pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );

	$return .= '<a href="http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink($post->ID)).'&media='.$pinterestimage[0].'&description='.get_the_title().' " class="pin-it-button" count-layout="horizontal">Pin It</a>';
	
	//return $return;
	
	$share = '<a href="http://pinterest.com/pin/create/button/?url='.get_permalink().'&media='.wp_get_attachment_url(get_post_thumbnail_id()).'&description='.get_the_title().'" class="pin-it-button" count-layout="horizontal">Pin It</a>';
	$share .= '<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>';
	return $share;
}

add_shortcode("sharePin", "addPinterest");
















//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="YOUR USER ID"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Your Site NAME Goes HERE"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://192.168.1.41/wordpress/wp-content/uploads/2012/07/logo12.png"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );





function strip_tags_general($content){
	$return = strip_tags($content,'<a><h1><h2><h3><h4><h5><h6><img><div><span><ul><li>');	
	return $return;
}



function makeTestimonials($atts,$content = null) {  

    extract(shortcode_atts(array(
		'header' => 'Testimonials',
		'id'     => make_unique_text()
	), $atts));

	$testimonial = do_shortcode($content);

	$return = '<div class="nevon-basic-slider" id="'.$id.'">
    	<div class="small-h1"><span class="in-text">'.$header.'</span></div>
        <span class="small-dots"></span>
        <div class="control-holder">
            <span class="control rightControl">></span>
            <span class="control leftControl"><</span>
        </div>
    	<div class="nevon-basic-slider-container">';
	
	$return .= $testimonial;
	$return .= '</div></div>';
	
	$return .= '<script type="text/javascript">
	jQuery(".nevon-basic-slider").NevonBasic({autoSlide : true,direction:"ud"});
	</script>';
		
	return $return;
}  

add_shortcode("Testimonials","makeTestimonials");


function makeTestimonialsInside($atts,$content = null) {  

    extract(shortcode_atts(array(
		'author' => 'Xander Rock',
		'company'=> 'Nevon Theme Incorporation'
	), $atts));


	$return = '<div class="slide">
            	<blockquote class="testimonial">
                  <p>'.$content.'</p>
                </blockquote>
                <div class="arrow-down"></div>
                <p class="testimonial-author">'.$author.' | <span>'.$company.'</span></p>
            </div>';
		
		
	return $return;
}  

add_shortcode("Testimonial","makeTestimonialsInside");

/*
	References Post
*/
function makeReferencesPost($atts){
	$return = '
	<div class="nevon-basic-slider-copy">
    	<div class="small-h1"><span class="in-text">'.__(ot_get_option("home_references_text")).'</span></div>
        <span class="small-dots"></span>
        <div class="control-holder">
            <span class="control rightControl">></span>
            <span class="control leftControl"><</span>
        </div>
    	<div class="nevon-basic-slider-container" style="height:180px;">';

			$max = 3;
			$total = 0;
			$hasGallery = false;
	        $pfportfolio = new WP_Query( array('post_type'=> 'references', 'nopaging'=>true));
			while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
				$hasGallery = true;
				if($total == 0){ $return .= '<div class="slide" >';}
				$return .= '<li class="six-column six-column-img" style="margin-right:3px; margin-left:0px">';
				$return .= '<div class="gallery-view six-column-img">';
				$return .= get_the_post_thumbnail($page->ID,'gallery-six', array("alt" => get_the_title() ));
				$return .= '<a href="';
				$linkto = get_url_desc_box();
				if(strlen($linkto[0]) > 8){
					$return .= $linkto[0].'" rel="prettyPhoto"';
				}else{
					$return .= wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" rel="prettyPhoto"';
				}
				$return .= '>';
				$return .= '<div class="gallery-mask">';
				$return .= '</div>';
				$return .= '</a>';
				$return .= '</div>';
				$return .= '</li>';
				
				$total++;
				if($total >= $max) {
					$return .= '</div>';
				}
				
				if($total >= $max) {$total = 0;}
			endwhile;
			
			if ($total != 0) $return .= "</div>";
			wp_reset_postdata();
    	$return .= '</div>
    </div>';
	
	$returnScript = '<script type="text/javascript">
	jQuery(window).load(function(){
		jQuery(".nevon-basic-slider-copy").NevonBasic({direction:"rl"});
	});
	</script>';
	
	return $return.$returnScript;
	
}

add_shortcode("ReferencesPost","makeReferencesPost");

/*
	End of References Post
*/



function makeiViewSlider($atts, $content = null ) {  
	
	$return = '<script src="'.JS_WAY.'/raphael-min.js"></script>
		<script src="'.JS_WAY.'/iview.js"></script>
		<script>
			jQuery(document).ready(function(){
				jQuery("#iview").iView({
					pauseTime: 7000,
					directionNav: false,
					controlNav: true,
					tooltipY: -15
				});
				
			function resizeiViewControl(){
				var thisX = Math.floor((jQuery("#iview").width() - jQuery(".iview-controlNav").width())/2);
				jQuery(".iview-controlNav").css({"left":thisX,opacity:1}).show("fast");
			}
			setTimeout(resizeiViewControl,1500);
			});
		</script>
		<link rel="stylesheet" href="'.F_WAY.'/css/iview.css" />';
	
	
	
	
	$return .=  '<div class="nivo-slider-container container">
    		<div id="iview">';
    
					$efs_query= "category_name=iview-slider-posts&posts_per_page=99";
					query_posts($efs_query);
					
					$counter = 0;
					if (have_posts()) : while (have_posts()) : the_post(); 
						//$img= get_the_post_thumbnail( $post->ID, 'large' );
						$img = wp_get_attachment_image_src(  get_post_thumbnail_id($post->ID), 'slider-images');
						//$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID,'slider-images') );
						//var_dump($img[0]);
						$link = get_url_desc_box();						
						if(strlen($link[0]) > 8){
							$return .= '<div data-iview:image="'.$img[0].'" class="iview-video" data-iview:type="video" >';
							$return .= '<iframe src="'.$link[0].'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						}else{
							$return .= '<div data-iview:image="'.$img[0].'" >';
						}
						$tags = get_ivew_tags();
						if(count($tags) > 0){
							if($tags[0]){
								$return .= '<div class="iview-caption caption5" data-x="50" data-y="40">'.$tags[0].'</div>';
							}
							
							if(strlen($tags[1]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="115" data-transition="wipeRight">'.$tags[1].'</div>';
							}
							
							if(strlen($tags[2]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="160" data-transition="wipeLeft">'.$tags[2].'</div>';
							}
							
							if(strlen($tags[3]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="205" data-transition="wipeRight">'.$tags[3].'</div>';
							}
							
						}
						$return .= '</div>';
						$counter++;
						
							
					endwhile; endif; wp_reset_query();
					
					//echo $return;
            $return .= '</div>
        </div>
    	<div class="clearFix"></div>';
	
	return $return;
}  

add_shortcode("iViewSlider","makeiViewSlider");



function makeColumnProducts($atts,$content = null) {  

    extract(shortcode_atts(array(
		'total' => -1,
		'category' => '',
		'columns' => 'three' 
	), $atts));

	wp_reset_query();
	
		$postNum = intval($total);
		
			$newPostQuery = query_posts( array(  
			  'post_type' => 'nevonproducts', 
			  'nevonproductstype' => $category,
			  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
			  'posts_per_page' => $postNum
		 )); 

	$return = '<div class="home-products-container full-products">';
	$homeproducts = new WP_Query( array('post_type'=> 'nevonproducts', 'nevonproductstype' => $category, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 'posts_per_page'=> $postNum));
	
	
	if ($homeproducts->have_posts()) : while ($homeproducts->have_posts()) : $homeproducts->the_post(); 
		
			$return .=  '<div class="view '.$columns.'-column '.$columns.'-column-img">';
			$return .=  '<div class=" view-first gallery-view '.$columns.'-column-img ">';
            $return .= get_the_post_thumbnail($post->ID,'gallery-'.$columns.'');
            $return .=  '<div class="mask">';
            $return .=  '<h2>'.get_the_title().'</h2>';
            $return .=  '<p>'.strip_images(100,false).'</p>';
			
			$linkto = get_extra_btn();
			//var_dump($linkto[0]);
			if(strlen($linkto[0]) > 8){
				//echo do_shortcode('[makeButton link="'.$linkto[0].'" text="'.$linkto[1].'" style="width:auto; margin-right:10px; border:none; border-radius:0px"]');
				$return .=  '<a href="'.$linkto[0].'" class="info">'.__(ot_get_option("read_more_text")).'</a>';
			}else{
				$return .=  '<a href="'.get_permalink().'" class="info">'.__(ot_get_option("read_more_text")).'</a>';
			}
            $return .=  '</div>';
            $return .=  '</div>';
			$return .=  '</div>';
			
	endwhile; endif;
	
    $return .= '</div><!-- Closing home products div-->
    <div class="clearFix"></div>
    
            <div class="space-twenty"></div>

	        <div class="navigation" >';
			
			
			$return .= makePagination(true);
			$return .= '</div>';
			wp_reset_query();
			wp_reset_postdata();

		
		
	return $return;
}  

add_shortcode("productsColumn","makeColumnProducts");



function makeGallery($atts,$content = null) {  

    extract(shortcode_atts(array(
		'total' => -1,
		'category' => '',
		'columns' => 'four'
	), $atts));

	$return = '<div id="pages" class="four-col-gallery">';
		wp_reset_query();
		$postNum = isset($total) ? intval($total) : ot_get_option('gallery-per-page',18);
		
		
			$newPostQuery = query_posts( array(  
			  'post_type' => 'filteredgallery', 
			  'filteredgallerytype' => $category,
			  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
			  'posts_per_page' => $postNum
		 )); 
		 
	$pfportfolio = new WP_Query( array('post_type' => 'filteredgallery', 'filteredgallerytype' => $category, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),'posts_per_page' => $postNum));
	
		while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
		
            $return .= '<div class="'.$columns.'-column '.$columns.'-column-img">';
			
			$return .=  '<div class="gallery-view '.$columns.'-column-img">';
            $return .= get_the_post_thumbnail($page->ID,'gallery-'.$columns.'', array("alt" => get_the_title() ));
			$return .=  '<a href="';

				$linkto = get_url_desc_box();
				if(strlen($linkto[0]) > 8){
					$return .=  $linkto[0].'" ';
				}else{
					$return .=  wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" rel="prettyPhoto"';
				}
			$return .=  '>';
            $return .=  '<div class="gallery-mask">';
            $return .=  '</div>';
			$return .=  '</a>';
            $return .=  '</div>';

			
			$return .=  '</div>';
        endwhile;

    	$return .= '<div class="clearFix"></div>
        <div class="space-twenty"></div>

	        <div class="navigation" >';
			
			
			$return .= makePagination(true);
			$return .= '</div>';
			wp_reset_query();
			wp_reset_postdata();
			$return .= '</div>';
		
		
	return $return;
}  

add_shortcode("nevonGallery","makeGallery");



?>