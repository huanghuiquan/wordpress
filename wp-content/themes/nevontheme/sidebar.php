<?php //if(get_option('nt_design_or_blog') == "Blog"): ?>
    <div class="sidebar <?php if(isset($sidebar) && $sidebar == 'left-sidebar'){echo 'left';}else{echo 'right';}?>">
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
     
    <?php endif; ?>
    </div>

<?php //endif; ?>
