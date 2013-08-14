<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>
<div class="container">
<div class="space-ten"></div>
<?php the_breadcrumb(); ?>
<div class="space-ten"></div>
<?php echo do_shortcode("[headerText header='".get_the_title()."']"); ?>
<div id="single-pages">
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


<?php
wp_reset_query();
/*
global $query_string;
var_dump($query_string);
$query_args = explode("&", $query_string);


$sargs = explode("/",$s);
$s = $sargs[0];
$page = $sargs[count($sargs) -1];

var_dump($page);
*/
	$search = new WP_Query( array('s' => $s, 'paged' => $page));
	


//$search = new WP_Query("s=$s & showposts=-1");



 if ( have_posts() ) : ?>
	<div id="search-results-header" class="bg-grey">
				<p class="page-title search-page-title-style"><?php printf( __( 'Search Results for : %s', 'xanieTheme' ), '<span>' . get_search_query() . '</span>' ); ?></p>
	</div>
	<hr class="hr-twenty-twentyfive"/>
	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		
	<div class="post blog-search products-holder">
                <div class="small-header-text-container" >
                    <span class="small-header-text"><a href="<?php echo get_permalink(); ?>" class="color-inherit"><?php echo get_the_title(); ?></a></span>
                	<span class="right"></span>
                </div>
		<div class="entry"><br />
			<p><?php echo strip_shortcodes(strip_images(380)); ?></p>
		</div>
	<hr class="hr-twenty-twentyfive"/>
	</div>
		
	<?php endwhile; ?>				
	        <div class="navigation">
        <?php 
	$total_pages = $search->max_num_pages;
	if ($total_pages > 1){  
  
	  $current_page = max(1, get_query_var('paged'));  

	  echo paginate_links(array(  
		  'base' =>  esc_url(home_url()).'%_%'.'?s='.$s,  
		  'format' => '/page/%#%',  
		  'current' => $current_page,  
		  'total' => $total_pages,  
		));  
	}
		
			?>
        </div>
        <div class="clearFix"></div>
        <div class="space-forty"></div>
        
	<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 //get_template_part( 'loop', 'search' );
	?>
<?php else : ?>
	<div id="post-0" class="post no-results not-found">
		<h2 class="entry-title"><?php echo 'Nothing Found'; ?></h2>
		<div class="entry-content">
			<p><?php echo 'Nothing matched with "<strong>'.$s.'</strong>". Please try again with some different keywords.'; ?></p>
			<div class="space-ten"></div>
            <form id="nevon-incontent-search-id" action="<?php echo esc_url(home_url()); ?>">
                <input type="search" name="s" class="nevon-incontent-search">
                <input type="submit" id="search-submit" name="search-button"  class="nevon-incontent-button" value="Search">
            </form>

			
			
			<?php //get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
    <script type="text/javascript">
		jQuery(".header-text-container .header-text").text("Nothing Matched");
	</script>
<?php endif; ?>


</div>
<!--
	MAIN CONTENT ENDS HERE
-->
</div>
<?php 
if($sidebar == "right-sidebar"){
	get_sidebar();
}
?>


</div>
</div>


<script type="text/javascript">

jQuery(window).load(function(){
	jQuery('.nevon-incontent-search').each(
		function(){
			jQuery(this).live('focus', function() {
				jQuery(this).addClass("box-shadow-dark");
			});
			jQuery(this).live('blur', function() {
				jQuery(this).removeClass("box-shadow-dark");
			});
		}
	);
	
	
	
	
	
	
	
	
	
	
	
	
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
