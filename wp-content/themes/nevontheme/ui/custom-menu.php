<?php
//Register area for custom menu
function register_my_menu() {
    register_nav_menu( 'primary-menu', 'Primary Menu'  );
}

//Add support for WordPress 3.0's custom menus
add_action( 'init', 'register_my_menu' );


//To show Home in menu settings
function addHomeButton( $args ) {
	$args['show_home'] = _(ot_get_option('home_button_name_text'));
	$args['menu_class'] = 'nav';
	$args['theme_location'] = 'primary-menu';
	$args['sort_column'] = 'menu_order';
	return $args;
}

//Call add_filter method to add Home button
add_filter( 'wp_page_menu_args', 'addHomeButton' );

?>