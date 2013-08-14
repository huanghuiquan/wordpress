<?php
/**
 * @package WordPress
 * Template Name: News
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

    <div id="container">
      <div id="news-list" >
        <h2>最新资讯</h2>
        <ul>
        <?php
        $args = array( 'posts_per_page' => 200, 'offset'=> 0 );
        query_posts( $args );
        if(have_posts()): while(have_posts()) : the_post(); ?>
          <li>
            <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span class="date"><?php the_date("Y/m/d") ?> </span>
            <?php the_excerpt(); ?>
          </li>
        <?php endwhile; endif; 
        wp_reset_query();?>
        </ul>

      </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer(); ?>

