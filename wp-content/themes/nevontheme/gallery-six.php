<?php
/*
Template Name: Gallery Six Column
*/
?>

<?php get_header(); ?>
<div class="container">
<div class="space-ten"></div>
<?php the_breadcrumb(); ?>
<div class="space-ten"></div>
<?php echo do_shortcode("[headerText header='".get_the_title()."']"); ?>

<div id="pages">

<ul class="load-gallery">
		<?php 		
		$defaultTerm = "ALL";//get_option('nt_filtered_default');
		
		if(strtoupper($defaultTerm) == "ALL") : ?>
		<li class="active"><a href="#" class="all">All</a></li>
        <?php endif; ?>
        <?php
        $args = array( 'taxonomy' => 'filteredgallerytype' );
        $terms = get_terms('filteredgallerytype', $args);
        $count = count($terms); $i=0;
        if ($count > 0) {
            $cape_list = '';
            foreach ($terms as $term) {
                $i++;
                $term_list .= '<li';
				if(strtoupper($term->name) == strtoupper($defaultTerm) && strtoupper($defaultTerm) != "ALL"){
					$term_list .= ' class="active">';
				}else{
					$term_list .= '>';
				}
				
				$term_list .= '<a href="#" class="'. $term->name.'">' . $term->name . '</a></li>';
                if ($count != $i) $term_list .= ''; else $term_list .= '';
            }
            echo $term_list;
        }
         ?>
    </ul>
<div id="filtered-gallery">   
    <ul class="gallery-grid six-col-gallery">
        <?php
				
        $pfportfolio = new WP_Query( array('post_type'=> 'filteredgallery', 'posts_per_page' => ot_get_option('gallery-filtered-six-total',18)));
        while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();?>
        <?php
		
		$terms_as_text = strip_tags( get_the_term_list( $post->ID, 'filteredgallerytype', '', ' ', '' ) );
		
		$showObj = false;
		
		foreach(split(" ", $terms_as_text) as $singleTerm){
			if(strtoupper($singleTerm) == strtoupper($defaultTerm)){
				$showObj = true;
			}
		}
				
			
            echo '<li class="six-column six-column-img" data-id="post-'.get_the_ID().'" data-type="'.$terms_as_text.'"';
				if(strtoupper($defaultTerm) != "ALL" && 1==2){
					if($showObj){
							echo '>';	
						}else{
							echo ' style="display:none;">';	
						}
					}else{
						echo '>';	
				}
			
			echo '<div class="gallery-view six-column-img">';
            the_post_thumbnail('gallery-six', array("alt" => get_the_title() ));
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

			
			echo '</li>';
			
			/*
			echo '</div>';
			echo '<div class="filter-shadow"></div>';
            echo '</li>';
			*/
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(window).load(function(){
	
	if(jQuery(".header-text-container")){
		resizeMainHeaders();
	}
	
	var totalLi = jQuery("#filtered-gallery li").length;
	var changeHeight = parseInt(58  + (Math.ceil(totalLi/ 6) * 130));
	jQuery("#pages").css("min-height",changeHeight+"px");

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