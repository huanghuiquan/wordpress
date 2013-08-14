    	<div class="nivo-slider-container container">
    		<div id="iview">
        	<?php
					$efs_query= "category_name=iview-slider-posts&posts_per_page=99";
					query_posts($efs_query);
					
					$counter = 0;
					if (have_posts()) : while (have_posts()) : the_post(); 
						//$img= get_the_post_thumbnail( $post->ID, 'large' );
						$img = wp_get_attachment_image_src(  get_post_thumbnail_id($post->ID), 'slider-images');
						//$img = wp_get_attachment_url( get_post_thumbnail_id($post->ID,'slider-images') );
						//var_dump($img[0]);
						$link = get_url_desc_box();						
						if(strlen($link[0]) > 8){
							$return .= '<div data-iview:image="'.$img[0].'" class="iview-video" data-iview:type="video" >';
							$return .= '<iframe src="'.$link[0].'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
						}else{
							$return .= '<div data-iview:image="'.$img[0].'" >';
						}
						$tags = get_ivew_tags();
						if(count($tags) > 0){
							if($tags[0]){
								$return .= '<div class="iview-caption caption5" data-x="50" data-y="40">'.$tags[0].'</div>';
							}
							
							if(strlen($tags[1]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="115" data-transition="wipeRight">'.$tags[1].'</div>';
							}
							
							if(strlen($tags[2]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="160" data-transition="wipeLeft">'.$tags[2].'</div>';
							}
							
							if(strlen($tags[3]) > 0){
								$return .= '<div class="iview-caption blackcaption" data-x="50" data-y="205" data-transition="wipeRight">'.$tags[3].'</div>';
							}
							
						}
						$return .= '</div>';
						$counter++;
						
							
					endwhile; endif; wp_reset_query();
					
					echo $return;
			?>
            </div>
        </div>
    <div class="clearFix"></div>
<div class="container">
	<?php
	if(strlen(ot_get_option('under_slider_text','')) > 0){
		echo do_shortcode(ot_get_option('under_slider_text'));	
	}
	
	?>

    <?php echo do_shortcode('[headerText header="'.__(ot_get_option('iview_latest_projects'), 'nevontheme').'"]'); ?>
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
		$term_list = '';
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
    <ul class="gallery-grid four-col-gallery">
        <?php
				
        $pfportfolio = new WP_Query( array('post_type'=> 'filteredgallery', 'posts_per_page'=>8));
        while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();?>
        <?php
		
		$terms_as_text = strip_tags( get_the_term_list( $post->ID, 'filteredgallerytype', '', ' ', '' ) );
		
		$showObj = false;
		
		foreach(split(" ", $terms_as_text) as $singleTerm){
			if(strtoupper($singleTerm) == strtoupper($defaultTerm)){
				$showObj = true;
			}
		}
				
			
            echo '<li class="four-column four-column-img" data-id="post-'.get_the_ID().'" data-type="'.$terms_as_text.'"';
				if(strtoupper($defaultTerm) != "ALL" && 1==2){
					if($showObj){
							echo '>';	
						}else{
							echo ' style="display:none;">';	
						}
					}else{
						echo '>';	
				}
			
			echo '<div class="gallery-view four-column-img">';
            the_post_thumbnail('gallery-four', array("alt" => get_the_title() ));
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
<div class="clearFix"></div>
<div class="space-thirty"></div>
<?php echo do_shortcode('[headerText header="'.__(ot_get_option('iview_why_us'), 'nevontheme').'"]'); ?>


<?php 
if(strlen(ot_get_option('home_toggles','')) > 0){
	echo do_shortcode(ot_get_option('home_toggles'));
}
?>
    

    
    <div class="nevon-basic-slider right margin-right-zero">
    	<div class="small-h1"><?php _e(ot_get_option("home_testimonial_text"), 'nevontheme'); ?></div>
        <span class="small-dots"></span>
        <div class="control-holder">
            <span class="control rightControl">></span>
            <span class="control leftControl"><</span>
        </div>
    	<div class="nevon-basic-slider-container">
        <?php
			wp_reset_query();
	        $pfportfolio = new WP_Query( array('post_type'=> 'testimonials', 'nopaging'=>true));
			while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
			echo '<div class="slide">';
			echo '<blockquote class="testimonial">';
			echo '<p>'.the_content().'</p>';
			echo '</blockquote>';
			echo '<div class="arrow-down"></div>';
			echo '<p class="testimonial-author">'.get_the_title().' | <span>'.get_the_excerpt().'</span></p>';
			echo '</div>';
			
			endwhile;
			wp_reset_query();
        ?>
    	</div>
    </div>
    
	</div>
    <div class="clearFix"></div>
    <div class="space-thirty"></div>
    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".nevon-basic-slider").NevonBasic({autoSlide : true,direction:"ud"});
			jQuery(".nevon-basic-slider-copy").NevonBasic({direction:"rl"});
		});
		
		jQuery(window).load(function(){
			
			if(jQuery(".header-text-container")){
				resizeMainHeaders();
			}

			function resizeiViewControl(){
				var thisX = Math.floor((jQuery('#iview').width() - jQuery('.iview-controlNav').width())/2);
				jQuery('.iview-controlNav').css({"left":thisX,opacity:1}).show("fast");
			}
			setTimeout(resizeiViewControl,1500);
			
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
			
	        //jQuery('#slider').nivoSlider();

		});
	</script>
    