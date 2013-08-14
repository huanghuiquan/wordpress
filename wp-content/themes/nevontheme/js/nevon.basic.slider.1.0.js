// JavaScript Document
(function ($) {

    $.fn.NevonBasic = function (customOptions) {     
        var settings = {
			autoSlide : false,
			duration : 6000,
            easing: 'swing',
			slideWidth : 460,
			direction : "ud",
			objectNum : 3 
        };
		$.extend(settings, customOptions);
		
	//Check if there are contents for slider
	if(this.find('.slide').length < 1){ /*console.log("There is no content in the iceMag Basic Slider");*/ return;}
	
  var main = this;
  var currentPosition = 0;
  var slideWidth = (settings.slideWidth);
  var slides = this.find('.slide');
  var numberOfSlides = slides.length;
  var onTimer = true;
  var slideTime = settings.duration;
  var basicElements = [];
  
  this.find('.slide').each(
  	function(){
		if(!jQuery(this).is(":first-child")) jQuery(this).css({'marginLeft':slideWidth, opacity:0, position:"absolute", display:"block"});
		else jQuery(this).css({opacity:1, position:"absolute", display:"block"});
		basicElements.push(jQuery(this));	
	}
  );

  // Remove scrollbar in JS
  this.css('overflow', 'hidden');
  
  // Wrap all .slides with #slideInner div
  slides.wrapAll('<div class="slideInner"></div>').css({
    'float' : 'left',
    'width' : slideWidth
  });

  // Set #slideInner width equal to total width of all slides
  jQuery('.slideInner').css({'width': slideWidth * numberOfSlides, 'overflow': 'hidden'});
  //resizeHandlerFunc();

  // Create event listeners for .controls clicks
  this.find('.control')
    .bind('click', function(){
		
			  pauseSlide();
	  setTimeout(activateSlide,800);
	  
	  switch(settings.direction){
		case "ud":
		  basicElements[currentPosition].stop().animate({
			'opacity'    : 0,
			'zIndex'	 : 0
		  },800);
		  break;
		  
		  case "rl":
		  basicElements[currentPosition].stop().animate({
			  'marginLeft' 	 : -slideWidth,
			'opacity'    : 0,
			'zIndex'	 : 0
		  },800);
		  break;
	  }
      currentPosition = (jQuery(this).attr('class').search('rightControl') > -1)
    ? currentPosition+1 : currentPosition-1;
		
			if(currentPosition >= numberOfSlides && jQuery(this).attr('class').search('rightControl') > -1 ){// && 
				currentPosition = 0;
			}else if(currentPosition < 0 && jQuery(this).attr('class').search('leftControl') > -1){
				currentPosition = numberOfSlides - 1;
			}
			
	  switch(settings.direction){
		case "ud":
		  basicElements[currentPosition].css({"marginLeft":0, "marginTop":-80, "opacity":0}).stop().animate({
			'marginLeft' : 0,
			'marginTop'  : 0,
			'opacity'    : 1,
			'zIndex'	 : 9
		  },800);
		  break;
		  
		  case "rl":
		  basicElements[currentPosition].css({"marginLeft":slideWidth, "marginTop":0, "opacity":0}).stop().animate({
			'marginLeft' : 0,
			'marginTop'  : 0,
			'opacity'    : 1,
			'zIndex'	 : 9
		  },800);
			break;
	  }
    });

  // manageControls: Hides and shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
    if(position==0){ jQuery('.leftControl').hide() }
    else{ jQuery('.leftControl').show() }
    // Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ jQuery('.rightControl').hide() }
    else{ jQuery('.rightControl').show() }
    }
	
	
	var tid = null;
	if(settings.autoSlide)tid = setInterval(icemagBasicSlider, slideTime);
	
	var basicSliderLeft;
	function icemagBasicSlider() {
		if(!onTimer) return;
		
				pauseSlide();
			  setTimeout(activateSlide,800);

	  switch(settings.direction){
		case "ud":
		  basicElements[currentPosition].stop().animate({
			'opacity'    : 0,
			'zIndex'	 : 0
		  },800);
		  break;
		  
		  case "rl":
		  basicElements[currentPosition].stop().animate({
			  'marginLeft' 	 : -slideWidth,
			'opacity'    : 0,
			'zIndex'	 : 0
		  },800);
		  break;
	  }
	  
	  currentPosition++;
	  		
			//alert(currentPosition);
			if(currentPosition >= numberOfSlides){
				currentPosition = 0;
			}else if(currentPosition < 0 && jQuery(this).attr('class').search('leftControl') > -1){
				currentPosition = numberOfSlides - 1;
			}

	
	  switch(settings.direction){
		case "ud":
		  basicElements[currentPosition].css({"marginLeft":0, "marginTop":-80, "opacity":0}).stop().animate({
			'marginLeft' : 0,
			'marginTop'  : 0,
			'opacity'    : 1,
			'zIndex'	 : 9
		  },800);
		  break;
		  
		  case "rl":
		  basicElements[currentPosition].css({"marginLeft":slideWidth, "marginTop":0, "opacity":0}).stop().animate({
			'marginLeft' : 0,
			'marginTop'  : 0,
			'opacity'    : 1,
			'zIndex'	 : 9
		  },800);
			break;
	  }
	}
		
	function activateSlide(){
		onTimer = true;	
		if(!tid && settings.autoSlide){
			tid = setInterval(icemagBasicSlider, slideTime);
		}
	}
	
	function pauseSlide(){
		if(tid){
	  clearInterval(tid);
	  tid = null;
		onTimer = false;	
		}
	}
	
	
		
	this.hover(
		function(){
			pauseSlide();	
		},
		function(){
			activateSlide();	
		}
	
	);

	
		jQuery(window).resize(resizeiceMagSliders);
		
		
		function resizeiceMagSliders(){
			if(jQuery.browser.msie && jQuery.browser.version < 9) return;
			
			var imgHeight = main.find(".icemag-basic-slider-container .slide").height();
			main.find(".icemag-basic-slider-container").css("height",imgHeight +40);
			
			var imgHeight = main.find(".icemag-basic-slider-container-fullwidth .slide").height();
			main.find(".icemag-basic-slider-container-fullwidth").css("height",imgHeight +40);
			
			if(jQuery('.icemag-basic-slider-copy-fullwidth').length>0){
				if(jQuery(window).width() < 960 && slideWidth > 480 && jQuery('.icemag-basic-slider-copy-fullwidth').find('.references-fullwidth-margin').length < 1){
					//console.log("FIRST");
					jQuery('.icemag-basic-slider-copy-fullwidth').find('.six-column').addClass('references-fullwidth-margin');
					
					if(jQuery(window).width() < 640 && jQuery(window).width() > 440){
						main.find(".icemag-basic-slider-copy-fullwidth .icemag-basic-slider-container-fullwidth").css("height",(imgHeight +40)/2);
					}
					
				}else if(slideWidth > 480 && jQuery(window).width() >= 960 && jQuery('.icemag-basic-slider-copy-fullwidth').find('.references-fullwidth-margin').length > 0){
					//console.log("NOT");
					jQuery('.icemag-basic-slider-copy-fullwidth').find('.six-column').removeClass('references-fullwidth-margin');
				}
			}
		}
		
		resizeiceMagSliders();
	}
})(jQuery);