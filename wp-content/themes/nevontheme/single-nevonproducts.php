<?php
/*
Template Name: Product Single Page
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
<div class="main">




        <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
 
 						<?php
				echo '<div class="full-img-column-con full-img-column-img-con full-img-div">';
				echo '<div class="gallery-view full-img-column-img-con">';
				the_post_thumbnail('slider-images', array("alt" => get_the_title() ));
				echo '<a href="';
				$linkto = get_url_desc_box();
				if(strlen($linkto[0]) > 8){
					echo $linkto[0].'" ';
				}else{
					echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" rel="prettyPhoto"';
				}
				echo '>';
				echo '<div class="gallery-mask">';
				echo '</div>';
				echo '</a>';
				echo '</div>';
				echo '</div>';
				?>
                <div class="clearFix"></div>
				<?php
                $linkto = get_extra_btn();
                if(strlen($linkto[0]) > 8){
                ?>
                <div class="buttons" >
                    <?php echo do_shortcode('[makeButton link="'.$linkto[0].'" text="'.__($linkto[1], 'nevontheme').'" style="width:100%; font-weight:600; font-size:14px;"]'); ?>
                </div>
                
                <?php } ?>
            
			<div class="space-ten"></div>
            <div class="entry">
                <?php the_content(); ?>

<?php endwhile; endif;?>


<div class="clearFix"></div>
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