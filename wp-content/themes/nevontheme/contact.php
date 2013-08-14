<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<div class="container">
<div class="space-ten"></div>
<?php the_breadcrumb(); ?>
<div class="space-ten"></div>
<?php echo do_shortcode("[headerText header='".get_the_title()."']"); ?>
<?php
echo do_shortcode('[bgmp-map]');
?>
<div class="space-fifty"></div>

<div id="contact-page">
<?php 
if($sidebar == "left-sidebar"){;
	get_sidebar();
}
?>


<!--
	MAIN CONTENT STARTS HERE
-->
<div class="<?php if($sidebar != 'full-width') {echo 'main-sidebar';}else{echo 'main';}?> 
<?php if($sidebar == 'left-sidebar') {echo 'margin-l-fourty';}else if($sidebar == 'right-sidebar'){echo 'margin-r-fourty';} ?>
">

<div class="contact-block-relative">
<?php echo apply_filters('the_content',ot_get_option('contact_details')); ?>
</div>
<div class="space-thirty"></div>
<div class="clearFix"></div>

<div id="contactForm" class="contactForm">
	
	<?php echo do_shortcode('[hSmall]'.__(ot_get_option('contact_page_header'), 'nevontheme').'[/hSmall]'); ?>
	
	<form method="post">
		<ul>
			<li>
				<input type="text" class="comments-field inputs-class" name="name" id="name" title="Name :" value="Name :" />
				<span id="errorName" class="formError"></span>
			</li>
			<li>
				<input type="text" class="comments-field inputs-class margin-right-zero" name="email" id="email" title="Email :" value="Email :" />
				<span id="errorEmail" class="formError"></span>
			</li>
         <?php 
		 if($sidebar == "full-width"){
			echo '</ul><div class="clearFix"></div><ul>'; 
		 }
		 ?>
			<li>
				<input type="text" class="comments-field inputs-class margin-top-minus-three" name="phone" id="phone" title="Phone :" value="Phone :" />
				<span id="errorName" class="formError"></span>
			</li>
			<li>
				<input type="text" class="comments-field inputs-class margin-top-minus-three margin-right-zero" name="company" id="company" title="Company :" value="Company :"/>
				<span id="errorEmail" class="formError"></span>
			</li>
			<li>
                <textarea class="comments-field inputs-class width-ninety-six margin-top-zero" title="Your Message :" name="message" id="message" cols="100%" rows="10" tabindex="4">Your Message :</textarea>
				<span id="errorMessage" class="formError"></span>
			</li>
         <?php 
		 if($sidebar == "full-width"){
			echo '</ul><div class="clearFix"></div><ul>'; 
		 }
		 ?>
            <?php if(1==1) : ?>
            <li class="inputs-class-num" >
            	<div id="math-number" class="noSelect math-number-class"></div><input type="text" id="input-number" class="math-number-input" />
                <div id="num-info" class="num-info-class"><?php _e('Are You Human?', 'nevontheme') ?></div>
            </li>
            <?php endif; ?>
			<li>
				<input type="submit" value="Send" id="submit" class="comments-submit margin-right-zero"  />
			</li>
            <div class="clearFix"></div>
			<span id="formProgress" class="formProgress"></span>

		</ul>
	</form>
</div>



<div class="header-vertical-space"></div>
</div>
<!--
	MAIN CONTENT ENDS HERE
-->
</div>
<?php 
if($sidebar == "right-sidebar"){
	get_sidebar();
}
?>


</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	
		var firstNum = Math.floor(Math.random() * 18);
		var secondNum = Math.floor(Math.random() * 18);
		var numAnswer;
		var rand = Math.floor(Math.random()*2);
		switch(rand){
			case 0:
			jQuery("#math-number").html(firstNum+" + "+secondNum+" = ");
			numAnswer = firstNum + secondNum;
			break;
			
			case 1:
			if(firstNum >= secondNum){
				jQuery("#math-number").html(firstNum+" - "+secondNum+" = ");
				numAnswer = firstNum - secondNum;
			}else{
				jQuery("#math-number").html(secondNum+" - "+firstNum+" = ");
				numAnswer = secondNum - firstNum;
			}
			break;
			
			case 2:
			if(firstNum.toString().length == 1 || secondNum.toString().length == 1){
				jQuery("#math-number").html(firstNum+" * "+secondNum+" = ");
				numAnswer = firstNum * secondNum;
			}else{
				jQuery("#math-number").html(firstNum+" + "+secondNum+" = ");
				numAnswer = firstNum + secondNum;
			}
			break;
		}


	jQuery('#contactForm #submit').click(function() {
		// Fade in the progress bar
		jQuery('#contactForm #formProgress').hide();
		jQuery('#contactForm #formProgress').html('<img src="<?php echo F_WAY.'/images/ajax-loader.gif'; ?>" /> Sending&hellip;');
		jQuery('#contactForm #formProgress').fadeIn();
		
		// Disable the submit button
		jQuery('#contactForm #submit').attr("disabled", "disabled");
		
		
		// Clear and hide any error messages
		jQuery('#contactForm .formError').html('');
		
		// Set temaprary variables for the script
		var isFocus=0;
		var isError=0;
		
		// Get the data from the form
		var name=jQuery('#contactForm #name').val();
		var email=jQuery('#contactForm #email').val();
		var phone=jQuery('#contactForm #phone').val();
		var company=jQuery('#contactForm #company').val();
		var message=jQuery('#contactForm #message').val();
		
		// Validate the data
		if(name=='' || name== jQuery("#contactForm #name").attr('title')) {
			jQuery('#contactForm #name').val('This is a required field.');
			jQuery('#contactForm #name').addClass("box-shadow-dark");
			isFocus=1;
			isError=1;
		}
		if(jQuery("#input-number").val() != numAnswer){
			jQuery("#num-info").html("Answer is not correct");
			jQuery("#input-number").parent().addClass("box-shadow-dark");
			isError=1;
		}
		if(email=='' || email== jQuery("#contactForm #email").attr('title') || email == "Invalid email address." ) {
			jQuery('#contactForm #email').val('This is a required field.');
			jQuery('#contactForm #email').addClass("box-shadow-dark");
			isFocus=1;
			isError=1;
		} else {
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if(reg.test(email)==false) {
				jQuery('#contactForm #email').val('Invalid email address.');
				if(isFocus==0) {
					jQuery('#contactForm #email').addClass("box-shadow-dark");;
					isFocus=1;
				}
				isError=1;
			}
		}
		if(message=='' || message== jQuery("#contactForm #message").attr('title')) {
			jQuery('#contactForm #message').val('This is a required field.');
			jQuery('#contactForm #message').addClass("box-shadow-dark");;
			isFocus=1;
			isError=1;
		}
		// Terminate the script if an error is found
		if(isError==1) {
			jQuery('#contactForm #formProgress').html('');
			jQuery('#contactForm #formProgress').hide();
			
			// Activate the submit button
			jQuery('#contactForm #submit').removeAttr("disabled");
			return false;
		}
		
		jQuery.ajaxSetup ({
			cache: false
		});
		var user = <?php echo json_encode(get_settings('admin_email')); ?>;
		var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone + '&company=' + company + '&message=' + message +'&user='+user;  
		jQuery.ajax({
			type: "POST",
			url: "<?php echo stripslashes((admin_url( 'admin-ajax.php' ))); ?>",
			data: "action=contact_forum&"+dataString,
			success: function(msg) {
				
				//alert(msg);
				// Check to see if the mail was successfully sent
				if(msg=='Mail sent') {
					// Update the progress bar
					jQuery('#contactForm #formProgress').html('<img src="<?php echo F_WAY.'/images/ajax-complete.gif'; ?>" /> Message sent.');
					
					// Clear the subject field and message textbox
					jQuery('#contactForm #subject').val('');
					jQuery('#contactForm #message').val('');
				} else {
					jQuery('#contactForm #formProgress').html('There was an error sending your email. Please try again.');
					//alert();
				}
				
				// Activate the submit button
				jQuery('#contactForm #submit').removeAttr("disabled");
			},
			error: function(ob,errStr) {
				jQuery('#contactForm #formProgress').html('There was an error sending your email. Please try again.');
				//alert('');
				
				// Activate the submit button
				jQuery('#contactForm #submit').removeAttr("disabled");
			}
		});
		
		return false;
	});
	
	
	jQuery('.comments-field').each(
		function(){
			jQuery(this).live('focus', function() {
				if ( jQuery(this).val() == jQuery(this).attr('title') || jQuery(this).val() == "This is a required field." || jQuery(this).val() == "Invalid email address.") jQuery(this).val('');
				jQuery(this).addClass("box-shadow-dark");
			});
			jQuery(this).live('blur', function() {
				if ( jQuery(this).val() == '' ) jQuery(this).val(jQuery(this).attr('title'));
				jQuery(this).removeClass("box-shadow-dark");
			});
		}
	);

	
});
</script>

<script type="text/javascript">

jQuery(window).load(function(){
	// JavaScript Document		
	if(jQuery(".sidebar-header-text-container").length > 0){
		resizeSidebarHeaders();
	}
	
	if(jQuery(".small-header-text-container")){
		resizeSmallHeaders();
	}
	
	if(jQuery(".header-text-container")){
		resizeMainHeaders();
	}
	
	function resizeSidebarHeaders(){
		jQuery(".sidebar-header-text-container").each(
			function(){
				var headerWidth = jQuery("span.sidebar-header-text",this).width();
				var mainWidth = jQuery(".sidebar li").width();
				var sidebarWidth = Math.floor((mainWidth - headerWidth )/2) - 14;
				//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
					jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
						duration:400,
						easing:"easeOutSine"
						});	
				//}
			}
		);	
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

						//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
							jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
								duration:400,
								easing:"easeOutSine"
								});	
						//}
					}
				);	
			}


	jQuery(".comment-reply-link").click(function(){
		jQuery("#cancel-comment-reply-link").css("opacity","0");
		 resizeSmallHeaders();
	});
	jQuery("#cancel-comment-reply-link").click(function(){setTimeout(resizeSmallHeaders,400);});
	
	function resizeSmallHeaders(){
		jQuery(".small-header-text-container").each(
			function(){
				var headerWidth = jQuery("span.small-header-text",this).width();
				var mainWidth;
				if(jQuery(this).parent().parent().find(".details-area").length > 0){
					mainWidth = jQuery(this).parent().parent().find(".details-area").width();
					
					var sidebarWidth = Math.floor((mainWidth - headerWidth )) - 18;
					//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
						jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
							duration:400,
							easing:"easeOutSine"
							});	
					//}
				}else{
					mainWidth = jQuery(this).width();
					var sidebarWidth = Math.floor((mainWidth - headerWidth )) - 18;
					//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
						jQuery("span.left, span.right",this).stop().animate({width:sidebarWidth,opacity:1},{
							duration:400,
							easing:"easeOutSine"
							});	
					//}
					if(jQuery("#cancel-comment-reply-link").css("opacity") == 0){
						jQuery("#cancel-comment-reply-link").delay(400).animate({"opacity":1},400);	
					}
				}
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

<?php get_footer();?>