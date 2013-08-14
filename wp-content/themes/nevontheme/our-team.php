<?php
/*
Template Name: Our Team
*/
?>

<?php get_header(); ?>
<div class="container">
<div class="space-ten"></div>
<?php the_breadcrumb(); ?>
<div class="space-ten"></div>
<?php echo do_shortcode("[headerText header='".get_the_title()."']"); ?>
<div id="single-pages">

<!--
	MAIN CONTENT STARTS HERE
-->
<div id="content-canvas" class="main container">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<?php the_content(); endwhile; endif; wp_reset_query(); ?>
<div class="clearFix"></div>
<div class="space-fifty"></div>
<?php echo do_shortcode('[hSmall]'.__('Our Team', 'nevontheme').'[/hSmall]'); ?>
<?php
	wp_reset_query();
	$homeproducts = new WP_Query( array('post_type' => 'ourteam', 'posts_per_page' => -1));
	
	
	$teamArray = array();
	$teamArray[0] = array();
	$teamArray[1] = array();
	$teamArray[2] = array();
	$teamArray[3] = array();
	$teamArray[4] = array();

	
	
	if ($homeproducts->have_posts()) : while ($homeproducts->have_posts()) : $homeproducts->the_post(); 
	
		$terms_as_text = get_the_term_list( $post->ID, 'ourteamtype', '', ', ', '' );
		
		$thisTerms = explode(',',strip_tags($terms_as_text));
		$return = "";
		
       	$return .= '<div class="entry four columns our-team-class">';
		
		$return .= '<div class="our-team-div">';
		$return .= get_the_post_thumbnail($post->ID,'footer-image', array("alt" => get_the_title() ));
		$return .=  '</div>';

		$return .= '<div class="our-team">
            	<div class="name">'.get_the_title().'</div>
				<div class="duty">'.strip_tags($terms_as_text).'</div>';
		$return .= '<div class="info">'.strip_shortcodes(strip_images(100,false)).'</div>';
		
		
		$pattern = get_shortcode_regex();
		preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches );

		if( is_array( $matches ) && array_key_exists( 2, $matches ) && in_array( 'socialSingle', $matches[2] ) )
		{
			$return .= '<div class="team-social">';
			foreach ($matches[0] as $value) {
				$value = wpautop( $value, true );
				$return .= do_shortcode($value);
			}
			$return .= '</div>';
		} else {
			// Do Nothing
		}
		
		
		//return .= get_shortcodes_only();
                
        $return .= '</div>';
		$return .= '</div>';
		
		if(strpos($terms_as_text,'Founder') > -1){
			//var_dump($teamArray[0]);
			array_push($teamArray[0],$return);
		}elseif(strpos($terms_as_text,'CEO') > -1){
			//var_dump($teamArray[1]);
			array_push($teamArray[1],$return);;
		}elseif(strpos($terms_as_text,'Manager') > -1 ){
			//var_dump($teamArray[2]);
			array_push($teamArray[2],$return);
		}elseif(strpos($terms_as_text,'Employee') > -1){
			//var_dump($teamArray[3]);
			array_push($teamArray[3],$return);
			//array_push($teamArray[3],$return);
		}else{
			//var_dump($teamArray[4]);
			array_push($teamArray[4],$return);
		}
		
endwhile; 
//var_dump($teamArray);
for($i = 0; $i< count($teamArray); $i++){
	if(count($teamArray[$i]) > 0){
		foreach($teamArray[$i] as $team){
		echo $team;
		}
	}
}

?>
<div class="clearFix"></div>
<div class="space-fifty"></div>

<?php
wp_reset_query();
endif;?>



<div class="header-vertical-space"></div>
</div>
<!--
	MAIN CONTENT ENDS HERE
-->
</div>


</div>
</div>


<script type="text/javascript">

jQuery(window).load(function(){
	if(jQuery(".sidebar-header-text-container").length > 0){
		resizeSidebarHeaders();
	}
	
	if(jQuery(".small-header-text-container")){
		resizeSmallHeaders();
	}
	
	if(jQuery(".header-text-container")){
		resizeMainHeaders();
	}
	
	function resizeSidebarHeaders(){
		jQuery(".sidebar-header-text-container").each(
			function(){
				var headerWidth = jQuery("span.sidebar-header-text",this).width();
				var mainWidth = jQuery(".sidebar li").width();
				var sidebarWidth = Math.floor((mainWidth - headerWidth )/2) - 14;
				//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
					jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
						duration:400,
						easing:"easeOutSine"
						});	
				//}
			}
		);	
	}
	
	
			function resizeMainHeaders(){
				jQuery(".header-text-container").each(
					function(){
						var headerWidth = jQuery("span.header-text",this).width();
						var mainWidth = jQuery(".container").width();
						var sidebarWidth = Math.floor((mainWidth - headerWidth )/2) - 24;
						
						if(jQuery("a.view-all",this).length > 0){
							sidebarWidth -= (jQuery("a.view-all",this).width() + 10) / 2;
						}

						//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
							jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
								duration:400,
								easing:"easeOutSine"
								});	
						//}
					}
				);	
			}


	jQuery(".comment-reply-link").click(function(){
		jQuery("#cancel-comment-reply-link").css("opacity","0");
		 resizeSmallHeaders();
	});
	jQuery("#cancel-comment-reply-link").click(function(){setTimeout(resizeSmallHeaders,400);});
	
	function resizeSmallHeaders(){
		jQuery(".small-header-text-container").each(
			function(){
				var headerWidth = jQuery("span.small-header-text",this).width();
				var mainWidth;
				if(jQuery(this).parent().parent().find(".details-area").length > 0){
					mainWidth = jQuery(this).parent().parent().find(".details-area").width();
					
					var sidebarWidth = Math.floor((mainWidth - headerWidth )) - 18;
					//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
						jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
							duration:400,
							easing:"easeOutSine"
							});	
					//}
				}else{
					mainWidth = jQuery(this).width();
					var sidebarWidth = Math.floor((mainWidth - headerWidth )) - 18;
					//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
						jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
							duration:400,
							easing:"easeOutSine"
							});	
					//}
					if(jQuery("#cancel-comment-reply-link").css("opacity") == 0){
						jQuery("#cancel-comment-reply-link").delay(400).animate({"opacity":1},400);	
					}
				}
			}
		);	
	}
	
	var productViewHeight;
	var productViewWidth;
	var productViewBtnLeft;
	jQuery(".view .view-first").each(
		function(){
			productViewHeight = jQuery(this).height();
			productViewWidth = jQuery(this).width();
			productViewBtnLeft = Math.floor((productViewWidth -  jQuery("a.info",this).width() - 30)/2);
			jQuery("a.info",this).css({"top":productViewHeight,"left":productViewBtnLeft});
		}
	
	);

});

</script>

<?php get_footer();?>