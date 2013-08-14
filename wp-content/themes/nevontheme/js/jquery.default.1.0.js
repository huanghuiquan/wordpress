// JavaScript Document

jQuery(document).ready(function(){  


    var input = jQuery('input#s');
    var divInput = jQuery('div.input');
    var width = divInput.width();
    var outerWidth = divInput.parent().width() - (divInput.outerWidth() - width) - 28;
    var submit = jQuery('#searchSubmit');
    var txt = input.val();
    
    input.bind('focus', function() {
        if(input.val() === txt) {
            input.val('');
        }
        jQuery(this).animate({color: '#000'}, 300); // text color
        jQuery(this).parent().animate({
            width: outerWidth + 'px',
            backgroundColor: '#fff', // background color
            paddingRight: '43px'
        }, 300, function() {
            if(!(input.val() === '' || input.val() === txt)) {
                if(!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                    submit.fadeIn(300);
                } else {
                    submit.css({display: 'block'});
                }
            }
        }).addClass('focus');
    }).bind('blur', function() {
        jQuery(this).animate({color: '#b4bdc4'}, 300); // text color
        jQuery(this).parent().animate({
            width: width + 'px',
            backgroundColor: '#e8edf1', // background color
            paddingRight: '15px'
        }, 300, function() {
            if(input.val() === '') {
                input.val(txt)
            }
        }).removeClass('focus');
        if(!(jQuery.browser.msie && jQuery.browser.version < 9)) {
            submit.fadeOut(100);
        } else {
            submit.css({display: 'none'});
        }
    }).keyup(function() {
        if(input.val() === '') {
            if(!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                submit.fadeOut(300);
            } else {
                submit.css({display: 'none'});
            }
        } else {
            if(!(jQuery.browser.msie && jQuery.browser.version < 9)) {
                submit.fadeIn(300);
            } else {
                submit.css({display: 'block'});
            }
        }
    });


	//HANDLE HEADERS WIDTH
	if(jQuery(".header-text-container").length > 0){
		resizeHeaders();
	}
	
	function resizeHeaders(){
		jQuery(".header-text-container").each(
			function(){
				if(jQuery(this).find("span.left, span.right").css("display") == "none"){
					jQuery(this).find("span.left, span.right").css({"display":"inline"});
				}
				if(jQuery(this).height() > jQuery("span.header-text",this).height()+2 || jQuery("span.header-text",this).height() > 80){
					jQuery(this).find("span.left, span.right").css({"display":"none"});
				}
			}
		);
	}


	function resizeSocialIcons(){
		if(jQuery(".social-icon-class") && jQuery(window).width() <= 640){
			var iconHWidth = jQuery(".top-right").width();
			var totalIcon = 0;
			totalIcon = jQuery(".top-right").children(".social-icon-class").length;
			var fLeft = parseInt(iconHWidth - parseInt(parseInt(totalIcon * 36) ))/2 - 3;
			jQuery(".top-right").find(".social-icon-class").each(
				function(){
					jQuery(this).css({"right":fLeft+"px"});
				}
			);
			
		}
	}
	resizeSocialIcons();
	
	jQuery('.comments-field').each(
		function(){
			jQuery(this).live('focus', function() {
				if ( jQuery(this).val() == jQuery(this).attr('title') ) jQuery(this).val('');
				jQuery(this).addClass("box-shadow-dark");
			});
			jQuery(this).live('blur', function() {
				if ( jQuery(this).val() == '' ) jQuery(this).val(jQuery(this).attr('title'));
				jQuery(this).removeClass("box-shadow-dark");
			});
		}
	);

	
	//resize sidebar headers
	/*
	if(jQuery(".sidebar-header-text-container").length > 0){
		resizeSidebarHeaders();
	}
	
	function resizeSidebarHeaders(){
		jQuery(".sidebar-header-text-container").each(
			function(){
				var headerWidth = jQuery("span.sidebar-header-text",this).outerWidth(true);
				var mainWidth = jQuery(".sidebar li").outerWidth(true);
				var sidebarWidth = Math.floor((mainWidth - headerWidth )/2) - 4;
				//if((jQuery("span.left",this).width() * 2) + headerWidth > mainWidth){
					jQuery("span.left, span.right",this).css({width:sidebarWidth});	
				//}
			}
		);	
	}
	*/
	//MENU
	jQuery(".nav > ul > li").hover(
		function(){
			jQuery(this).find("> ul").stop(true, true).slideDown(150);//.animate({marginLeft: '-250px'},1500);
			jQuery(".btn-dark-hover-nav", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(this).find("> ul").stop(true, true).delay(280).fadeOut();//animate({marginLeft: '0px'},1500);
			if(!jQuery(this).hasClass("current_page_item")) jQuery(".btn-dark-hover-nav", this).stop().animate({opacity:0});
			}
		)).css('position', 'relative').prepend( jQuery("<div>").addClass('btn-dark-hover-nav'));
	
	if(jQuery("ul.nav")){
		jQuery("ul.nav > li").hover(
			function(){
				jQuery(this).find("> ul").stop(true, true).slideDown(150);//.animate({marginLeft: '-250px'},1500);
				jQuery(".btn-dark-hover-nav", this).stop().animate({opacity:0.2});
			},(
			function(){
				jQuery(this).find("> ul").stop(true, true).delay(280).fadeOut();//animate({marginLeft: '0px'},1500);
				if(!jQuery(this).hasClass("current_page_item")) jQuery(".btn-dark-hover-nav", this).stop().animate({opacity:0});
				}
			)).css('position', 'relative').prepend( jQuery("<div>").addClass('btn-dark-hover-nav'));
	}
	
	jQuery(".nav > ul > li > ul > li").hover(
		function(){
			jQuery(this).find("> ul").stop(true, true).animate({width: 'toggle'},150);
			jQuery(".sub-nav-hover", this).stop().animate({opacity:1});
		},(
		function(){
			jQuery(this).find("> ul").stop(true, true).animate({width: 'toggle'},150);
			jQuery(".sub-nav-hover", this).stop().animate({opacity:0});
			})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('sub-nav-hover'));
	
	if(jQuery("ul.nav > li > ul > li")){
		jQuery("ul.nav > li > ul > li").hover(
			function(){
				jQuery(this).find("> ul").stop(true, true).animate({width: 'toggle'},150);
				jQuery(".sub-nav-hover", this).stop().animate({opacity:1});
			},(
			function(){
				jQuery(this).find("> ul").stop(true, true).animate({width: 'toggle'},150);
				jQuery(".sub-nav-hover", this).stop().animate({opacity:0});
				})
		
		).css('position', 'relative').append( jQuery("<div>").addClass('sub-nav-hover'));
	}
	
	jQuery(".nav > ul > li > ul > li > ul > li").hover(
		function(){
			jQuery(".sub-sub-nav-hover", this).stop().animate({opacity:1});
		},(
		function(){
			jQuery(".sub-sub-nav-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('sub-sub-nav-hover', {"opacity":"0"}));
	
	if(jQuery("ul.nav > li > ul > li > ul > li")){
		jQuery("ul.nav > li > ul > li > ul > li").hover(
			function(){
				jQuery(".sub-sub-nav-hover", this).stop().animate({opacity:1});
			},(
			function(){
				jQuery(".sub-sub-nav-hover", this).stop().animate({opacity:0});
			})
		
		).css('position', 'relative').append( jQuery("<div>").addClass('sub-sub-nav-hover', {"opacity":"0"}));
	}
	
	jQuery("a.jms-link").hover(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0.2});
		},(
			function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0});
			})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover'));

	
	jQuery(".view a.info").hover(
		function(){
			
				jQuery(".btn-dark-hover", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover'));
	
	
	jQuery(".header-text-container .view-all").hover(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover', {"opacity":"0"}));
	
	
	jQuery(".generalBtn a").hover(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover', {"opacity":"0"}));

	
	
	jQuery(".blogroll li").hover(
		function(){
			jQuery(".btn-light-hover-quart", this).stop().animate({opacity:0.6});
		},(
		function(){
			jQuery(".btn-light-hover-quart", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-light-hover-quart', {"opacity":"0"}));
	
	jQuery(".menu-footer-bottom-menu-container ul li").hover(
		function(){
			jQuery(".btn-light-hover", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-light-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-light-hover', {"opacity":"0"}));
	
	jQuery(".navigation a").hover(
		function(){
			jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover-noz', {"opacity":"0"}));



	jQuery(".load-gallery li a").hover(
		function(){
			jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0.2});
		},(
		function(){
			if(!jQuery(this).parent("li").attr("class")){
				jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0});
			}else if(jQuery(this).parent("li").attr("class") && jQuery(this).parent("li").attr("class").indexOf("active") > -1){
				//jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0});
			}else{
				jQuery(".btn-dark-hover-noz", this).stop().animate({opacity:0});
			}
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover-noz', {"opacity":"0"}));
	
	if(jQuery(".load-gallery li.active")){
		jQuery(".load-gallery li.active").find(".btn-dark-hover-noz").css("opacity","0.2");
	}
	/*
	jQuery(".load-gallery li a").click(
		function(){
			var inThis = jQuery(this).parent();
			jQuery(this).parent().parent().find("li").not(inThis).find(".btn-dark-hover-noz").stop().animate({opacity:0});
		}
	);
*/
	
	jQuery('.latest-from-blog a img').hover(
		function(){
			jQuery(this).stop().animate({opacity: 0.6});
		},
		function(){
			jQuery(this).stop().animate({opacity:1});
		}
	);
	
	jQuery("a > img").each(function(){
		var attr = jQuery(this).parent("a").attr("rel");
		var href = jQuery(this).parent("a").attr("href");
		if(typeof attr !== 'undefined' && attr !== false || href.indexOf("flickr") > -1){
		}else{
			jQuery(this).parent("a").attr("rel","prettyPhoto[content]");
		}
	});
	
	//jQuery('.tweets li').prepend( jQuery("<div>").addClass('tweet-icon'));
	
	
	jQuery(".gallery-view a .gallery-mask").not(".noImgBorder").each(
		function(){
			//alert("IMG "+jQuery(this).parent().html());
			if(jQuery(this).parent().attr("href")){
				var imgLink = jQuery(this).parent().attr("href");
				var linkType = "";
				
				if(imgLink.substr(imgLink.length - 3) == "jpg" || 
					imgLink.substr(imgLink.length - 3) == "png" ||
					imgLink.substr(imgLink.length - 3) == "gif" ||
					imgLink.substr(imgLink.length - 4) == "jpeg"){
					
					linkType = "hoverImg";		
				}else if(imgLink.indexOf("vimeo") > -1 ||
						imgLink.indexOf("youtube") > -1 ||
						imgLink.indexOf("vevo") > -1 ||
						imgLink.indexOf("youtu") > -1 ||
						imgLink.indexOf(".mov") > -1 ){
					linkType = "hoverVideo";
				}else {
					linkType = "hoverLink";
				
				}
				if(linkType != "hoverLink"){
					jQuery(this).parent().attr("rel","prettyPhoto[filteredGallery]");
				}
				
				jQuery(this).addClass(linkType);
				//jQuery(this).append( jQuery("<div>").addClass(linkType));
				//alert("LINK IS "+linkType);
			}
		}
	)
	/*
	jQuery(".hoverVideo, .hoverImg, .hoverLink").hover(
		function(){
			jQuery(this).stop().animate({opacity:1},400);	
		},
		function(){
			jQuery(this).stop().animate({opacity:0},600);	
		}
	);
	*/
	jQuery(".gallery-view .gallery-mask").live({
		mouseenter:function(){
			//alert("HOVER");
			jQuery(this).parent().parent().parent().find(".gallery-view").stop().animate({"borderWidth":"0px"},100);
			jQuery(this).stop().animate({opacity:1,"background-position":"50% 50%"},400);	
		},
		mouseleave:function(){
			jQuery(this).parent().parent().parent().find(".gallery-view").stop().animate({"borderWidth":"3px"},100);
			jQuery(this).stop().animate({opacity:0,"background-position":"50% -50%"},600);
		}
	}).css({"background-position":"50% -50%"});
	
	var toTopLooping = false;
	var stopTopLooping = false;
	//Only activate the toTop background motion if the browser is not IE8 and earlier
	if(!jQuery.browser.msie && parseInt(jQuery.browser.version) > 9){
		jQuery("#toTop").hover(
			function(){
				stopTopLooping = false;
				//jQuery(this).stop().animate({});	
				if(!toTopLooping){
					toTopLooping = true;
					toTopLoop();
				}
			},
			function(){
				stopTopLooping = true;
			}
		);
	}
	
	function toTopLoop(){
		jQuery("#toTop").
		animate({"background-position":"50% -550%"},{duration: 400,
                    easing: 'easeInQuart', complete:function(){
						jQuery(this).css({"background-position":"50% 550%"}).
						animate({"background-position":"50% 50%"},{duration: 400,
                    easing: 'easeOutQuart', queue:true, complete:function(){toTopLooping = false; if(!stopTopLooping){setTimeout(toTopLoop,250);}}});
						}}).delay(500);
	}
	
	
	jQuery(window).resize(function() {
		if(jQuery(window).width() < 768){
				
			
		}
		
		
		//resize headers
		if(jQuery(".header-text-container").length > 0){
			resizeHeaders();
		}
		
		//resize social icons
		resizeSocialIcons();


	});
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	var productViewHeight;
	jQuery(".view .view-first").live({
		mouseenter:function(){
			//alert("HOVER");
			jQuery(this).find(".mask p").stop().animate({opacity:1,"top":"0px"}, {
                    duration: 200,
                    easing: 'easeInOutSine'
			})
			
			jQuery(this).find(".mask").stop().animate({opacity:1,alpha:1}, {
                    duration: 400,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).find(".mask, h2").stop().animate({opacity:1,"top":"0px"}, {
                    duration: 400,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).find("a.info").stop().animate({opacity:1,"top":productViewHeight-30}, {
                    duration: 500,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).parent().find(".gallery-view").stop().delay(150).animate({"borderWidth":"0px"},300);
		},
		mouseleave:function(){
			//alert("HOVER");
			jQuery(this).find(".mask p").stop().animate({opacity:0,"top":"100px"}, {
                    duration: 100,
                    easing: 'easeInOutSine'
			})
			
			jQuery(this).find(".mask").stop().animate({opacity:0,alpha:0}, {
                    duration: 400,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).find(".mask h2").stop().animate({opacity:1,"top":"-100px"}, {
                    duration: 400,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).find("a.info").stop().animate({opacity:0,"top":productViewHeight}, {
                    duration: 200,
                    easing: 'easeInOutSine'
			});
			
			jQuery(this).parent().find(".gallery-view").stop().animate({"borderWidth":"3px"},100);
		}
	}).each(
		function(){
			productViewHeight = jQuery(this).height();
			/*productViewWidth = jQuery(this).width();
			productViewBtnLeft = (productViewWidth -  jQuery("a.info",this).width())/2;*/
			jQuery("a.info",this).css({"top":productViewHeight});
		}
	
	);
	
	
	
	
	
/*
FIX FUNCTIONS
*/
//jQuery background position fix
(function($) {
if(!window.defaultView || !window.defaultView.getComputedStyle){
    var oldCurCSS = jQuery.curCSS != undefined ? jQuery.curCSS : jQuery.css;
    jQuery.curCSS = function(elem, name, force){
        if(name === 'background-position'){
            name = 'backgroundPosition';
        }
        if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
            return oldCurCSS.apply(this, arguments);
        }
        var style = elem.style;
        if ( !force && style && style[ name ] ){
            return style[ name ];
        }
        return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
    };
}

var oldAnim = $.fn.animate;
$.fn.animate = function(prop){
    if('background-position' in prop){
        prop.backgroundPosition = prop['background-position'];
        delete prop['background-position'];
    }
    if('backgroundPosition' in prop){
        prop.backgroundPosition = '('+ prop.backgroundPosition + ')';
    }
    return oldAnim.apply(this, arguments);
};

function toArray(strg){
    strg = strg.replace(/left|top/g,'0px');
    strg = strg.replace(/right|bottom/g,'100%');
    strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
    var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
    return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
}

$.fx.step.backgroundPosition = function(fx) {
    if (!fx.bgPosReady) {
        var start = $.curCSS(fx.elem,'backgroundPosition');

        if(!start){//FF2 no inline-style fallback
            start = '0px 0px';
        }

        start = toArray(start);

        fx.start = [start[0],start[2]];

        var end = toArray(fx.end);
        fx.end = [end[0],end[2]];

        fx.unit = [end[1],end[3]];
        fx.bgPosReady = true;
    }

    var nowPosX = [];
    nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
    nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];
    fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];
};
})(jQuery);	
	
	
	
	/*
		RESPONSIVE NAV
	*/
	function activateMenu(){
	jQuery("<select />",
	{
		"class":"selectNav"
	
	}).appendTo(".nav");

	// Create default option "Go to..."
	jQuery("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "Go to..."
	}).appendTo(".nav select");
	
	// Populate dropdown with menu items
	jQuery(".nav li a").each(function() {
	 var el = jQuery(this);
	 var subCheck = jQuery(this).parent().parent().attr('class') ; 

	 var isSub = "";
	 
	 if(subCheck == "children" || subCheck == "sub-menu"){
		  isSub = "--";
		  
		  //if(jQuery(".nav > ul").length > 0){
			  if(jQuery(this).parent().parent().parent().parent().attr('class') == "children"  || 
			  jQuery(this).parent().parent().parent().parent().attr('class') == "sub-menu") {isSub += "--";}
		  //}
	 }
	 
	 
	 if(isSub != ""){
		 jQuery("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : isSub+" "+el.text()
		 }).appendTo(".nav select");
	 }else{
		 jQuery("<option />", {
			 "value"   : el.attr("href"),
			 "text"    : el.text()
		 }).appendTo(".nav select");
	 }
	});
	}
	
		
	
	jQuery(".nav select").live('change',function() {
	  window.location = jQuery(this).find("option:selected").val();
	});
	
	
	
	jQuery(".leftControl, .rightControl").hover(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0.2});
		},(
		function(){
			jQuery(".btn-dark-hover", this).stop().animate({opacity:0});
		})
	
	).css('position', 'relative').append( jQuery("<div>").addClass('btn-dark-hover', {"opacity":"0"}));


	
	
	

	
	
	/*
	
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
	
	*/
	
	
	
	
/*
	PORTFOLIO
*/
 
  // get the action filter option item on page load
  var filterType = jQuery('.load-gallery li.active a').attr('class');
 
  // get and assign the ourHolder element to the
    // jQueryholder varible for use later
  var holder = jQuery('ul.gallery-grid');
 
  // clone all items within the pre-assigned jQueryholder element
  var data = holder.clone();
 
  // attempt to call Quicksand when a filter option
    // item is clicked
    jQuery('.load-gallery li a').click(function(e) {
		
		e.preventDefault();
		
		jQuery(".load-gallery .active .btn-dark-hover-noz").stop().animate({"opacity":"0"});
        // reset the active class on all the buttons
        jQuery('.load-gallery li').removeClass('active');
 
        // assign the class of the clicked filter option
        // element to our jQueryfilterType variable
        var filterType = jQuery(this).attr('class');
        jQuery(this).parent().addClass('active');
 		jQuery(".load-gallery li.active .btn-dark-hover-noz").stop().animate({"opacity":"0.2"});

        if (filterType == 'all') {
            // assign all li items to the jQueryfilteredData var when
            // the 'All' filter option is clicked
            var filteredData = data.find('li');
        }
        else {
            // find all li elements that have our required jQueryfilterType
            // values for the data-type element
            var filteredData = data.find('li[data-type~=' + filterType + ']');
        }
 
        // call quicksand and assign transition parameters
		
        holder.quicksand(filteredData, {
			duration:800,
            easing: 'easeInOutQuad'
        },
		

function(jVar) {
jQuery('a[rel^="prettyPhoto"]').prettyPhoto({ social_tools: '<div class="twitter"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/tweet_button.html?count=none&amp;url={location_href}" style="border:none; overflow:hidden; width:59px; height:20px;"></iframe></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?href={location_href}&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:21px;" allowTransparency="true"></iframe></div>' });

	});

		
        return false;
    });
	
	
		activateMenu();

	
});

