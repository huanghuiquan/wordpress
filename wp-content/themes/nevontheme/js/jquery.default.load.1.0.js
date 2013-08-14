// JavaScript Document

jQuery(window).load(function(){  
		jQuery(window).scroll(function() {
			if(jQuery(this).scrollTop() > 180) {
				jQuery('#toTop').fadeIn();	
			} else {
				jQuery('#toTop').fadeOut();
			}
		});
	 
		jQuery('#toTop').click(function() {
			jQuery('body,html').animate({scrollTop:0},800);
		});	


			var productViewHeight;
			var productViewWidth;
			var productViewBtnLeft;
				jQuery(".view .view-first").each(
					function(){
						productViewHeight = jQuery(this).height();
						productViewWidth = jQuery(this).width();
						productViewBtnLeft = Math.floor((productViewWidth -  jQuery("a.info",this).width() - 30)/2);

						jQuery("a.info",this).css({"top":productViewHeight,"width":productViewWidth - 30});

						if(navigator.userAgent.match(/ipad/i)){
							jQuery(this).find(".mask").css({opacity:1,"background-color":"rgba(55, 55, 55, 0)"});
							jQuery(this).find(".mask").attr("style","background-color:rgba(55, 55, 55, 0); opacity:1 !important;");
							jQuery(this).find("a.info").css({top:"45%", opacity:1});
							jQuery(this).find("a.info").attr("style","top:45% !important; opacity:1 !important; width:100%; left:-15px;");
						}
					}
				
				);

});

