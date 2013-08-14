<?php
 if(function_exists('nslider_get_slider')): ?>
        <div class="nevon-slider-container">
        <?php echo nslider_get_slider(); ?>
        </div>
    <div class="clearFix"></div>
    <?php endif; ?>
<div class="space-fifty"></div>
<div class="container">

    <?php echo do_shortcode(ot_get_option('home_iconic_text')); ?>
    
    
<div class="space-fifty"></div>
    
<div class="clearFix"></div>


	<?php echo do_shortcode("[headerText header='".__(ot_get_option("home_products_text"))."']"); ?>
    <div class="home-products-container full-products">
    <?php
	$homeproducts = new WP_Query( array('post_type'=> 'nevonproducts', 'posts_per_page'=> '8'));
	
	
	if ($homeproducts->have_posts()) : while ($homeproducts->have_posts()) : $homeproducts->the_post(); 
		
			echo '<div class="view four-column four-column-img">';
			echo '<div class=" view-first gallery-view four-column-img ">';
            the_post_thumbnail('gallery-four');
            echo '<div class="mask">';
            echo '<h2>'.get_the_title().'</h2>';
            echo '<p>'.strip_images(100,false).'</p>';
				
				$linkto = get_url_desc_box();
				if(strlen($linkto[0]) > 8){
					echo '<a href="'.$linkto[0].'" class="info">'.__(ot_get_option("read_more_text")).'</a>';
				}else{
					echo '<a href="'.get_permalink().'" class="info">'.__(ot_get_option("read_more_text")).'</a>';
				}

            echo '</div>';
            echo '</div>';
			echo '</div>';
			
	endwhile; endif; wp_reset_query();
	?>
    </div><!-- Closing home products div-->
    <div class="clearFix"></div>
    <?php echo do_shortcode('[makeButton link="'.ot_get_option("home_products_link").'" text="'.__(ot_get_option("home_view_all_text")).'" style="margin-left:5px; font-weight:600; font-size:14px;"]'); ?>
    <div class="space-fifty"></div>
    
    <div class="nevon-basic-slider">
    	<div class="small-h1"><span class="in-text"><?php _e(ot_get_option("home_testimonial_text")); ?></span></div>
        <span class="small-dots"></span>
        <div class="control-holder">
            <span class="control rightControl">></span>
            <span class="control leftControl"><</span>
        </div>
    	<div class="nevon-basic-slider-container">
        <?php
			wp_reset_query();
			$hasTestimonials = false;
	        $pfportfolio = new WP_Query( array('post_type'=> 'testimonials', 'nopaging'=>true));
			while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
			$hasTestimonials = true;
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
    
	<div class="nevon-basic-slider-copy">
    	<div class="small-h1"><span class="in-text"><?php _e(ot_get_option("home_references_text")); ?></span></div>
        <span class="small-dots"></span>
        <div class="control-holder">
            <span class="control rightControl">></span>
            <span class="control leftControl"><</span>
        </div>
    	<div class="nevon-basic-slider-container" style="height:180px;">
	    <?php
			$max = 3;
			$total = 0;
			$hasGallery = false;
	        $pfportfolio = new WP_Query( array('post_type'=> 'references', 'nopaging'=>true));
			while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();
				$hasGallery = true;
				if($total == 0){ echo '<div class="slide" >';}
				echo '<li class="six-column six-column-img" style="margin-right:3px; margin-left:0px">';
				echo '<div class="gallery-view six-column-img">';
				the_post_thumbnail('gallery-six', array("alt" => get_the_title() ));
				echo '<a href="';
				$linkto = get_url_desc_box();
				if(strlen($linkto[0]) > 8){
					echo $linkto[0].'" rel="prettyPhoto"';
				}else{
					echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" rel="prettyPhoto"';
				}
				echo '>';
				echo '<div class="gallery-mask">';
				echo '</div>';
				echo '</a>';
				echo '</div>';
				echo '</li>';
				
				$total++;
				if($total >= $max) {
					echo '</div>';
				}
				
				if($total >= $max) {$total = 0;}
			endwhile;
			
			if ($total != 0) echo "</div>";
			wp_reset_postdata();
			?>
    	</div>
    </div>
	</div>

    <div class="clearFix"></div>
    <div class="space-twenty"></div>
    
    <script type="text/javascript">
		jQuery(window).load(function(){
			<?php if($hasTestimonials): ?>
			jQuery(".nevon-basic-slider").NevonBasic({autoSlide : true,direction:"ud"});
			<?php endif; ?>
			<?php if($hasGallery): ?>
			jQuery(".nevon-basic-slider-copy").NevonBasic({direction:"rl"});
			<?php endif; ?>
			
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

							jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
								duration:400,
								easing:"easeOutSine"
								});	
					}
				);	
			}
			
				
			if(jQuery(".small-h1")){
				resizeSmallHs();
			}
			
			function resizeSmallHs(){
				jQuery(".small-h1").each(
					function(){
						var totalWidth = jQuery(this).width();// + 8 jQuery(this).parent().find(" + ;
						var headerWidth = jQuery("span.in-text",this).width();
						var dotsWidth = totalWidth - 30 - headerWidth - 66;
						
						
						jQuery(this).parent().find(".small-dots").stop().animate({width:dotsWidth,opacity:1},{
									duration:400,
									easing:"easeOutSine"
									});	
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
    <?php

?>
