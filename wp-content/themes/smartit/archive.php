<?php get_header();?>


<h3 class="section-title">
    <span>        
        
         <?php if (is_day()) : ?>
            <?php printf(__('Daily Archives: %s', THEMEMAKERS_THEME_FOLDER_NAME), '<span>' . get_the_date() . '</span>'); ?>
        <?php elseif (is_month()) : ?>
            <?php printf(__('Monthly Archives: %s', THEMEMAKERS_THEME_FOLDER_NAME), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', THEMEMAKERS_THEME_FOLDER_NAME)) . '</span>'); ?>
        <?php elseif (is_year()) : ?>
            <?php printf(__('Yearly Archives: %s', THEMEMAKERS_THEME_FOLDER_NAME), '<span>' . get_the_date(_x('Y', 'yearly archives date format', THEMEMAKERS_THEME_FOLDER_NAME)) . '</span>'); ?>
       <?php elseif(is_post_type_archive('testimonials')): ?>
			<?php _e('Testimonials', THEMEMAKERS_THEME_FOLDER_NAME); ?>
		 <?php else : ?>
            <?php _e('Blog Archives', THEMEMAKERS_THEME_FOLDER_NAME); ?>
        <?php endif; ?>        
    </span>
</h3>

<?php get_template_part('content', null); ?>
<?php get_template_part('content', 'pagenavi'); ?>
<?php get_footer(); ?>

