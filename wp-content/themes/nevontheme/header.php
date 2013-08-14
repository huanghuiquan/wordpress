<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php echo wp_title(); ?>
</title>
 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo ot_get_option('upload_favico', F_WAY.'/images/demo/favico.ico'); ?>" />

<?php
if(strlen(ot_get_option('google_font_js','')) > 0){
	echo ot_get_option('google_font_js');
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
//var_dump( ot_get_option('site_font_size','13px'));
    /*
     *  Add this to support sites with sites with threaded comments enabled.
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
 
    wp_head();
 
    wp_get_archives('type=monthly&format=link');
?>

</head>
<body <?php body_class(); ?>>
<div id="toTop"></div>

<div class="header-under-line"></div>
<div id="body-container-small">

    <div id="header-top">
        <div class="container" style="padding-top:15px;">
            <div class="top-left">
            <?php echo ot_get_option('header_top_left_text','<div class="phone-icon-small"></div><p><strong>Call Us Free : </strong>+123 555 5 555 | </p><a href="mailto:info@johndoe.com"><p><div class="email-icon-small"></div> info@johndoe.com</p></a>'); ?>
            </div>
            <div class="top-right">
                <?php echo do_shortcode('[socialIcons float="right"]'); ?>
                
                <form id="nevon-search" action="<?php echo esc_url(home_url()); ?>">
                    <input type="search" name="s"  placeholder="Search">
                </form>
            </div>
        </div>
    </div>
	<?php ?>
    <div class="container">
    
        <div id="header">
            <div id="logo" class="clearFix">
    
                <?php if(ot_get_option('upload_logo') === '' && ot_get_option('logo_type', 'logo') === 'name'):?>
                    <h1 style="font-size:18px; text-shadow:none;"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php else: ?>
                    <a href="<?php echo get_option('home'); ?>" rel="null"><img class="noImgBorder" src="<?php echo ot_get_option('upload_logo',F_WAY.'/images/demo/logo.png'); ?>" /></a>
                <?php endif; ?>
            </div>
            <?php
			if(!getMainMenu('primary-menu')){
  $backup = $wp_query;
  $wp_query = NULL;
  $wp_query = new WP_Query(array('post_type' => 'post'));
  getMainMenu('primary-menu');
  $wp_query = $backup;
}
			  
			  ?>
        </div>
    </div>
</div>
