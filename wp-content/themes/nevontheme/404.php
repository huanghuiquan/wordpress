<?php
/*
Template Name: 404 Error Page
*/
?>

<?php get_header(); ?>
<div class="container min-h-six">
<div class="space-thirty"></div>
<div class="error-header"><?php _e('4.0.4. Oops..'); ?><br/></div>
<div class="error-not-found"><?php _e('Page Not Found','nevontheme'); ?></div>
<div class="error-desc"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please try the following:'); ?><br/><br/>
<ul>
    <li class="list-default"><?php _e('Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly'); ?></li>
    <li class="list-default"><?php _e('If you reached this page by clicking a link, contact us to alert us that the link is incorrectly formatted'); ?></li>
    <li class="list-default"><?php _e('Forget that this ever happened, and go to our '); ?><a href="<?php echo get_option('home')?>"><?php _e('home page'); ?></a></li>
</ul><br />
<?php echo do_shortcode('[makeButton style="width:180px;" text="'.__('Go to Home Page','nevontheme').'" link="'.get_option('home').'"]'); ?>
<div class="clearFix"></div>
<div class="space-forty"></div>
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