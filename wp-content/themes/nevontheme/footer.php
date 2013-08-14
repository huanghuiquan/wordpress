<?php $footer_large = ot_get_option('footer_large_enabled'); 
$footerLargeDisabled = false;
if(isset($footer_large) && is_array($footer_large) && $footer_large[0] === "Yes"){
	$footerLargeDisabled = true;	
}
 ?>
<div id="footer" <?php if($footerLargeDisabled) echo 'class="footer-no-large"';?>>
<?php if(!$footerLargeDisabled): ?>
    <div class="container">
    	<!-- FIRST FOOTER WIDGET -->
    	<?php if(dynamic_sidebar('Footer Widget 1')): ?>
        <?php else : ?>
        
        <?php endif; ?>
        
        
    	<!-- SECOND FOOTER WIDGET -->
    	<?php if(dynamic_sidebar('Footer Widget 2')): ?>
        <?php else : ?>
        
        <?php endif; ?>
        
        
    	<!-- THIRD FOOTER WIDGET -->
    	<?php if(dynamic_sidebar('Footer Widget 3')): ?>
        <?php else : ?>
        
        <?php endif; ?>
        
        
    	<!-- FOURTH FOOTER WIDGET -->
    	<?php if(dynamic_sidebar('Footer Widget 4')): ?>
        <?php else : ?>
			<div class="four columns footer-four">
                <h3 class="widget-title"><?php _e('Latest From Blog', 'nevontheme'); ?></h3>
                <ul class="latest-from-blog">
				<?php 
				$total = 2;
                $count = 0;
                    
                $footerPosts = new WP_Query( array('category_name'=> 'footer-posts'));
                            
                            
				while($footerPosts->have_posts() && $count < $total) : $footerPosts->the_post();
                ?>
                	<li>
                    <h3><a href="<?php the_permalink(); ?>"  class="footer-blog-h3"><?php the_title(); ?></a></h3>
                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" rel="prettyPhoto"'; ?>">
						<?php the_post_thumbnail('footer-image', array("alt" => get_the_title(), "rel"=> "[prettyPhoto]" )); ?>
                    </a>
                    <?php echo strip_images(118,true); ?>
                    <div class="clearFix"></div>
                    </li>
                    <?php 
                    $count++;
				endwhile; 
				?>
				</ul>
			</div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<div id="footer-bottom">
	<div class="container">
    	<div class="left padding-top-five">
        	<?php echo ot_get_option('footer_copyright','Designed by <a href="http://activeden.net/user/XanderRock/portfolio" target="_blank">XanderRock</a> © 2013 <a href="http://activeden.net/user/XanderRock/portfolio" target="_blank">Nevon Theme</a> | All Rights Reserved'); ?>
        </div>
    	<!-- THIRD FOOTER WIDGET -->
    	<?php if(dynamic_sidebar('Footer Bottom Widget 1')): ?>
        <?php else : ?>
        
        <?php endif; ?>
	</div>
</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<!--END OF BODY CONTAINER -->
</body>
</html>