<?php
/*
Template Name: Products With Columns
*/
?>

<?php get_header(); ?>
<div class="container">
<div class="space-ten"></div>
<?php the_breadcrumb(); ?>
<div class="space-ten"></div>
<?php echo do_shortcode("[headerText header='".get_the_title()."']"); ?>
<div id="pages">
<?php 
if($sidebar == "left-sidebar"){;
	get_sidebar();
}
?>
<!--
	MAIN CONTENT STARTS HERE
-->
<div class="<?php if($sidebar != 'full-width') {echo 'main-sidebar';}else{echo 'main';}?> 
<?php if($sidebar == 'left-sidebar') {echo 'margin-l-fourty';}else if($sidebar == 'right-sidebar'){echo 'margin-r-fourty';} ?>
">



    <div class="product-columns-response">
    <?php
	wp_reset_query();
	$postNum = ot_get_option('products-per-page',10);
			$newPostQuery = query_posts( array(  
			  'post_type' => 'nevonproducts', 
			  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
			  'posts_per_page' => $postNum
		 )); 
	$homeproducts = new WP_Query( array('post_type' => 'nevonproducts','paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 'posts_per_page' => $postNum));
	
	if ($homeproducts->have_posts()) : while ($homeproducts->have_posts()) : $homeproducts->the_post(); 
		
		//echo the_title();
			echo '<div class="view three-column three-column-img">';
			echo '<div class=" view-first gallery-view three-column-img ">';
            the_post_thumbnail('gallery-three');
            echo '<div class="mask">';
            echo '<h2>'.get_the_title().'</h2>';
            echo '<p>'.strip_images(140,false).'</p>';
            echo '<a href="'.get_permalink().'" class="info">'.ot_get_option('read_more_text').'</a>';
            echo '</div>';
            echo '</div>';
			//echo '<div class="shadow-three"></div>';
			echo '</div>';
			
	endwhile; ?>
    	<div class="clearFix"></div>
        <div class="space-twenty"></div>

	        <div class="navigation">
        <?php makePagination();	?>
        </div>

	<?php
	endif; wp_reset_query();
	?>
    </div><!-- Closing home products div-->
    <div class="clearFix"></div>
    
    <div class="header-vertical-space"></div>








</div>
<!--
	MAIN CONTENT ENDS HERE
-->



<?php 
if($sidebar == "right-sidebar"){;
	get_sidebar();
}
?>

</div>

</div>
<script type="text/javascript">
jQuery(window).load(function(){
	if(jQuery(".sidebar-header-text-container").length > 0){
		resizeSidebarHeaders();
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
<?php get_footer(); ?>