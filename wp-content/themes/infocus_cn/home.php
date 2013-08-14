<?php
/**
 * Home Template
 *
 * @package Mysitemyway
 * @subpackage Template
 */

get_header(); 

$post_obj = $wp_query->get_queried_object();
?>


<?php mysite_after_page_content(); ?>

		<div class="clearboth"></div>
	</div><!-- #main_inner -->
</div><!-- #main -->

<?php get_footer(); ?>
