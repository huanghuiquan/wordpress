<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('facebook_links'); ?>"><?php _e('Facebook Link', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('facebook_links'); ?>" name="<?php echo $widget->get_field_name('facebook_links'); ?>" value="<?php echo $instance['facebook_links']; ?>" />
</p>


<p>
    <label for="<?php echo $widget->get_field_id('facebook_tooltip'); ?>"><?php _e('Facebook Tooltip', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('facebook_tooltip'); ?>" name="<?php echo $widget->get_field_name('facebook_tooltip'); ?>" value="<?php echo $instance['facebook_tooltip']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('twitter_links'); ?>"><?php _e('Twitter Link', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('twitter_links'); ?>" name="<?php echo $widget->get_field_name('twitter_links'); ?>" value="<?php echo $instance['twitter_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('twitter_tooltip'); ?>"><?php _e('Twitter Tooltip', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('twitter_tooltip'); ?>" name="<?php echo $widget->get_field_name('twitter_tooltip'); ?>" value="<?php echo $instance['twitter_tooltip']; ?>" />
</p>


<p>
    <label for="<?php echo $widget->get_field_id('youtube_links'); ?>"><?php _e('Youtube Link', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('youtube_links'); ?>" name="<?php echo $widget->get_field_name('youtube_links'); ?>" value="<?php echo $instance['youtube_links']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('youtube_tooltip'); ?>"><?php _e('Youtube Tooltip', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('youtube_tooltip'); ?>" name="<?php echo $widget->get_field_name('youtube_tooltip'); ?>" value="<?php echo $instance['youtube_tooltip']; ?>" />
</p>


<p>
    <?php
    $checked = "";
    if ($instance['show_rss_tooltip'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_rss_tooltip'); ?>" name="<?php echo $widget->get_field_name('show_rss_tooltip'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_rss_tooltip'); ?>"><?php _e('Show RSS Link', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
</p>


<p>
    <label for="<?php echo $widget->get_field_id('rss_tooltip'); ?>"><?php _e('RSS Tooltip', THEMEMAKERS_THEME_FOLDER_NAME) ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('rss_tooltip'); ?>" name="<?php echo $widget->get_field_name('rss_tooltip'); ?>" value="<?php echo $instance['rss_tooltip']; ?>" />
</p>



