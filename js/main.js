;(function () {
	
	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var mobileMenuOutsideClick = function() {

		jQuery(document).click(function (e) {
	    var container = jQuery("#colorlib-offcanvas, .js-colorlib-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {

	    	if ( jQuery('body').hasClass('offcanvas') ) {

                jQuery('body').removeClass('offcanvas');
                jQuery('.js-colorlib-nav-toggle').removeClass('active');
				
	    	}
	    
	    	
	    }
		});

	};


	var offcanvasMenu = function() {

		jQuery('#page').prepend('<div id="colorlib-offcanvas" />');
		jQuery('#page').prepend('<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle colorlib-nav-white"><i></i></a>');
		var clone1 = jQuery('.menu-1 > ul').clone();
		jQuery('#colorlib-offcanvas').append(clone1);
		var clone2 = jQuery('.menu-2 > ul').clone();
		jQuery('#colorlib-offcanvas').append(clone2);

		jQuery('#colorlib-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
		jQuery('#colorlib-offcanvas')
			.find('li')
			.removeClass('has-dropdown');

		// Hover dropdown menu on mobile
		jQuery('.offcanvas-has-dropdown').mouseenter(function(){
			var $this = jQuery(this);

			$this
				.addClass('active')
				.find('ul')
				.slideDown(500, 'easeOutExpo');				
		}).mouseleave(function(){

			var $this = jQuery(this);
			$this
				.removeClass('active')
				.find('ul')
				.slideUp(500, 'easeOutExpo');				
		});


		jQuery(window).resize(function(){

			if ( jQuery('body').hasClass('offcanvas') ) {

    			jQuery('body').removeClass('offcanvas');
    			jQuery('.js-colorlib-nav-toggle').removeClass('active');
				
	    	}
		});
	};

	var burgerMenu = function() {

		jQuery('body').on('click', '.js-colorlib-nav-toggle', function(event){
			var $this = jQuery(this);


			if ( jQuery('body').hasClass('overflow offcanvas') ) {
				jQuery('body').removeClass('overflow offcanvas');
			} else {
				jQuery('body').addClass('overflow offcanvas');
			}
			$this.toggleClass('active');
			event.preventDefault();

		});
	};
	

	var contentWayPoint = function() {
		var i = 0;
		jQuery('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !jQuery(this.element).hasClass('animated-fast') ) {
				
				i++;

				jQuery(this.element).addClass('item-animate');
				setTimeout(function(){

					jQuery('body .animate-box.item-animate').each(function(k){
						var el = jQuery(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};


	var dropdown = function() {

		jQuery('.has-dropdown').mouseenter(function(){

			var $this = jQuery(this);
			$this
				.find('.dropdown')
				.css('display', 'block')
				.addClass('animated-fast fadeInUpMenu');

		}).mouseleave(function(){
			var $this = jQuery(this);

			$this
				.find('.dropdown')
				.css('display', 'none')
				.removeClass('animated-fast fadeInUpMenu');
		});

	};


	var goToTop = function() {

		jQuery('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			jQuery('html, body').animate({
				scrollTop: jQuery('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		jQuery(window).scroll(function(){

			var $win = jQuery(window);
			if ($win.scrollTop() > 200) {
				jQuery('.js-top').addClass('active');
			} else {
				jQuery('.js-top').removeClass('active');
			}

		});
	
	};


	// Loading page
	var loaderPage = function() {
		jQuery(".colorlib-loader").fadeOut("slow");
	};


	var sliderMain = function() {
		
	  	jQuery('#colorlib-hero .flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					jQuery('.slider-text').removeClass('animated fadeInUp');
					jQuery('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					jQuery('.slider-text').removeClass('animated fadeInUp');
					jQuery('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

	  	});

	};

	// Owl Carousel
	var owlCrouselFeatureSlide = function() {
		jQuery('.owl-carousel, .blog-slider .gallery').owlCarousel({
			animateOut: 'fadeOut',
		   animateIn: 'fadeIn',
		   autoplay: true,
		   loop:true,
		   margin:0,
		   nav:true,
		   dots: false,
		   autoHeight: true,
		   items: 1,
		   navText: [
		      "<i class='icon-arrow-left3 owl-direction'></i>",
		      "<i class='icon-arrow-right3 owl-direction'></i>"
	     	]
		})
	};

    /*-------------------------------------
    Instagram Photos
    -------------------------------------*/
    jQuery('.instagram-entry').each(function(){
        jQuery.instagramFeed({
            'username': jQuery(this).data('username'),
            'container': jQuery(this),
            'display_profile': false,
            'display_biography': false,
            'items': jQuery(this).data('items'),
            'margin': 0,
        });
    });


	
	jQuery(function(){
		mobileMenuOutsideClick();
		offcanvasMenu();
		burgerMenu();
		contentWayPoint();
		sliderMain();
		dropdown();
		goToTop();
		loaderPage();
		owlCrouselFeatureSlide();
	});


}());