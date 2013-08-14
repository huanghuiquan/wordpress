<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create your own custom array that will be passes to the 
   * OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
        )
      ),
      'sidebar'       => '<p>Sidebar content goes here!</p>',
    ),
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'title'       => 'Social Icons ',
        'id'          => 'social-icons'
      ),
	  array(
	  	'title' 	  => 'Home Details',
		'id'		  => 'home-details'
	  ),
	  array(
	  	'title' 	  => 'Contact Details',
		'id'		  => 'contact'
	  ),
	  array(
	  	'title' 	  => 'Color Settings',
		'id'		  => 'color-settings'
	  ),
	  array(
	  	'title' 	  => 'Font Settings',
		'id'		  => 'font-settings'
	  ),
	  array(
	  	'title' 	  => 'Background Settings',
		'id'		  => 'background-settings'
	  )

    ),
    'settings'        => array(
	
		array(
            'label'       => 'Header Top Left Text',
            'id'          => 'header_top_left_text',
            'type'        => 'textarea-simple',
            'desc'        => 'You may use some simple contact information like your email or your number here. HTML tags allowed for links',
			'section'	  => 'general',
            'std'         => '<div class="phone-icon-small"></div><p><strong>Call Us Free : </strong>+123 555 5 555 | </p><a href="mailto:info@johndoe.com"><p><div class="email-icon-small"></div> info@johndoe.com</p></a>',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
      array(
        'label'       => 'Select site logo type',
        'id'          => 'logo_type',
        'type'        => 'select',
        'desc'        => 'Choose the site logo type. You can either use site\'s name or your logo',
        'choices'     => array(
          array(
            'label'       => 'Use Logo',
            'value'       => 'logo'
          ),
          array(
            'label'       => 'Use Site Name',
            'value'       => 'name'
          )
        ),
        'std'         => 'logo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
		  
		array(
        'label'       => 'Upload Your Logo',
        'id'          => 'upload_logo',
        'type'        => 'upload',
        'desc'        => 'Upload your logo. Logo size must be lower than 200px width and 100px height.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
		array(
        'label'       => 'Upload Your Favico',
        'id'          => 'upload_favico',
        'type'        => 'upload',
        'desc'        => 'Upload your favico.ico file. This is the image file will be shown at the left side of address bar. Must be sized as 16x16 pixels.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	
      array(
        'id'          => 'theme_layout',
        'label'       => 'Layout',
        'desc'        => 'Choose a layout for your theme',
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'general',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
          ),
          array(
            'value'   => 'full-width',
            'label'   => 'Full Width (no sidebar)',
            'src'     => OT_URL . '/assets/images/layout/full-width.png'
          )
        )
      ),
	  
	  array(
            'label'       => 'Footer Copyright Information',
            'id'          => 'footer_copyright',
            'type'        => 'textarea-simple',
            'desc'        => 'Your copyright information. You may use HTML tags here',
			'section'     => 'general',
            'std'         => 'Designed by <a href="http://activeden.net/user/XanderRock/portfolio" target="_blank">XanderRock</a> © 2013 <a href="http://activeden.net/user/XanderRock/portfolio" target="_blank">Nevon Theme</a> | All Rights Reserved',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
      ),
	  
	 array(
            'label'   => 'Read More Text',
            'id'      => 'read_more_text',
            'desc'    => 'Enter read more text you want to use in "read more" details',
			'section' => 'general',
            'std'     => 'read more',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
      array(
        'label'       => 'Pagination Settings',
        'id'          => 'pagination_settings_header',
        'type'        => 'textblock-titled',
        'desc'        => '<p>For blog pagination, you should use Wordpress\'s Native Post Per Page Option. For Products and Gallery Pagination, set the values down below</p>',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
	  array(
        'label'       => 'Nevon Products Slug',
        'id'          => 'nevon_products_slug',
        'type'        => 'text',
        'desc'        => 'Nevon Products slug to show in links.',
        'std'         => 'nevonproducts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
	  array(
        'label'       => 'Testimonials Slug',
        'id'          => 'nevon_testimonials_slug',
        'type'        => 'text',
        'desc'        => 'Testimonials slug to show in links.',
        'std'         => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
	  array(
        'label'       => 'Nevon Gallery Slug',
        'id'          => 'nevon_gallery_slug',
        'type'        => 'text',
        'desc'        => 'Nevon Gallery slug to show in links.',
        'std'         => 'nevongallery',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
	  array(
        'label'       => 'References Slug',
        'id'          => 'nevon_references_slug',
        'type'        => 'text',
        'desc'        => 'References slug to show in links.',
        'std'         => 'references',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),

	  array(
        'label'       => 'Our Team Slug',
        'id'          => 'nevon_ourteam_slug',
        'type'        => 'text',
        'desc'        => 'Our Team slug to show in links.',
        'std'         => 'ourteam',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),

      array(
        'label'       => 'Products Per page',
        'id'          => 'products-per-page',
        'type'        => 'text',
        'desc'        => 'Products per page to show.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Gallery Image Per page',
        'id'          => 'gallery-per-page',
        'type'        => 'text',
        'desc'        => 'Gallery image per page to show.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
      array(
        'label'       => 'Gallery Filtered Two Column',
        'id'          => 'gallery-filtered-two-total',
        'type'        => 'text',
        'desc'        => 'Total gallery image to show in filtered gallery two column.',
        'std'         => '6',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
      array(
        'label'       => 'Gallery Filtered Three Column',
        'id'          => 'gallery-filtered-three-total',
        'type'        => 'text',
        'desc'        => 'Total gallery image to show in filtered gallery three column.',
        'std'         => '9',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
      array(
        'label'       => 'Gallery Filtered Four Column',
        'id'          => 'gallery-filtered-four-total',
        'type'        => 'text',
        'desc'        => 'Total gallery image to show in filtered gallery four column.',
        'std'         => '8',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
      array(
        'label'       => 'Gallery Filtered Six Column',
        'id'          => 'gallery-filtered-six-total',
        'type'        => 'text',
        'desc'        => 'Total gallery image to show in filtered gallery six column.',
        'std'         => '18',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
	  
	  array(
        'label'       => 'Footer Large Disabled',
        'id'          => 'footer_large_enabled',
        'type'        => 'checkbox',
        'desc'        => 'Check this if you don\'t want large footer (footer with four columns) at the bottom',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),

	  
	  
	 
          array(
            'label'       => 'Facebook',
            'id'          => 'social_icons_facebook',
            'type'        => 'text',
            'desc'        => 'Your facebook link',
			'section'     => 'social-icons',
            'std'         => 'http://facebook.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Linkedin',
            'id'          => 'social_icons_linkedin',
            'type'        => 'text',
            'desc'        => 'Your linkedin link',
			'section'     => 'social-icons',
            'std'         => 'http://linkedin.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Twitter',
            'id'          => 'social_icons_twitter',
            'type'        => 'text',
            'desc'        => 'Your twitter link',
			'section'     => 'social-icons',
            'std'         => 'http://twitter.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Digg',
            'id'          => 'social_icons_digg',
            'type'        => 'text',
            'desc'        => 'Your digg link',
			'section'     => 'social-icons',
            'std'         => 'http://digg.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Google+',
            'id'          => 'social_icons_google',
            'type'        => 'text',
            'desc'        => 'Your google plus link',
			'section'     => 'social-icons',
            'std'         => 'http://google.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		  array(
            'label'       => 'Pinterest',
            'id'          => 'social_icons_pinterest',
            'type'        => 'text',
            'desc'        => 'Your Pinterest Link',
			'section'     => 'social-icons',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),

		  
          array(
            'label'       => 'Youtube',
            'id'          => 'social_icons_youtube',
            'type'        => 'text',
            'desc'        => 'Your youtube channel link',
			'section'     => 'social-icons',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Skype',
            'id'          => 'social_icons_skype',
            'type'        => 'text',
            'desc'        => 'Your skype information',
			'section'     => 'social-icons',
            'std'         => 'http://skype.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Vimeo',
            'id'          => 'social_icons_vimeo',
            'type'        => 'text',
            'desc'        => 'Your vimeo link',
			'section'     => 'social-icons',
            'std'         => 'http://vimeo.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
          array(
            'label'       => 'Instagram',
            'id'          => 'social_icons_instagram',
            'type'        => 'text',
            'desc'        => 'Your instagram link',
			'section'     => 'social-icons',
            'std'         => 'http://instagram.com',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),



	   array(
        'label'       => 'Twitter Tweet',
        'id'          => 'twitter_tweet',
        'type'        => 'checkbox',
        'desc'        => 'Check this if you want to activate the Twitter button at blog posts',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => 'Yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social-icons'
      ),

	   array(
        'label'       => 'Facebook Like',
        'id'          => 'facebook_like',
        'type'        => 'checkbox',
        'desc'        => 'Check this if you want to activate the Facebook Like button at blog posts',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => 'Yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social-icons'
      ),
	   array(
        'label'       => 'Google +1 Share',
        'id'          => 'google_share',
        'type'        => 'checkbox',
        'desc'        => 'Check this if you want to activate the Google+ button at blog posts',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => 'Yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social-icons'
      ),
	   array(
        'label'       => 'Pinterest Pinit',
        'id'          => 'pinterest',
        'type'        => 'checkbox',
        'desc'        => 'Check this if you want to activate the Pinterest button at blog posts',
        'choices'     => array(
          array (
            'label'       => 'Yes',
            'value'       => 'Yes'
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'social-icons'
      ),
	  
	  
      array(
        'label'       => 'Select homepage layout',
        'id'          => 'home_slider_layout',
        'type'        => 'select',
        'desc'        => 'Choose the homepage layout type. There are two different homepage layout types: Nevon Slider Layout and iView Slider Layout. Choose the one you wanted to use.',
        'choices'     => array(
          array(
            'label'       => 'Nevon Slider Layout',
            'value'       => 'nevon'
          ),
          array(
            'label'       => 'iView Slider Layout',
            'value'       => 'iview'
          )
        ),
        'std'         => 'nevon',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home-details'
      ),
	  
		array(
            'label'       => 'Iconic Text',
            'id'          => 'home_iconic_text',
            'type'        => 'textarea',
            'desc'        => 'If you want to use iconic text on homepage, add the shortcodes of iconic texts here.',
			'section'	  => 'home-details',
            'std'         => '[iconic4 icon="clock" header="Right Time!" text="Lorem ipsum dolor sit amet, cons ectetur adipiscing elit. Duis sit amet leo lorem. Cras eros dolor, porta sit amet aliquam eget, sagittis tristique."][iconic4 icon="touch" header="Responsive Touch!" text="Lorem ipsum dolor sit amet, cons ectetur adipiscing elit. Duis sit amet leo lorem. Cras eros dolor, porta sit amet aliquam eget, sagittis tristique."][iconic4 icon="cloud" header="Cloud Tech" text="Lorem ipsum dolor sit amet, cons ectetur adipiscing elit. Duis sit amet leo lorem. Cras eros dolor, porta sit amet aliquam eget, sagittis tristique."][iconic4 icon="globe" header="Global Solutions!" text="Lorem ipsum dolor sit amet, cons ectetur adipiscing elit. Duis sit amet leo lorem. Cras eros dolor, porta sit amet aliquam eget, sagittis tristique."]',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
	  
		array(
            'label'       => 'Toggles on Homepage iView Layout',
            'id'          => 'home_toggles',
            'type'        => 'textarea',
            'desc'        => 'If you want to use toggles on Homepage iView Layout, add the shortcodes of toggles here.',
			'section'	  => 'home-details',
            'std'         => '[tabs width="458px" float="left"]
[tab title="Donec "][h1]General Information[/h1]Donec a sem urna, quis lacinia metus. Morbi tortor nibh, lobortis in scelerisque a, ultrices at nulla. [br]
Donec ante massa, fermentum id rhoncus vel, vestibulum a orci. Quisque imperdiet, tortor eget varius convallis, justo risus tincidunt lectus, sit amet bibendum metus mauris a tortor.[/tab]

[tab title="Morbi "]Donec a sem urna, quis lacinia metus. Morbi tortor nibh, lobortis in scelerisque a, ultrices at nulla. Donec ante massa, fermentum id rhoncus vel, vestibulum a orci. Morbi ullamcorper tincidunt vulputate. Praesent sed lacinia mauris. Quisque imperdiet, tortor eget varius convallis, justo risus tincidunt lectus, sit amet bibendum metus mauris a tortor. Sed accumsan, dui vel convallis placerat, sapien nisi lobortis elit, et fringilla turpis velit eget elit. [/tab]

[tab title="Quisque "]

Curabitur dolor massa, varius a accumsan sed, sagittis eget nibh. Duis convallis, leo non adipiscing cursus, leo metus fermentum magna, aliquet sollicitudin nisi orci nec ante. Suspendisse potenti. Quisque placerat erat consectetur justo bibendum commodo id at quam. Donec imperdiet risus ut mauris convallis vel pulvinar lorem ullamcorper. Donec ut orci quis dolor vehicula rutrum vel sed purus. Phasellus consectetur ornare sem eget adipiscing. Etiam ultricies iaculis justo nec mollis. Maecenas adipiscing sapien lorem. In id risus vel sem pulvinar venenatis.

 

Quisque ultricies enim vitae enim imperdiet blandit. Ut consectetur nisi nec lacus accumsan at molestie ante fermentum. Nam vitae arcu ullamcorper eros posuere facilisis et in felis. Praesent leo urna, eleifend id mollis placerat, interdum ac nulla. Aliquam luctus accumsan massa non pretium. Maecenas a leo a orci adipiscing interdum in non lectus. Donec et urna a magna sollicitudin rhoncus. Duis id nisl eu mauris viverra tincidunt vitae eu quam. Nullam semper lobortis enim, id dignissim arcu mattis in. Cras eu libero magna. Nulla eu diam condimentum nisi lacinia mollis in quis orci. Praesent adipiscing ligula at lectus ornare dictum. Aliquam interdum quam nec metus tempus ac aliquet lacus placerat.

[/tab]

[tab title="7/24 Support "]

Curabitur dolor massa, varius a accumsan sed, sagittis eget nibh. Duis convallis, leo non adipiscing cursus, leo metus fermentum magna, aliquet sollicitudin nisi orci nec ante. Suspendisse potenti. Quisque placerat erat consectetur justo bibendum commodo id at quam. Donec imperdiet risus ut mauris convallis vel pulvinar lorem ullamcorper. Donec ut orci quis dolor vehicula rutrum vel sed purus. Phasellus consectetur ornare sem eget adipiscing. Etiam ultricies iaculis justo nec mollis. Maecenas adipiscing sapien lorem. In id risus vel sem pulvinar venenatis.

 

Quisque ultricies enim vitae enim imperdiet blandit. Ut consectetur nisi nec lacus accumsan at molestie ante fermentum. Nam vitae arcu ullamcorper eros posuere facilisis et in felis. Praesent leo urna, eleifend id mollis placerat, interdum ac nulla. Aliquam luctus accumsan massa non pretium. Maecenas a leo a orci adipiscing interdum in non lectus. Donec et urna a magna sollicitudin rhoncus. Duis id nisl eu mauris viverra tincidunt vitae eu quam. Nullam semper lobortis enim, id dignissim arcu mattis in. Cras eu libero magna. Nulla eu diam condimentum nisi lacinia mollis in quis orci. Praesent adipiscing ligula at lectus ornare dictum. Aliquam interdum quam nec metus tempus ac aliquet lacus placerat.

[/tab]

[tab title="Responsive "]

Curabitur dolor massa, varius a accumsan sed, sagittis eget nibh. Duis convallis, leo non adipiscing cursus, leo metus fermentum magna, aliquet sollicitudin nisi orci nec ante. Suspendisse potenti. Quisque placerat erat consectetur justo bibendum commodo id at quam. Donec imperdiet risus ut mauris convallis vel pulvinar lorem ullamcorper. Donec ut orci quis dolor vehicula rutrum vel sed purus. Phasellus consectetur ornare sem eget adipiscing. Etiam ultricies iaculis justo nec mollis. Maecenas adipiscing sapien lorem. In id risus vel sem pulvinar venenatis.

 

Quisque ultricies enim vitae enim imperdiet blandit. Ut consectetur nisi nec lacus accumsan at molestie ante fermentum. Nam vitae arcu ullamcorper eros posuere facilisis et in felis. Praesent leo urna, eleifend id mollis placerat, interdum ac nulla. Aliquam luctus accumsan massa non pretium. Maecenas a leo a orci adipiscing interdum in non lectus. Donec et urna a magna sollicitudin rhoncus. Duis id nisl eu mauris viverra tincidunt vitae eu quam. Nullam semper lobortis enim, id dignissim arcu mattis in. Cras eu libero magna. Nulla eu diam condimentum nisi lacinia mollis in quis orci. Praesent adipiscing ligula at lectus ornare dictum. Aliquam interdum quam nec metus tempus ac aliquet lacus placerat.

[/tab]

[/tabs]',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
	  
	  
		array(
            'label'       => 'iView Home Layout under slider text',
            'id'          => 'under_slider_text',
            'type'        => 'textarea-simple',
            'desc'        => 'This shortcode will help you to add between hr. This is the title under the iView Slider.',
			'section'	  => 'home-details',
            'std'         => '[hrText header="Nevon - Awesome Responsive Wordpress Theme" text="We focus on quality on everywork we do, and the success is our followers"]',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Home Button Name',
            'id'          => 'home_button_name_text',
            'type'        => 'text',
            'desc'        => 'Text of the home button. You can use some other words for home.',
			'section'	  => 'home-details',
            'std'         => 'Home',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Home Nevon Slider Layout Products Link',
            'id'          => 'home_products_link',
            'type'        => 'text',
            'desc'        => 'If you want to activate to link button at the Nevon Slider Home Page Layout, add the link here',
			'section'	  => 'home-details',
            'std'         => 'http://as3doctor.com',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Home Testimonials Text',
            'id'          => 'home_testimonial_text',
            'type'        => 'text',
            'desc'        => 'Header text of the testimonials at the home page',
			'section'	  => 'home-details',
            'std'         => 'Testimonials',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Home References Text',
            'id'          => 'home_references_text',
            'type'        => 'text',
            'desc'        => 'Header text of the references at the home page',
			'section'	  => 'home-details',
            'std'         => 'References',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Home Products Text',
            'id'          => 'home_products_text',
            'type'        => 'text',
            'desc'        => 'Header text of the products at the home page',
			'section'	  => 'home-details',
            'std'         => 'PRODUCTS',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'iView Latest Projects Text',
            'id'          => 'iview_latest_projects',
            'type'        => 'text',
            'desc'        => 'Enter the header text of your latest project',
			'section'	  => 'home-details',
            'std'         => 'Our Latest Projects',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'iView Why Us? Text',
            'id'          => 'iview_why_us',
            'type'        => 'text',
            'desc'        => 'Enter the header text of Why Us?',
			'section'	  => 'home-details',
            'std'         => 'Why Us?',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'View All Text',
            'id'          => 'home_view_all_text',
            'type'        => 'text',
            'desc'        => 'View All text',
			'section'	  => 'home-details',
            'std'         => 'View All',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
		array(
            'label'       => 'Contact Page Header',
            'id'          => 'contact_page_header',
            'type'        => 'text',
            'desc'        => 'Header text of the contact page',
			'section'	  => 'home-details',
            'std'         => 'Contact Us',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
		  
	  
		array(
            'label'       => 'Contact Information',
            'id'          => 'contact_details',
            'type'        => 'textarea',
            'desc'        => 'Enter your contact details here. You may use HTML tags.',
			'section'	  => 'contact',
            'std'         => '[hSmall]Where We Are?[/hSmall]

[h1]Nevon Theme Incorporation[/h1]Vestibulum aliquet mi at nisi posuere eget aliquam leo congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam a adipiscing enim. Pellentesque auctor nisi rutrum leo dignissim ornare faucibus nulla aliquam. Integer gravida, metus id molestie vestibulum, mi ligula ultricies metus, hendrerit facilisis ligula sem imperdiet leo. Duis nec leo ante, et imperdiet lectus.<br/>
[h4]Addresses[/h4]<img src="'.F_WAY.'/images/demo/logo.png" style="float:right" />

Warner Blvd, Los Angeles
California
United States of America
<br/>
 
[strong]Phone : [/strong] +123 555 5 555
[strong]E mail :[/strong] [link href="info@as3doctor.com" text="info@as3doctor.com"]
<br/><br/>
[clear]',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
	  
	  
      array(
        'label'       => 'CSS',
        'id'          => 'my_css',
        'type'        => 'css',
        'desc'        => 'DO NOT MAKE ANY CHANGES HERE',
        'std'         => '.nav ul li{
	border-color:{{menu_border_color|border-color}};
}

a, ol.commentlist li.comment div.vcard cite.fn, 
.products-holder .small-header-text-container a:hover, .toggle-header, .our-team .name,
.small-header-text-container > span.small-header-text a:hover{
	color:{{g_site_color|color}};
}

.comments-submit , .nav, .commentlist .reply a, #cancel-comment-reply-link,
#nevon-search input[type=search]:hover, .nevon-incontent-button, .control, #toTop,
.generalBtn, .navigation a, .date-area, .header-text-container .view-all,
 a.jms-link, .jms-dots span.jms-dots-current::after,
.iview-caption.caption5, .view a.info, .header-under-line{
	background-color:{{g_site_color|background-color}};
}

.box-shadow-dark{
	-webkit-box-shadow:inset 0 0 2px {{g_border_color}};
	-moz-box-shadow:inset  0 0 2px {{g_border_color}};
	box-shadow:inset 0 0 2px {{g_border_color}};
	border-color:{{g_border_color}};
}

.gallery-view{
	border-bottom:3px solid {{g_site_color|color}};
}

.header-text-container .view-all,.comments-submit, .commentlist .reply a, #cancel-comment-reply-link,
.nevon-incontent-button, .leftControl, .rightControl, #toTop, .generalBtn, .view a.info{
	border-color:{{g_border_color}};
}

#footer{
	border-color:{{g_site_color|color}};	
}

.step h3{
	color:{{nevon_slider_header_color|color}};	
}

.step p{
	color:{{nevon_slider_text_color|color}};
}

.step h3, .step p{
	text-shadow:{{nevon_slider_shadow_color}};	
}

.menu-top-bg,  .btn-top-bg{
	background-color:{{menu_bg_hover_color}};
}

.nav ul li.current_page_item > .btn-dark-hover{
	opacity:0.2 !important;
}

#nevon-search input[type=search]:focus{
	-moz-box-shadow:  0 0 2px {{g_border_color}};
	-webkit-box-shadow:  0 0 2px {{g_border_color}};
	box-shadow: 0 0 2px {{g_border_color}};
}

.details-border{
	border-color:{{g_border_color}};
}

.tabs_content_container{
	border-color:{{g_border_color}};
}

#footer{
	color: {{footer_text_color}};	
}

.nav a{
	color:{{menu_font_color}};
}

body{
	color:{{g_font_color}};
	font-size:{{site_font_size}};
}

.nav{
	font-size:{{site_nav_font_size}} !important;
}

#header-top a,  .tweets li a.timesince, blockquote ,
ol.commentlist li.comment p, .testimonial-intext, .testimonial,
.testimonial-author span, .sidebar, .navigation, .post-details{
	color:{{top_left_link_color}};
}

.slickr-flickr-gallery ul li {
	overflow:visible !important;	
}


/*

 FONT FAMILIES
*/

body{
	{{google_fonts_general}} !important;
	background:url({{upload_g_texture}});
}

.header-text-container, .header-text-container .view-all, h3.widget-title, .load-gallery > li,
.small-h1, .sidebar-header-text-container, .small-header-text-container, .view a.info{
	{{google_fonts_header}} !important;
}

.nav{
	{{google_fonts_menu}} !important;
}

.view{
	{{google_fonts_thumb}} !important;
}

#footer{
	background:{{footer_large_bg_color}} url({{upload_footer_texture}});
}

#footer-bottom{
	background-color:{{footer_bottom_color}};
}',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	  
	  
	array(
        'label'       => 'Site General Color',
        'id'          => 'g_site_color',
        'type'        => 'colorpicker',
        'desc'        => 'Site general color and main menu background color',
        'std'         => '#ec4f2c',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	array(
        'label'       => 'Button Border Color',
        'id'          => 'g_border_color',
        'type'        => 'colorpicker',
        'desc'        => 'Border color of buttons which contains border',
        'std'         => '#DD633C',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	array(
        'label'       => 'Site General a tag color',
        'id'          => 'g_site_a_color',
        'type'        => 'colorpicker',
        'desc'        => 'Main font color of the theme',
        'std'         => '#ec4f2c',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	array(
        'label'       => 'Menu font color',
        'id'          => 'menu_font_color',
        'type'        => 'colorpicker',
        'desc'        => 'Main menu font color',
        'std'         => '#fefeff',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	array(
        'label'       => 'Menu border color',
        'id'          => 'menu_border_color',
        'type'        => 'colorpicker',
        'desc'        => 'Main menu border color',
        'std'         => '#efbc9f',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	array(
        'label'       => 'General Font Color',
        'id'          => 'g_font_color',
        'type'        => 'colorpicker',
        'desc'        => 'Main font color of the theme',
        'std'         => '#3D3D3D',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	array(
        'label'       => 'Header Top Left Text Link',
        'id'          => 'top_left_link_color',
        'type'        => 'colorpicker',
        'desc'        => 'Header top left link (a tag) color',
        'std'         => '#888',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	array(
        'label'       => 'Footer Text Color',
        'id'          => 'footer_text_color',
        'type'        => 'colorpicker',
        'desc'        => 'Footer text color',
        'std'         => '#383838',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	array(
        'label'       => 'Nevon Slider Header Text Color',
        'id'          => 'nevon_slider_header_color',
        'type'        => 'colorpicker',
        'desc'        => 'Set the color of nevon slider header text',
        'std'         => '#999999',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	array(
        'label'       => 'Nevon Slider Description Text Color',
        'id'          => 'nevon_slider_text_color',
        'type'        => 'colorpicker',
        'desc'        => 'Set the color of nevon slider description text',
        'std'         => '#999999',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	array(
        'label'       => 'Nevon Slider Header and Description Text Color Shadow Color',
        'id'          => 'nevon_slider_shadow_color',
        'type'        => 'colorpicker',
        'desc'        => 'Set the color of nevon slider header and description text shadow',
        'std'         => '#FFFFFF',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'color-settings'
      ),
	  
	 array(
            'label'   => 'Google Font\'s Standart Code',
            'id'      => 'google_font_js',
            'desc'    => 'Enter general code of the google font.',
			'section' => 'font-settings',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
		  
	 array(
            'label'   => 'Site General Font Google Font CSS Code',
            'id'      => 'google_fonts_general',
            'desc'    => 'Enter the CSS Codes of the Google Font you\'ve selected for site\'s general font',
			'section' => 'font-settings',
            'std'     => 'font-family: "Open Sans", sans-serif;',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
		  
	 array(
            'label'   => 'Site Navigation (Menu) Font Google Font CSS Code',
            'id'      => 'google_fonts_menu',
            'desc'    => 'Enter the CSS Codes of the Google Font you\'ve selected for site\'s general font',
			'section' => 'font-settings',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
	  
	 array(
            'label'   => 'Site Headers (except special Nevon Header Style) Font Google Font CSS Code',
            'id'      => 'google_fonts_header',
            'desc'    => 'Enter the CSS Codes of the Google Font you\'ve selected for site\'s headers font',
			'section' => 'font-settings',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
		  
	 array(
            'label'   => 'Products Thumbnail Font Google Font CSS Code',
            'id'      => 'google_fonts_thumb',
            'desc'    => 'Enter the CSS Codes of the Google Font you\'ve selected for site\'s thumbnails font',
			'section' => 'font-settings',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),
	  
	array(
        'label'       => 'Site General Font Size',
        'id'          => 'site_font_size',
        'type'        => 'measurement',
        'desc'        => 'Set the site general font size',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font-settings'
      ),
	  
	  array(
        'label'       => 'Site Navigation (Menu) Font Size',
        'id'          => 'site_nav_font_size',
        'type'        => 'measurement',
        'desc'        => 'Set site\'s navigation (menu) font size',
        'std'         => array(0=>"1.4",1=>"em"),
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'font-settings'
      ),
	  
	  
	array(
        'label'       => 'Site General Background Texture',
        'id'          => 'upload_g_texture',
        'type'        => 'upload',
        'desc'        => 'If you want to change the general background texture, upload any background image here. If you want to use the default image, do not upload any image.',
        'std'         => 'images/furley_bg.png',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'background-settings'
      ),
	  
	array(
        'label'       => 'Site Footer Background Texture',
        'id'          => 'upload_footer_texture',
        'type'        => 'upload',
        'desc'        => 'If you want to change the footer background texture, upload any background image here. If you want to use the default, do not upload any image.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'background-settings'
      ),
	  
	array(
        'label'       => 'Footer Large Background Color',
        'id'          => 'footer_large_bg_color',
        'type'        => 'colorpicker',
        'desc'        => 'Footer large background color.',
        'std'         => '#EEEEEE',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'background-settings'
      ),
	  
	array(
        'label'       => 'Footer Bottom Background Color',
        'id'          => 'footer_bottom_color',
        'type'        => 'colorpicker',
        'desc'        => 'Footer bottom background color.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'background-settings'
      ),
	  
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}
?>