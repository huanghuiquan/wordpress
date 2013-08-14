<?php get_header();?>


<h3 class="section-title">
    <span>
        <?php printf( __( 'Search Results for: %s', THEMEMAKERS_THEME_FOLDER_NAME), '<span>' . get_search_query() . '</span>' ); ?>    
    </span>
</h3>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix"); ?>>

            <?php
            $post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
            $post_type_values = get_post_meta($post->ID, 'post_type_values', true);
            ?>

            <div class="entry-meta">


                <a href="<?php the_permalink(); ?>"><span class="post-format bcolor <?php echo $post_pod_type ?>">Permalink</span></a>
                <a href="<?php echo home_url() ?>/?m=<?php the_time('Ym'); ?>"><span class="post-date tcolor"><?php echo ThemeMakersHelper::format_post_date() ?></span></a>

            </div><!--/ .entry-meta-->

            <div class="entry-title">

                <?php if ($post_pod_type == 'link'): ?>
                    <h5 class="title"><a href="<?php echo $post_type_values[$post_pod_type] ?>" target="_blank"><?php the_title(); ?></a></h5>
                <?php else: ?>
                    <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <?php endif; ?>

				<?php if (!$_REQUEST['hide_post_categories']){ ?>
                <span class="category"><b><?php _e('Category', THEMEMAKERS_THEME_FOLDER_NAME); ?>:</b>
                    <?php the_category(', ') ?>
                </span>
				<?php } ?>
					
				<?php if (!$_REQUEST['hide_post_tag']){ ?>
                <span class="tags">
                    <?php the_tags('<b>' . __('Tags', THEMEMAKERS_THEME_FOLDER_NAME) . ':</b>&nbsp;') ?>
                </span>
				<?php } ?>

                <?php if (!$_REQUEST['disable_blog_comments']): ?>
                    <span class="comments">
                        <b><?php _e('Comments', THEMEMAKERS_THEME_FOLDER_NAME); ?>:</b>&nbsp;<a href="<?php the_permalink(); ?>/#comments"><?php comments_number('0', '1', '%'); ?></a>
                    </span>
                <?php endif; ?>

            </div><!--/ .entry-title-->

            <div class="clear"></div>

            <div class="entry-body">

                <div class="post-entry">

						<?php the_content(); ?>
						
                </div><!--/ .post-entry-->

            </div><!--/ .entry-body -->

            <a href="<?php the_permalink(); ?>" data-arrow="&nbsp;&rarr;" class="more"><?php _e('Read more', THEMEMAKERS_THEME_FOLDER_NAME); ?></a>

        </article><!--/ .entry-->

    <?php endwhile; ?>
<?php else: ?>
    <?php get_template_part('content', 'nothingfound'); ?>
<?php endif; ?>



<?php //get_template_part('content', null); ?>
<?php get_template_part('content', 'pagenavi'); ?>
<?php get_footer(); ?>
