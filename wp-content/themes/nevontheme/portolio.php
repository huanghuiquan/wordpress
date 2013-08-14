<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<div id="pages" style="height:<?php 

	$totalHeight = 108;
	$countFiltered = wp_count_posts('portfolioproducts')->publish;
	$totalHeight = $totalHeight + (($countFiltered/ 4) * 198) + 100;
	echo $totalHeight;


?>px;">
<ul class="load-portfolio">
		<?php 		
		$defaultTerm = "ALL";//get_option('nt_filtered_default');
		
		if(strtoupper($defaultTerm) == "ALL") : ?>
		<li class="active"><a href="#" class="all">All</a></li>
        <?php endif; ?>
        <?php
        $args = array( 'taxonomy' => 'portfolioproductstype' );
        $terms = get_terms('portfolioproductstype', $args);
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
<div id="filtered-portfolio">   
    <ul class="portfolio-grid">
        <?php
				
        $pfportfolio = new WP_Query( array('post_type'=> 'portfolioproducts', 'nopaging'=>true, 'order'=>'ASC'));
        while ( $pfportfolio->have_posts() ) : $pfportfolio->the_post();?>
        <?php
		
		$terms_as_text = strip_tags( get_the_term_list( $post->ID, 'portfolioproductstype', '', ' ', '' ) );
		
		$showObj = false;
		
		foreach(split(" ", $terms_as_text) as $singleTerm){
			if(strtoupper($singleTerm) == strtoupper($defaultTerm)){
				$showObj = true;
			}
		}
				
			
            echo '<li data-id="post-'.get_the_ID().'" data-type="'.$terms_as_text.'"';
				if(strtoupper($defaultTerm) != "ALL" && 1==2){
					if($showObj){
							echo '>';	
						}else{
							echo ' style="display:none;">';	
						}
					}else{
						echo '>';	
				}
			
			echo '<div class="filtered-canvas">';
			echo '<div class="filtered-date">';
			echo get_the_date();
			echo '</div>';
			echo '<a href="';
			the_permalink();
			echo '">';
            the_post_thumbnail('small-thumb');
            echo '<span class="portfolio-title">';
            the_title();
            echo '</span>';
			echo '</a>';
			echo '</div>';
			echo '<div class="filter-shadow"></div>';
            echo '</li>';
        endwhile;
        wp_reset_postdata();
        ?>
    </ul>
</div>
</div>
</div>
<?php get_footer(); ?>