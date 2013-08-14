<?php
/*
Template Name: Gallery With Pages Two Column
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
        
		wp_reset_query();
		$postNum = ot_get_option('gallery-per-page',18);
			$newPostQuery = query_posts( array(  
			  'post_type' => 'filteredgallery', 
			  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
			  'posts_per_page' => $postNum
		 )); 
	$pfportfolio = new WP_Query( array('post_type' => 'filteredgallery','paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),'posts_per_page' => $postNum));
	
		while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
		
            echo '<div class="two-column two-column-img">';
			
			echo '<div class="gallery-view two-column-img">';
            the_post_thumbnail('gallery-two', array("alt" => get_the_title() ));
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
        endwhile;
					?>
    	<div class="clearFix"></div>
        <div class="space-twenty"></div>

	        <div class="navigation" >
        <?php makePagination();	?>
        </div>
        <?php

        wp_reset_postdata();
        ?>
</div>
    <div class="clearFix"></div>
    
    <div class="header-vertical-space"></div>

</div>
<script type="text/javascript">
jQuery(window).load(function(){
	
	if(jQuery(".header-text-container")){
		resizeMainHeaders();
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

});
</script>
<?php get_footer(); ?>