<?php
/*
Template Name: Products Big
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



    <div class="home-products-container">
    <?php
	wp_reset_query();
	$postNum = ot_get_option('products-per-page',10);
			$newPostQuery = query_posts( array(  
			  'post_type' => 'nevonproducts', 
			  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
			  'posts_per_page' => $postNum
		 )); 
	$homeproducts = new WP_Query( array('post_type' => 'nevonproducts','paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),'posts_per_page' => $postNum));
	
	if ($homeproducts->have_posts()) : while ($homeproducts->have_posts()) : $homeproducts->the_post(); 
		
		//echo the_title();
		?>
        <div class="products-holder">
                <div class="small-header-text-container" >
                    <span class="small-header-text"><a href="<?php echo get_permalink(); ?>" ><?php echo get_the_title(); ?></a></span>
                	<span class="right"></span>
                </div>

				<?php
				echo '<div class="full-img-column full-img-column-img products-big-div-class">';
				echo '<div class="gallery-view full-img-column-img">';
				the_post_thumbnail('full-column-img', array("alt" => get_the_title() ));
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
            <div class="details-area details-area-big-reg <?php if($sidebar=="full-width") echo 'details-area-height' ?> <?php if($sidebar === 'full-width') {echo 'width-three';}else{echo 'width-full';} ?>">
            	<div class="details-area-in details-area-in-big <?php if($sidebar!="full-width") echo 'details-width-four-six-five' ?>  ">
                <?php 
				echo '<h3>'.get_the_title().'</h3>';
				echo strip_images(188,false); ?>
                </div>
				<?php if($sidebar === 'full-width') echo "<hr />" ?>
                <div class="buttons details-button-class <?php if($sidebar === 'full-width') echo 'right'; ?>">
					<?php echo do_shortcode('[makeButton link="'.get_permalink().'" text=" text="'.ot_get_option('read_more_text').'" style="width:auto; margin-right:10px; border:none; border-radius:0px"]'); 
					$linkto = get_extra_btn();
					//var_dump($linkto[0]);
					if(strlen($linkto[0]) > 8){
						  echo do_shortcode('[makeButton link="'.$linkto[0].'" text="'.$linkto[1].'" style="width:auto; margin-right:10px; border:none; border-radius:0px"]');
					}?>
                </div>
            </div>
        
		</div>
		<?php if($sidebar !== 'full-width') echo '<div class="space-five"></div><hr />' ?>
        <div class="space-fifty"></div>
        <?php
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
				if(jQuery(".products-holder").width() < 800){
					mainWidth = jQuery(this).parent().parent().find(".details-area").width();
				}else{
					mainWidth = jQuery(".products-holder").width();
				}
				
				var sidebarWidth = Math.floor((mainWidth - headerWidth )) - 18;
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