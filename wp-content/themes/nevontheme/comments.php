<?php

/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'nevontheme'); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
                <div class="small-header-text-container" >
                    <span class="small-header-text"><?php comments_number(__('No Comments', 'nevontheme'), __('One Comment', 'nevontheme'), __('% Comments', 'nevontheme') );?> to "<?php the_title(); ?>"</span>
                	<span class="right"></span>
                </div>


	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
	<div class="clearFix"></div>
	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'nevontheme'); ?></p>

	<?php endif; ?>
<?php endif; ?>
<div class="clearFix"></div>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
                <div class="small-header-text-container" >
                    <span class="small-header-text"><?php comment_form_title( __('Leave a Comment', 'nevontheme'), __('Leave a Comment to %s', 'nevontheme') );  ?></span>
                	<span class="right"></span>
                </div>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be ', 'nevontheme'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'nevontheme'); ?></a><?php _e(' to post a comment.', 'nevontheme'); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as '); ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out ', 'nevontheme'); ?>&raquo;</a></p>

<?php else : ?>
<ul>
<li><input name="author" id="author" class="comments-field inputs-class" title="Name :" type="text" value="Name :"></li>

<li><input name="email" id="email" class="comments-field inputs-class margin-right-zero" title="Email :" type="text" value="Email :"></li>
</ul>
<div class="clearFix"></div>

<?php endif; ?>

<textarea class="comments-field inputs-class width-ninety-six margin-top-zero" title="Your Message :" name="comment" id="comment" cols="100%" rows="10" tabindex="4">Your Message :</textarea>

<p><input class="comments-submit" name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>

