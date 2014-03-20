/*global jQuery,google,AnimOnScroll */
(function(){
	
	// USE STRICT
	"use strict";
	
	/////////////////////////////////////////////
	// PAGE FUNCTIONS
	/////////////////////////////////////////////
	
	var page = {
		init: function () {
					
			// BODY CLASSES
			if (isMobile) {
				body.addClass("mobile-browser");
			} else {
				body.addClass("standard-browser");
			}
			if (isAppleDevice) {
				body.addClass("apple-mobile-browser");
			}
			if (body.hasClass("woocommerce-page") && !body.hasClass("woocommerce")) {
				body.addClass("woocommerce");
			}
			// ADD IE CLASS
			if (IEVersion && IEVersion < 10) {
				body.addClass('browser-ie');
			}
			
			// ADD IE10 CLASS
			var pattern = /MSIE\s([\d]+)/,
				ua = navigator.userAgent,
				matched = ua.match(pattern);
			if (matched) {
			body.addClass('browser-ie10');
			}
			
			// BACK TO TOP
			if (jQuery('#back-to-top').length > 0) {
				$window.scroll(function() {
					page.backToTop();
				});
			}
			
			// CAROUSEL GRAB POINTER FUNCTIONALITY
			if (!isMobileAlt) {
				body.on('mousedown', '.caroufredsel_wrapper', function() {
					jQuery(this).addClass('isSwiping');
				});
				body.on('mouseup', '.caroufredsel_wrapper', function() {
					jQuery(this).removeClass('isSwiping');
				});
			}
			
			// FANCY HEADING
			if (jQuery('.fancy-heading').length > 0) {
				page.fancyHeading();
			}
									
			// FITVIDS
			page.fitVids();
			
			// SMOOTH SCROLL
			if (isMobile) {
				page.niceScroll();
			}
			
			if (jQuery('#page-wrap').has('.full-width-display-wrap')) {
				page.fullscreenMedia();
				$window.smartresize( function() {
					page.fullscreenMedia();
				});			
			}
			
			// MOVE MODALS TO BOTTOM OF PAGE
			jQuery(".modal").each(function(){
				jQuery(this).appendTo("body");
			});
			
			// REPLACE COMMENTS REPLY TITLE HTML
			if (body.hasClass('single-post')) {
				var replyTitle = jQuery('#respond').find('h3');
				var originalText = jQuery('#respond').find('h3').html();
				
				replyTitle.addClass('spb-heading');
				replyTitle.html('<span>'+originalText+'</span>');
			}
			
		},
		fitVids: function() {
			jQuery('.portfolio-items:not(.carousel-items),.blog-items:not(.carousel-items),article.type-portfolio,article.type-post,article.type-team,.spb_video_widget,.infocus-item,.recent-posts,.full-width-detail').fitVids();
		},
		niceScroll: function() {
			jQuery("html").niceScroll({	
				scrollspeed: 50,
				zindex: 999,
				mousescrollstep: 30,
				horizrailenabled: false
			});
		},
		fancyHeading: function() {
			if (jQuery('.fancy-heading').hasClass('fancy-image')) {
				$window.stellar();
			}
			setTimeout(function() {
				jQuery('.fancy-heading').slideDown({
					duration: 600, 
					easing: "easeInOutQuart" 
				});		
			}, 200);
			$window.scroll(function() {
				if ($window.width() > 767) {
					var scrollTop = $window.scrollTop();
					var isSafari = deviceAgent.indexOf("safari") !=-1 && deviceAgent.indexOf("chrome") == -1;
					
					if (!(isSafari && scrollTop < 0)) {
						jQuery(".fancy-heading").css("opacity", 1 - scrollTop / 300).css('padding-bottom', 120 - scrollTop / 5 + "px");
						jQuery(".fancy-heading .heading-text").css("opacity", 1 - scrollTop / 180).css("letter-spacing", scrollTop / 35);
					}
				}
			});
		},
		fullscreenMedia: function() {
			var fullscreenMedia = jQuery('.full-width-display-wrap'),
				container = jQuery('#page-wrap'),
				mediaOffset = container.offset().left,
				windowWidth = $window.width();

			if (windowWidth > 768) {
				mediaOffset = mediaOffset;
			} else {
				mediaOffset = 24;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width() + 2;
				
				if (windowWidth > 1026) {
					mediaOffset = 45;
				} else if (windowWidth > 770) {
					mediaOffset = 30;
				} else if (windowWidth > 482) {
					mediaOffset = 24;
				} else {
					mediaOffset = 7;
				}
			}
						
			fullscreenMedia.find('figure').css('width', windowWidth).css('margin-left', '-' + mediaOffset + 'px');
			
			if (!fullscreenMedia.find('figure').is(":visible")) {
				fullscreenMedia.find('figure').slideDown(500);
			} else {
				var slider = fullscreenMedia.find('.item-slider').data('flexslider');
				if (slider) {
				slider.resize();
				}
			}
			
			if (fullscreenMedia.find('.portfolio-options-bar').length > 0) {
				setTimeout(function() {
					fullscreenMedia.find('.portfolio-options-bar').animate({
						opacity: 1,
					}, 200);				
				}, 700);
			}
		},
		backToTop: function() {
			var scrollPosition = $window.scrollTop();
						
			if (scrollPosition > 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '10px',
					'opacity': 1
				}, 300, "easeOutQuart");
			} else if (scrollPosition < 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '-40px',
					'opacity': 0
				}, 300, "easeInQuart");
			}
		},
		getViewportHeight: function() {
			var height = "innerHeight" in window ? window.innerHeight: document.documentElement.offsetHeight; 
			return height;		
		},
		checkIE: function() {
			// ----------------------------------------------------------
			// A short snippet for detecting versions of IE in JavaScript
			// without resorting to user-agent sniffing
			// ----------------------------------------------------------
			// If you're not in IE (or IE version is less than 5) then:
			//     ie === undefined
			// If you're in IE (>=5) then you can determine which version:
			//     ie === 7; // IE7
			// Thus, to detect IE:
			//     if (ie) {}
			// And to detect the version:
			//     ie === 6 // IE6
			//     ie > 7 // IE8, IE9 ...
			//     ie < 9 // Anything less than IE9
			// ----------------------------------------------------------
			
			// UPDATE: Now using Live NodeList idea from @jdalton
			var undef,
				v = 3,
				div = document.createElement('div'),
				all = div.getElementsByTagName('i');
				
			while (
				div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);
			
			return v > 4 ? v : undef;
		}
	};

	
	/////////////////////////////////////////////
	// SUPER SEARCH
	/////////////////////////////////////////////
		
	var superSearch = {
		init: function() {
			
			var deviceAgent = navigator.userAgent.toLowerCase(),
				agentID = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/);
			
			jQuery('.search-go').vCenter();
			
			jQuery('.search-options .ss-dropdown').on('click', function(e) {
				e.preventDefault();
				
				var option = jQuery(this),
					dropdown = option.find( 'ul' );
								
				if (agentID) {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.removeClass('show-dropdown');
					} else {
						dropdown.addClass('show-dropdown');							
					}
				} else {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.css('top', 30);
						dropdown.removeClass('show-dropdown');
					} else {
						dropdown.css('top', -10);
						dropdown.addClass('show-dropdown');							
					}
				}
			});
						
			jQuery('.ss-option').on('click', function(e) {
				e.preventDefault();
				
				var selectedOption = jQuery(this).attr('data-attr_value');
				var parentOption = jQuery(this).parent().parent().parent();
								
				parentOption.find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				
				parentOption.attr('data-attr_value', selectedOption);
				parentOption.find('span').text(jQuery(this).text());
			});
			
			jQuery('.swift-search-link').on('click', function(e) {
				e.preventDefault();
				
				if (jQuery('#header > div').hasClass('is-sticky')) {
					jQuery('body,html').animate({scrollTop: 0}, 400);
					jQuery('body').addClass('header-aux-opening');
					setTimeout(function() {
						header.headerAuxShow('super-search');
					}, 500);
				} else {
					header.headerAuxShow('super-search');
				}
			});

			jQuery('.super-search-go').on('click', function(e) {
				e.preventDefault();
				var parentSearch = jQuery(this).parents('.sf-super-search'),
					filterURL = superSearch.urlBuilder(parentSearch),
					homeURL = jQuery(this).attr('data-home_url'),
					shopURL = jQuery(this).attr('data-shop_url');
				
				if (filterURL.indexOf("product_cat") >= 0) {
				location.href = homeURL + filterURL;
				} else {
				location.href = shopURL + filterURL;
				}
				
			});
			
			jQuery('.super-search-close').on('click', function(e) {
				e.preventDefault();
				header.headerAuxClose();
			});
		
		},
		urlBuilder: function(searchInstance) {
			
			var queryString = "";
			
			jQuery(searchInstance).find('.search-options .ss-dropdown').each(function() {
				
				var attr = jQuery(this).attr('id');
				var attrValue = jQuery(this).attr('data-attr_value');
				if (attrValue !== "") {
					if (attr === "product_cat") {
						queryString += "?product_cat=" + attrValue;
					} else {
						if (queryString === "") {
						queryString += "?filter_" + attr + "=" + attrValue;				
						} else {
						queryString += "&filter_" + attr + "=" + attrValue;									
						}
					}
				}
			});
			
			jQuery('.search-options input').each(function() {
				var attr = jQuery(this).attr('name');
				var attrValue = jQuery(this).attr('value');
				if (queryString === "") {
					queryString += "?"+ attr + "=" + attrValue;				
				} else {
					queryString += "&" + attr + "=" + attrValue;									
				}
			});
			
			return queryString;
		}
	};
	
	
	/////////////////////////////////////////////
	// HEADER
	/////////////////////////////////////////////
		
	var header = {
		init: function() {
			
			var stickyHeaderMobile = !isMobileAlt,
				lastAjaxSearchValue = "",
				searchTimer = false;
			
			if (sfIncluded.hasClass('sticky-header-mobile')) {
				stickyHeaderMobile = true;
			}
			
			if (body.hasClass('header-overlay')) {
				header.headerOverlaySet();
				$window.smartresize( function() {  
					header.headerOverlaySet();
				});
			}
									
			if (body.hasClass('mini-header-enabled') && stickyHeaderMobile) {
				header.stickyHeaderInit();
				$window.scroll(function() { 
					var scrollTop = $window.scrollTop(),
						stickyHeader = jQuery('.sticky-header'),
						headerHeight = jQuery('#header-section').height();
					
					if (jQuery('#top-bar').length > 0) {
						headerHeight = headerHeight + jQuery('#top-bar').height();
					}
					
					if (scrollTop >= headerHeight + 30) {
						stickyHeader.addClass('sticky-header-resized');
					} else if (stickyHeader.hasClass('sticky-header-resized')) {
						stickyHeader.removeClass('sticky-header-resized');
					}
				});	
			}
			
			jQuery('.header-search-link').on('click', function(e) {
				e.preventDefault();
				
				if (jQuery('#header > div').hasClass('is-sticky')) {
					jQuery('body,html').animate({scrollTop: 0}, 400);
					jQuery('body').addClass('header-aux-opening');
					setTimeout(function() {
						header.headerAuxShow('search');
					}, 500);
				} else {
					header.headerAuxShow('search');
				}
			});
			
			jQuery('.header-search-link-alt').on('click', function(e) {
				e.preventDefault();
				
				var ajaxSearchWrap = jQuery('.ajax-search-wrap');
				
				if (ajaxSearchWrap.is(':visible')) {
					ajaxSearchWrap.fadeOut(300);
				} else {
					ajaxSearchWrap.fadeIn(300);
					setTimeout(function() {
						jQuery('.ajax-search-form input[name=s]').focus();
					}, 300);
				}
				
			});
			
			jQuery('.ajax-search-form input[name=s]').on('keyup', function(e) {
				var searchvalue = e.currentTarget.value;

				clearTimeout(searchTimer);								
	            if (lastAjaxSearchValue != jQuery.trim(searchvalue) && searchvalue.length >= 3) {
	                searchTimer = setTimeout( function() {
	                	header.ajaxSearch(e);
	                }, 400);
	            }
			});
			
			
			jQuery('#header-search-close').on('click', function(e) {
				e.preventDefault();
				header.headerAuxClose();
			});
			
			jQuery('#header-search input').on('blur', function() {
				header.headerAuxClose();
			});
			
			$window.scroll(function() { 
				var scrollTop = $window.scrollTop();
				
				if (scrollTop > 100 && jQuery('body').hasClass('header-aux-open') && !jQuery('body').hasClass('header-aux-opening')) {
					header.headerAuxClose();
				}
			});				
		},
		stickyHeaderInit: function() {
			
			var spacing = 0;
			
			if (body.hasClass('admin-bar')) {
				spacing = 28;
			}
			
			jQuery('.sticky-header').sticky({
				topSpacing: spacing
			});
		
		},
		headerOverlaySet: function() {
			var headerWrapHeight = jQuery('.header-wrap').height();
									
			if (jQuery('#main-container').find('#swift-slider').length === 0 && jQuery('#main-container').find('.home-slider-wrap').length === 0 && jQuery('#page-wrap').find('.page-heading').length === 0) {
				jQuery('.inner-page-wrap').animate({
					'padding-top': headerWrapHeight + 30
				}, 300);
			} else if (!(jQuery('#main-container').find('#swift-slider').length > 0 || jQuery('#main-container').find('.home-slider-wrap').length > 0)) {
				if (jQuery('.page-heading').hasClass('fancy-heading')) {
					jQuery('.page-heading').animate({
						'padding-top': headerWrapHeight + 110
					}, 300);
				} else {
					jQuery('.page-heading').animate({
						'padding-top': headerWrapHeight + 35
					}, 300);
				}
			}
			
			if (jQuery('#main-container').find('#swift-slider').length > 0 || jQuery('#main-container').find('.home-slider-wrap').length > 0) {
				if (jQuery('.page-heading').hasClass('fancy-heading')) {
				jQuery('.page-heading').css('padding-top', 120);
				} else {
				jQuery('.page-heading').css('padding-top', 35);
				}
			}
		},
		headerAuxShow: function(type) {
			jQuery('body').addClass('header-aux-open');
			if (type == "search") {
				if (jQuery('body > #super-search:visible')) {
					header.headerSuperSearchFadeOut();
				}
				if (IEVersion && IEVersion < 9) {
					jQuery('#header-search').show();
				} else {
					jQuery('#header-search').animate({
						'opacity': 1
					}, 500).css('z-index', '100');
				}
				jQuery('#header-search input').focus();
			} else if (type == "super-search") {
				if (jQuery('#header-search:visible')) {
					header.headerSearchFadeOut();
				}
				if (IEVersion && IEVersion < 9) {
					setTimeout(function() {
						jQuery('body > #super-search').show();
					}, 400);
				} else {
					setTimeout(function(){
						jQuery('body > #super-search').animate({
							'opacity': 1
						}, 500).css('z-index', '100');
					}, 400);
				}
				jQuery('body').addClass('ss-open');
			}
			setTimeout(function() {
				jQuery('body').removeClass('header-aux-opening');
			}, 500);			
		},
		headerAuxClose: function() {
			jQuery('body').removeClass('header-aux-open');
			jQuery('body').addClass('header-aux-closing');
				header.headerSearchFadeOut();
				header.headerSuperSearchFadeOut();
			setTimeout(function() {
				jQuery('body').removeClass('header-aux-closing');
			}, 700);
		},
		headerSearchFadeOut: function() {
			if (IEVersion && IEVersion < 9) {
				jQuery('#header-search').hide();
			} else {
				jQuery('#header-search').animate({
					'opacity': 0
				}, 500).css('z-index', '');
			}
		},
		headerSuperSearchFadeOut: function() {
			if (IEVersion && IEVersion < 9) {
				jQuery('body > #super-search').hide();
			} else {
				jQuery('body > #super-search').animate({
					'opacity': 0
				}, 500).css('z-index', '');
			}
			jQuery('body').removeClass('ss-open');
		},
		ajaxSearch: function(e) {			
			var searchInput = jQuery(e.currentTarget),
				searchValues = searchInput.parents('form').serialize() + '&action=sf_ajaxsearch',
				results = jQuery('.ajax-search-results'),
				loadingIndicator = jQuery('.ajax-search-wrap .ajax-loading');
						
			jQuery.ajax({
				url: ajaxurl,
				type: "POST",
				data: searchValues,
				beforeSend: function() {
					loadingIndicator.fadeIn(50);
				},
				success: function(response) {
				    if (response == 0) {
				    	response = "";
			        } else {
			        	results.html(response);
					}
				},
				complete: function() {
				    loadingIndicator.fadeOut(200);
				    results.slideDown(400);
				}
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// NAVIGATION
	/////////////////////////////////////////////
	
	var nav = {
		init: function() {
			
			// Set up Mega Menu
			if (!isMobile) {
				nav.megaMenu();
			}
			
			// Add parent class to items with sub-menus
			jQuery("ul.sub-menu").parent().addClass('parent');
			
			// Menu parent click function
			jQuery('.menu li.parent > a').on('click', function(e) {
			
				if (jQuery('#container').width() < 768 || body.hasClass('standard-browser')) {
					return e;
				}
				
				var directDropdown = jQuery(this).parent().find('ul.sub-menu').first();
				if (directDropdown.css('opacity') === 1) {
					return e;
				} else {
					e.preventDefault();
				}
			});
			
			var menuTop = 40;
			var menuTopReset = 80;
			
			// Enable hover dropdowns for window size above tablet width
			jQuery("nav.std-menu").find(".menu li.parent").hoverIntent({
				over: function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						
						// Setup menuLeft variable, with main menu value
						var subMenuWidth = jQuery(this).find('ul.sub-menu').first().outerWidth(true);
						var mainMenuItemWidth = jQuery(this).outerWidth(true);
						var menuLeft = '-' + (Math.round(subMenuWidth / 2) - Math.round(mainMenuItemWidth / 2)) + 'px';
						var menuContainer = jQuery(this).parent().parent();
						
						// Check if this is the top bar menu		
						if (menuContainer.parent().hasClass("top-menu")) {
							if (menuContainer.parent().parent().hasClass("tb-right")) {
							menuLeft = "";
							} else {
							menuLeft = "-1px";
							}
							menuTop = 31;
							menuTopReset = 40;
						} else if (menuContainer.hasClass("header-menu")) {
							menuLeft = "-1px";
							menuTop = 28;
							menuTopReset = 40;
						} else if (menuContainer.hasClass("search-nav")) {
							menuTop = 44;
							menuTopReset = 64;
						} else if (jQuery('#header-section').hasClass('header-1') || jQuery('#header-section').hasClass('header-2')) {
							menuTop = 47;
							menuTopReset = 67;
						} else {
							menuTop = 44;
							menuTopReset = 64;
						}
						
						// Check if second level dropdown
						if (jQuery(this).find('ul.sub-menu').first().parent().parent().hasClass("sub-menu")) {
							menuLeft = jQuery(this).find('ul.sub-menu').first().parent().parent().outerWidth(true) - 2;
						}
						
						jQuery(this).find('ul.sub-menu').first().addClass('show-dropdown').css('top', menuTop);
					}
				},
				out:function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						jQuery(this).find('.sub-menu').first().removeClass('show-dropdown').css('top', menuTopReset);
					}
				}
			});
			
			jQuery(".shopping-bag-item").live("mouseenter", function() {
				
				var subMenuTop = 44;
				
				if (jQuery(this).parent().parent().hasClass("mini-menu")) {
					subMenuTop = 40;
				} else if (jQuery('#header-section').hasClass('header-1') || jQuery('#header-section').hasClass('header-2')) {
					subMenuTop = 47;
				}
				
				jQuery(this).find('ul.sub-menu').first().addClass('show-dropdown').css('top', subMenuTop);
				
			}).live("mouseleave", function() {
				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					jQuery(this).find('ul.sub-menu').first().removeClass('show-dropdown').css('top', 64);
				}
			});
		
			// Toggle Mobile Nav show/hide			
			jQuery('.mobile-menu-show').on('click', function(e) {
				e.preventDefault();
				nav.showMobileMenu();
			});
			
			jQuery('.mobile-menu-close').on('click', function(e) {
				e.preventDefault();
				nav.hideMobileMenu();
			});
		
			$window.smartresize( function() {  
				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					var menus = jQuery('nav').find('ul.menu');
					menus.each(function() {
						jQuery(this).css("display", "");
					});
				}
			});
			
			// Set current language to top bar item
			var currentLanguage = jQuery('li.aux-languages').find('.current-language span').text();
			if (currentLanguage !== "") {
				jQuery('li.aux-languages > a').text(currentLanguage);
			}
			
		},
		megaMenu: function() {
			jQuery('#main-navigation .menu').dcMegaMenu({
				rowItems: '5',
				speed: 200,
				effect: 'fade',
				fullWidth: true
			});
			
			// Set sub-menu position based on menu height
			var mainNav = jQuery('#main-navigation'),
				mainNavHeight = mainNav.height(),
				subMenu = mainNav.find('.sub-container');
			
			subMenu.each(function() {
				jQuery(this).css('top', mainNavHeight);
			});
		},
		showMobileMenu: function() {
			body.addClass('mobile-menu-open');
			setTimeout(function() {
				jQuery('#container').on('click', nav.containerClick);
			}, 500);
		},
		hideMobileMenu: function() {
			body.removeClass('mobile-menu-open');
			jQuery('#container').off('click', nav.containerClick);
		},
		containerClick: function() {
			nav.hideMobileMenu();
		}
	};
	
	
	/////////////////////////////////////////////
	// WOOCOMMERCE FUNCTIONS
	/////////////////////////////////////////////
	
	var woocommerce = {
		init: function() {
			jQuery('figcaption .add_to_cart_button').on('click', function() {
				var button = jQuery(this);
				var added_text = button.attr("data-added_text");
				button.addClass("product-added");
				button.text(added_text);
			});
			
			jQuery('.show-products-link').on('click', function(e) {
				e.preventDefault();
				var linkHref = jQuery(this).attr('href').replace('?', '');
				var currentQuery = document.location.search;
				
				if (currentQuery.indexOf('?show') >= 0) {				
					window.location = jQuery(this).attr('href');
				} else if (currentQuery.indexOf('?') >= 0) {
					window.location = currentQuery + '&' + linkHref;
				} else {
					window.location = document.location + '?' + linkHref;
				}
			});
			
			jQuery('.woocommerce-ordering select').customSelect({customClass:'woo-select'});
			jQuery('#calc_shipping_country').customSelect({customClass:'woo-select'});
			jQuery('#billing_country').customSelect({customClass:'woo-select'});
			jQuery('#shipping_country').customSelect({customClass:'woo-select'});
			
			jQuery('ul.products li').hover(function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: jQuery(this).height()*-1
				}, 400);
			}, function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: 0
				}, 400);
			});
			
			if (jQuery.fn.imagesLoaded) {
				woocommerce.productSetup();
				
				$window.smartresize( function() {  
					woocommerce.productSetup();
				});
			}
			
			jQuery('.shipping-calculator-form input').keypress(function(e) {
				if(e.which == 10 || e.which == 13) {
					jQuery(".update-totals-button button").click();
				}
			}); 
		},
		productSetup: function() {
			jQuery('ul.products').imagesLoaded(function() {
				jQuery('ul.products li').each(function() {
					var productImageHeight = jQuery(this).find('.product-image > img').height();
					if (jQuery('#container').width() <= 1024) {
						productImageHeight = productImageHeight + 20;
					}
					jQuery(this).find('figure').css('padding-bottom', productImageHeight  + 'px');
				});
			});
			
		},
		productCarousel: function() {
			
			var products = jQuery('.product-carousel');
			
			products.addClass('carousel-wrap');
			
			var carousel = products.find('ul.products');
			
			carousel.each(function() {
				var carouselPrev = jQuery(this).parent().parent().find('.prev');
				var carouselNext = jQuery(this).parent().parent().find('.next');
				var carouselColumns = parseInt(jQuery(this).parent().parent().attr("data-columns"), 10);
				
				if (isMobile) {
					carouselColumns = 1;
				}
	
				carousel.imagesLoaded(function () {
					carousel.carouFredSel({
						items				: carouselColumns,
						scroll : {
							visible			: {
												width: carousel.find("> li:first").width(),
												min: 1,
												max: carouselColumns
											},
							easing			: "easeInOutCubic",
							duration		: 800,							
							pauseOnHover	: true
						},
						swipe	: {
							onTouch : true,
							onMouse : true
						},
						auto : {
							play			: false
						},
						prev : {	
							button			: carouselPrev,
							key				: "left"
						},
						next : { 
							button			: carouselNext,
							key				: "right"
						},
						onCreate : function() {
							woocommerce.resizeCarousel();
							$window.smartresize( function() {
								woocommerce.resizeCarousel();
							});
						}	
					}).animate({
						'opacity': 1
					},800);
				});
			});
		},
		resizeCarousel: function() {
			var carousel = jQuery('.product-carousel').find('.products');
			
			carousel.each(function() {
				var carouselItem = jQuery(this).find('li');
				var itemWidth = carouselItem.width() + carouselItem.css('margin-left');
				var visible = parseInt(carousel.parent().parent().attr("data-columns"), 10);
				
				if (jQuery('#container').width() < 460 && body.hasClass('responsive-fluid')) {
					visible = 1;
				} else if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
					visible = 2;
				}
				
				carousel.trigger("configuration", {
					items : {
						width : itemWidth
					},
					scroll : {
						items: visible
					},
					swipe : {
						items: visible
					}
				});
				
			});
		},
		variations: function() {
			jQuery('.variations select').each( function() {
				var variationSelect = jQuery(this);
				variationSelect.live("change", function(){
					if (jQuery('#sf-included').hasClass('has-productzoom')) {
						jQuery('.zoomContainer').remove();
						setTimeout(function() {
							jQuery('.product-slider-image').each(function() {
								jQuery(this).data('zoom-image', jQuery(this).parent().find('a.zoom').attr('href'));
							});
							jQuery('#product-img-slider li:first').find('.product-slider-image').elevateZoom({
								zoomType: "inner",
								cursor: "crosshair",
								responsive: true,
								zoomWindowFadeIn: 500,
								zoomWindowFadeOut: 750
							});
						}, 500);
					}
				});
			});
		}
	};
	
	/////////////////////////////////////////////
	// FLEXSLIDER FUNCTION
	/////////////////////////////////////////////
	
	var flexSlider = {
		init: function() {
			
			var hasProductZoom = false;
			
			if (jQuery('#sf-included').hasClass('has-productzoom') && !body.hasClass('mobile-browser')) {
				hasProductZoom = true;
			}
			
			if(jQuery('.recent-posts').length > 0) {
				flexSlider.thumb();
			}
			
			if (jQuery('#product-img-nav ul.slides li').length > 1) {
				jQuery('#product-img-nav').flexslider({
					animation: "slide",
					directionNav: false,
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 70,
					itemMargin: 30,
					asNavFor: '#product-img-slider'
				});
			} else {
				jQuery('#product-img-nav').css('display', 'none');
			}

			jQuery('#product-img-slider').flexslider({
				animation: "slide",
				controlNav: false,
				smoothHeight: true,
				animationLoop: false,
				slideshow: false,
				sync: "#product-img-nav",
				start: function(productSlider) {
					if (hasProductZoom) {
						if (productSlider.slides) {
							productSlider.slides.eq(productSlider.currentSlide).find('.product-slider-image').elevateZoom({
                zoomType: "inner",
								cursor: "crosshair",
								responsive: true,
								zoomWindowFadeIn: 500,
								zoomWindowFadeOut: 750
							});
						} else {
							jQuery('#product-img-slider').find('.product-slider-image').elevateZoom({
                zoomType: "inner",
								cursor: "crosshair",
								responsive: true,
								zoomWindowFadeIn: 500,
								zoomWindowFadeOut: 750
							});
						}
					}
				},
				before: function() {
					if (hasProductZoom) {
						jQuery('.zoomContainer').remove();
					}
				},
				after: function(productSlider) {
					if (hasProductZoom) {
						productSlider.slides.eq(productSlider.currentSlide).find('.product-slider-image').elevateZoom({
              zoomType: "inner",
							cursor: "crosshair",
							responsive: true,
							zoomWindowFadeIn: 500,
							zoomWindowFadeOut: 750
						});
					}
				}
			});
					
			jQuery('.item-slider').flexslider({
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,	//Boolean: Animate slider automatically
				slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 500,			//Integer: Set the speed of animations, in milliseconds
				smoothHeight: true,         
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: true,               //Boolean: Create pause/play dynamic element
				pauseText: '',             //String: Set the text for the "pause" pausePlay item
				playText: '',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
				manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
				start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
				before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
				after: function(){},      //Callback: function(slider) - Fires after each slider animation completes
				end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
			});
			jQuery('#swift-slider').flexslider({
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: false,	//Boolean: Animate slider automatically
				slideshowSpeed: 8000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: false,               //Boolean: Create pause/play dynamic element
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: true,
				start: function(postsSlider) {
					jQuery('.swift-slider-loading').fadeOut(200);
					if (postsSlider.slides) {
						postsSlider.slides.eq(postsSlider.currentSlide).addClass('flex-active-slide'); 
						if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								var countValue = parseInt(jQuery(this).attr('data-count'), 10);
								jQuery(this).data('easyPieChart').update(80);
								jQuery(this).find('span').replaceWith("<span>0</span>");
								jQuery(this).find('span').animateNumber(countValue);
							});
						}
						postsSlider.slides.eq(postsSlider.currentSlide).find('.comment-chart:not(.fw-chart) span').replaceWith("<span>0</span>");
					}
				},
				before: function(postsSlider) {
					if (postsSlider.slides) {
						if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								jQuery(this).data('easyPieChart').update(0);
								jQuery(this).find('span').replaceWith("<span>0</span>");
							});
						}
						setTimeout( function() {
							postsSlider.slides.eq(postsSlider.currentSlide).addClass('flex-active-slide');
							if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
								var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
								if (body.hasClass("browser-ie")) {
								chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
								}
								chart.each( function() {
									var countValue = parseInt(jQuery(this).attr('data-count'), 10);
									jQuery(this).data('easyPieChart').update(80);
									jQuery(this).find('span').animateNumber(countValue);
								});
							}
						}, 1000);
					}
				}
			});
			jQuery('.content-slider').each(function() {
				var slider = jQuery(this),
					autoplay = ((slider.attr('data-autoplay') === "yes") ? true : false);
				
				slider.flexslider({
					animation: "fade",              //String: Select your animation type, "fade" or "slide"
					slideshow: autoplay,	//Boolean: Animate slider automatically
					slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 1000,			//Integer: Set the speed of animations, in milliseconds
					smoothHeight: true,         
					directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					start: function() {}
				});
			});
						
			// LOAD THE LOVE-IT CHARTS
			jQuery('#swift-slider li').each( function() {
				jQuery(this).find('.chart').each( function() {
					jQuery(this).easyPieChart({
						animate: 1000,
						size: 70,
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: 'transparent',
						scaleColor: 'transparent'
					});
					jQuery(this).find('span').replaceWith("<span>0</span>");
				});
			});
			
			// CAPTION HOVER ADD/REMOVE CLASSES
			jQuery('#swift-slider li').hover(function() {
				jQuery(this).find('.flex-caption-details').removeClass('closing');
				jQuery(this).find('.flex-caption-details').addClass('open');
			}, function() {
				jQuery(this).find('.flex-caption-details').addClass('closing');
				jQuery(this).find('.flex-caption-details').removeClass('open');
			});
						
			// CAPTION TRANSITION LISTENERS
			jQuery('.caption-details-inner').on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function() {
				var chart = jQuery(this).find('.chart');
				if (jQuery(this).parent().hasClass('closing')) {
					chart.each( function() {
						jQuery(this).data('easyPieChart').update(0);
						jQuery(this).find('span').replaceWith("<span>0</span>");
					});
					jQuery(this).parent().removeClass('closing');
				} else if (jQuery(this).parent().hasClass('open')) {
					chart.each( function() {
						var countValue = parseInt(jQuery(this).attr('data-count'), 10);
						jQuery(this).data('easyPieChart').update(80);
						jQuery(this).find('span').animateNumber(countValue);
					});
				}
			});
		},
		thumb: function() {
			jQuery('.thumb-slider').flexslider({
				animation: "fade",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: false,	//Boolean: Animate slider automatically
				slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each slide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				smoothHeight: true
			});
		},
		gallery: function() {
			
			jQuery('.spb_gallery_widget').each(function() {
				
				var gallerySlider = jQuery(this).find('.gallery-slider');

				gallerySlider.flexslider({
					animation: gallerySlider.data('transition'),
					controlNav: false,
					animationLoop: false,
					slideshow: false
				});
				
			});
			
		}
	};
	
	/////////////////////////////////////////////
	// PORTFOLIO
	/////////////////////////////////////////////
	
	var portfolioContainer = jQuery('.portfolio-wrap').find('.filterable-items');
	
	var portfolio = {
		init: function() {
			
			if (portfolioContainer.hasClass('masonry-items')) {
				portfolio.masonrySetup();
			} else {
				portfolio.standardSetup();
			}
						
			// PORTFOLIO WINDOW RESIZE
			$window.smartresize( function() {  
				portfolio.windowResized();
			});
			
			// Enable filter options on when there are items from that skill
			jQuery('.filtering li').each( function() {
				var itemCount = 0;
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					portfolioItems = jQuery(this).parent().parent().parent().find('.filterable-items');
				
				portfolioItems.find('.portfolio-item').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				
				if (jQuery(this).hasClass('all')) {
					itemCount = portfolioItems.children('li').length;
					jQuery(this).find('.item-count').text(itemCount);
				} else {
					jQuery(this).find('.item-count').text(itemCount);
				}
			}).parents('.portfolio-filter-tabs').animate({
				opacity: 1
			}, 400);
	
			// filter items when filter link is clicked
			jQuery('.filtering li').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).data('filter');
				var portfolioItems = jQuery(this).parent().parent().parent().parent().find('.filterable-items');
				portfolioItems.isotope({ filter: selector });	
			});  
			
			jQuery('.filter-wrap > a').on('click', function(e) {
				e.preventDefault();
				jQuery(this).parent().find('.filter-slide-wrap').slideToggle();
			});
		},
		standardSetup: function() {
			// SET ITEM HEIGHTS
			portfolioContainer.imagesLoaded(function () {
				portfolio.setItemHeight();
				flexSlider.thumb();
				portfolioContainer.animate({opacity: 1}, 800);
				portfolioContainer.isotope({
					animationEngine: 'best-available',
					animationOptions: {
						duration: 300,
						easing: 'easeInOutQuad',
						queue: false
					},
					resizable: true,
					layoutMode: 'fitRows'
				});
				portfolioContainer.isotope("reLayout");
			});
		},
		masonrySetup: function() {
			portfolioContainer.fitVids();
			portfolioContainer.imagesLoaded(function () {
				flexSlider.thumb();
				portfolioContainer.animate({opacity: 1}, 800);
				portfolioContainer.isotope({
					itemSelector : '.portfolio-item',
					animationEngine: 'best-available',
					animationOptions: {
						duration: 300,
						easing: 'easeInOutQuad',
						queue: false
					},
					resizable: true
				});
				
			});
		},
		setItemHeight: function() {
			if (!portfolioContainer.hasClass('masonry-items')) {
				portfolioContainer.children().css('min-height','0');
				portfolioContainer.equalHeights();
			}
		},
		windowResized: function() {
			if (!portfolioContainer.hasClass('masonry-items')) {
				portfolio.setItemHeight();
			}
			portfolioContainer.isotope("reLayout");
		},
		portfolioShowcaseInit: function() {
			flexSlider.thumb();
			portfolio.portfolioShowcaseWrap();
			portfolio.portfolioShowcaseItems();
			$window.smartresize( function() {
				portfolio.portfolioShowcaseWrap();
				portfolio.portfolioShowcaseItems();
			});
		},
		portfolioShowcaseWrap: function() {
			var portfolioShowcaseWrap = jQuery('.portfolio-showcase-wrap'),
				container = jQuery('#page-wrap'),
				mediaOffset = container.offset().left,
				windowWidth = $window.width() + 2;
		
			if (windowWidth > 768) {
				mediaOffset = mediaOffset - 15;
			} else {
				mediaOffset = 7;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width() + 2;
				
				if (windowWidth > 1026) {
					mediaOffset = 30;
				} else if (windowWidth > 770) {
					mediaOffset = 17;
				} else if (windowWidth > 482) {
					mediaOffset = 11;
				} else {
					mediaOffset = 7;
				}
			}
									
			portfolioShowcaseWrap.css('width', windowWidth);
			portfolioShowcaseWrap.css('margin-left', '-' + mediaOffset + 'px');
			portfolioShowcaseWrap.animate({opacity: 1}, 600);
		},
		portfolioShowcaseItems: function() {
			jQuery('.portfolio-showcase-wrap').each(function() {
				
				var contWidth = $window.width();
				
				if (jQuery('#container').hasClass('boxed-layout')) {
					contWidth = jQuery('#container').width();
				}
				
				var thisShowcase = jQuery(this),
					columns = thisShowcase.find('.portfolio-showcase-items').data('columns'),
					windowWidth = contWidth + 2,
					itemWidth = Math.floor(windowWidth / columns),
					maximisedWidth = Math.floor(windowWidth * 40 / 100),
					reducedWidth = Math.floor(windowWidth / 5),
					deselectedLeft = (itemWidth / 2 - maximisedWidth / 2) / 0.75,
					resetLeft = (reducedWidth / 2 - maximisedWidth / 2) / 1.3,
					isAnimating = !1,
					speed = 300;

				var showcaseItem = thisShowcase.find('li.portfolio-item');
				
				if (columns === 5) {
					maximisedWidth = Math.floor(windowWidth * 25 / 100);
					reducedWidth = Math.floor(windowWidth / 5.33);
					deselectedLeft = (itemWidth / 2 - maximisedWidth / 2) / 0.75;
					resetLeft = (reducedWidth / 2 - maximisedWidth / 2) / 1.3;
					showcaseItem.css("width", itemWidth);
					showcaseItem.css("height", maximisedWidth / 1.5);
					showcaseItem.find('.main-image').css("width", maximisedWidth);
					showcaseItem.find('.main-image').css("left", resetLeft);
					showcaseItem.find('.main-image').css("top", - maximisedWidth / 6);
					speed = 200;
				} else {
					showcaseItem.css("width", itemWidth);
					showcaseItem.css("height", maximisedWidth / 2);
					showcaseItem.find('.main-image').css("width", maximisedWidth);
					showcaseItem.find('.main-image').css("left", resetLeft);
				}
							
				showcaseItem.each(function () {
					if (windowWidth > 768) {
						jQuery(this).mouseenter(function () {
							if (!isAnimating) {
								isAnimating = !0;
								jQuery(this).removeClass("deselected-item");
								thisShowcase.find(".deselected-item").stop().animate({
									width: reducedWidth
								}, speed);
								thisShowcase.find(".deselected-item").find(".main-image").stop().animate({
									left: deselectedLeft
								}, speed);
								jQuery(this).find(".main-image").stop().animate({
									left: 0
								}, speed);
								jQuery(this).stop().animate({
									width: maximisedWidth
								}, speed + 1, function () {
									jQuery(this).find(".item-info").stop().show();
									jQuery(this).find(".item-info").stop().animate({
										bottom: 0
									}, speed, "easeInOutQuart");
								});
							}
						});
						jQuery(this).mouseleave(function () {
							if (isAnimating) {
								isAnimating = !1;
								jQuery(this).addClass("deselected-item");
								thisShowcase.find(".portfolio-item").stop().animate({
									width: itemWidth
								}, speed);
								thisShowcase.find(".portfolio-item .main-image").stop().animate({
									left: resetLeft
								}, speed);
								jQuery(this).find(".item-info").stop().animate({
									bottom: -80
								}, speed, function () {
									jQuery(this).find(".item-info").stop().hide();
								});
							}
						});
					}
				});
			});			
		}
	};
	
	
	/////////////////////////////////////////////
	// BLOG
	/////////////////////////////////////////////
	
	var blogItems = jQuery('.blog-wrap').find('.blog-items');
	
	var blog = {
		init: function() {
		
			// BLOG ITEM SETUP
			if (blogItems.hasClass('masonry-items')) {
				blog.masonryBlog();
			} else {
				flexSlider.thumb();
			}
			
			
			// BLOG AUX SLIDEOUT
			jQuery('.blog-slideout-trigger').on('click', function(e) {
				e.preventDefault();
				
				// VARIABLES
				var blogWrap = jQuery(this).parent().parent().parent().parent();
				var filterPanel = blogWrap.find('.filter-wrap .filter-slide-wrap');
				var auxType = jQuery(this).attr('data-aux');
								
				// ADD COLUMN SIZE AND REMOVE BRACKETS FROM COUNT
				blogWrap.find('.aux-list li').addClass('col-sm-2');
				blogWrap.find('.aux-list li a span').each(function() {
					jQuery(this).html(jQuery(this).html().replace("(","").replace(")",""));
				});
				
				// IF SELECTING AN OPTION THAT IS OPEN, CLOSE THE PANEL
				if (jQuery(this).parent().hasClass('selected') && !filterPanel.is(':animated')) {
					blogWrap.find('.blog-aux-options li').removeClass('selected');
					filterPanel.slideUp(400);
					return;
				}
				
				// AUX BUTTON SELECTED STATE
				blogWrap.find('.blog-aux-options li').removeClass('selected');	
				jQuery(this).parent().addClass('selected');
				
				// IF SLIDEOUT IS OPEN
				if (filterPanel.is(':visible')) {
					
					filterPanel.slideUp(400);
					setTimeout(function() {
						blogWrap.find('.aux-list').css('display', 'none');
						blogWrap.find('.aux-'+auxType).css('display', 'block');
						filterPanel.slideDown();
					}, 600);
					
				// IF SLIDEOUT IS CLOSED
				} else {
					
					blogWrap.find('.aux-list').css('display', 'none');
					blogWrap.find('.aux-'+auxType).css('display', 'block');
					filterPanel.slideDown();
					
				}
			});
			
		},
		masonryBlog: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var scrollAnimateElement = new AnimOnScroll( document.getElementById( 'blogGrid' ), {
					minDuration : 0.4,
					maxDuration : 0.7,
					viewportFactor : 0.2
				});
			}
			blogItems.imagesLoaded(function () {
				flexSlider.thumb();
			});
			blogItems.fitVids();
		},
		infiniteScroll: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var infScrollData = jQuery('#inf-scroll-params');
				var infiniteScroll = {
					loading: {
						img: infScrollData.data('loadingimage'),
						msgText: infScrollData.data('msgtext'),
						finishedMsg: infScrollData.data('finishedmsg')
					},
					"nextSelector":".pagenavi li.next a",
					"navSelector":".pagenavi",
					"itemSelector":".blog-item",
					"contentSelector":".blog-items"
				};
				jQuery( infiniteScroll.contentSelector ).infinitescroll(
					infiniteScroll, function() {
						blogItems.imagesLoaded(function () {
							if (blogItems.hasClass('masonry-items')) {
								flexSlider.thumb();
								blog.masonryBlog();
							} else {
								flexSlider.thumb();
								blogItems.fitVids();
							}
						});
					}
				);
			} else {
				jQuery('.pagination-wrap').removeClass('hidden');
			}
		}
	};
	
	
	/////////////////////////////////////////////
	// CAROUSEL FUNCTIONS
	/////////////////////////////////////////////
	
	var carouselWidgets = {
		init: function() {
	
			// CAROUSELS
			var carousel = jQuery('.carousel-items');
			
			carousel.each(function() {
				var carouselInstance = jQuery('#'+jQuery(this).attr('id')),
					carouselPrev = carouselInstance.parent().parent().find('.prev'),
					carouselNext = carouselInstance.parent().parent().find('.next'),
					carouselColumns = parseInt(carouselInstance.attr("data-columns"), 10),
					carouselAuto = carouselInstance.data('auto');
				
				if (isMobile) {
					carouselColumns = 1;
				}
				
				carouselInstance.imagesLoaded(function () {
					carouselInstance.carouFredSel({
						items				: carouselColumns,
						scroll : {
							visible			: {
												width: carousel.find("> li:first").width(),
												min: 1,
												max: carouselColumns
											},
							easing			: "easeOutQuart",
							duration		: 1000,							
							pauseOnHover	: true
						},
						swipe	: {
							onTouch : true,
							onMouse : true
						},
						auto : {
							play			: carouselAuto
						},
						prev : {	
							button			: carouselPrev,
							key				: "left"
						},
						next : { 
							button			: carouselNext,
							key				: "right"
						},
						onCreate : function() {
							jQuery(this).fitVids();
							flexSlider.thumb();
							carouselWidgets.resizeCarousels();
							$window.smartresize( function() {
								carouselWidgets.resizeCarousels();	
							});
							
							if (isMobileAlt) {
								carouselWidgets.carouselSwipeIndicator(jQuery(this));
							}
						}	
					}).animate({
						'opacity': 1
					},800);
				});
			});			
		},
		resizeCarousels: function() {
			var carousel = jQuery('.carousel-items');
			
			carousel.each(function() {
				var carouselItem = jQuery(this).find('.carousel-item');
				var itemWidth = carouselItem.width() + carouselItem.css('margin-left');
				var visible = parseInt(carousel.data("columns"), 10);
								
				if (jQuery('#container').width() < 460 && body.hasClass('responsive-fluid')) {
					visible = 1;
				} else if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
					visible = 2;
				}
				
				if (carousel.hasClass('testimonials')) {
					visible = 1;
				}
						
				carousel.trigger("configuration", {
					items : {
						width : itemWidth
					},
					scroll : {
						items: visible
					},
					swipe : {
						items: visible
					}
				});

			});
		},
		carouselSwipeIndicator: function(carousel) {
			carousel.appear(function() {
				var swipeIndicator = jQuery(this).parents('.carousel-overflow').find('.sf-swipe-indicator');
				setTimeout(function() {
					swipeIndicator.fadeIn(500);
				}, 400);
				setTimeout(function() {
					swipeIndicator.addClass('animate');
				}, 1000);
				setTimeout(function() {
					swipeIndicator.fadeOut(400);	
				}, 3000);
			});
		}
	};

	
	/////////////////////////////////////////////
	// WIDGET FUNCTIONS
	/////////////////////////////////////////////
	
	var widgets = {
		init: function() {
			
			// CHARTS
			if (sfIncluded.hasClass('has-chart')) {
				jQuery('.chart-shortcode').each(function(){
					jQuery(this).easyPieChart({
						animate: 1000,
						lineCap: 'round',
						lineWidth: jQuery(this).attr('data-linewidth'),
						size: jQuery(this).attr('data-size'),
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: jQuery(this).attr('data-trackcolor'),
						scaleColor: 'transparent'
					});
				});
			}
			
			// LOAD WIDGETS
			widgets.accordion();
			widgets.tabs();
			widgets.toggle();
			widgets.fullWidthVideo();
			widgets.introAnimations();
			widgets.iconBoxes();
			widgets.countAssets();
			
			if (sfIncluded.hasClass('has-countdown')) {
			widgets.countdownAssets();
			}
			
			if (sfIncluded.hasClass('has-imagebanner')) {
			widgets.imageBanners();
			}
			
			// RESIZE ASSETS
			widgets.resizeAssets();
			$window.smartresize( function() {  
				widgets.resizeAssets();
			});
			
			// SF TOOLTIPS
			jQuery('[rel=tooltip]').tooltip();
			
		},
		resizeAssets: function() {	
			var carousels = jQuery('.carousel-items,.product-carousel .products');
			var assets = jQuery('.alt-bg');
			var assetWidth = 0;
			
			carousels.each(function() {
				
				var thisCarousel = jQuery(this);
				
				if (jQuery('#container').width() < 460 && body.hasClass('responsive-fluid')) {
					assetWidth = jQuery('#container').width() - 40;			
					thisCarousel.find('.carousel-item,.product').each(function() {
						jQuery(this).css("width", assetWidth + "px");
						
					});
				} else if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
					if (thisCarousel.hasClass('testimonials')) {
					assetWidth = jQuery('#container').width() - 40;	
					} else {
					assetWidth = Math.floor(jQuery('#container').width() / 2) - 35;	
					}
					thisCarousel.find('.carousel-item,.product').each(function() {
						jQuery(this).css("width", assetWidth + "px");
					});
				} else if (body.hasClass('responsive-fluid')) {
					thisCarousel.find('.carousel-item,.product').each(function() {
						jQuery(this).css("width", "");
					});
				}
				
				if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
					assetWidth = jQuery('#container').width();
					assets.each(function() {
						jQuery(this).css("width", assetWidth + "px");
					});	
				} else {
					assets.each(function() {
						jQuery(this).css("width", "");
					});	
				}
			});
		},
		accordion: function() {
			jQuery('.spb_accordion').each(function() {
				var spb_tabs,				
					active_tab = false,
					active_attr = parseInt(jQuery(this).attr('data-active'), 10);
							
				if (jQuery.type( active_attr ) === "number") { active_tab = active_attr; }
							
				spb_tabs = jQuery(this).find('.spb_accordion_wrapper').accordion({
					header: "> div > h3",
					autoHeight: true,
					collapsible: true,
					active: active_tab,
					heightStyle: "content"
				});
			}).fadeIn(400);
		},
		tabs: function() {
			// SET ACTIVE TABS PANE
			jQuery('.spb_tabs').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
			});
			
			// SET ACTIVE TOUR PANE
			jQuery('.spb_tour').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
			});
		},
		toggle: function() {
			jQuery('.spb_toggle').click(function() {
				if ( jQuery(this).hasClass('spb_toggle_title_active') ) {
					jQuery(this).removeClass('spb_toggle_title_active').next().slideUp(500);
				} else {
					jQuery(this).addClass('spb_toggle_title_active').next().slideDown(500);
				}
			});
			jQuery('.spb_toggle_content').each(function() {
				if ( jQuery(this).next().is('h4.spb_toggle') === false ) {
					jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
				}
			});
		},
		initSkillBars: function() {		
			// SKILL BARS
			widgets.animateSkillBars();			
			$window.scroll(function() { 
				widgets.animateSkillBars();
			});
		},
		animateSkillBars: function() {
			jQuery('.progress').each(function(){
				var progress = jQuery(this);
				
				progress.appear(function() {
					var progressBar = jQuery(this),
					progressValue = progressBar.find('.bar').attr('data-value');
					
					if (!progressBar.hasClass('animated')) {
						progressBar.addClass('animated');
						progressBar.find('.bar').animate({
							width: progressValue + "%"
						}, 800, function() {
							progressBar.parent().find('.bar-text .progress-value').fadeIn(600);
						});
					}
				});
			});
		},
		charts: function() {
			widgets.animateCharts();
			$window.scroll(function() { 
				widgets.animateCharts();
			});	
		},
		animateCharts: function() {
			jQuery('.chart-shortcode').each(function(){
				var chart = jQuery(this);
				chart.appear(function() {
					if (!jQuery(this).hasClass('animated')) {
						jQuery(this).addClass('animated');
						var animatePercentage = parseInt(jQuery(this).attr('data-animatepercent'), 10);
						jQuery(this).data('easyPieChart').update(animatePercentage);
					}
				});
			});
		},
		fullWidthVideo: function() {			
			jQuery('.fw-video-link').unbind().on({
				'click':function(){
					if (jQuery(this).data('video') !== "") {
					widgets.openFullWidthVideo(jQuery(this));
					}
					return false;
				}
			});
			
			jQuery('.fw-video-close').unbind().on({
				'click':function(){
					widgets.closeFullWidthVideo();
				}
			});
		},
		openFullWidthVideo: function(element) {
			jQuery('.fw-video-close').addClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: windowheight
			}, 1000, 'easeInOutExpo');
			
			jQuery('.fw-video-area').animate({
				top: 0,
				height: '100%'
			}, 1000, 'easeInOutExpo', function() {
				// load video here
				jQuery('.fw-video-area').append('<iframe class="fw-video" src="'+element.data('video')+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>');
			});
		},
		closeFullWidthVideo: function() {
			jQuery('.fw-video-close').removeClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: 0
			}, 1000, 'easeInOutExpo', function(){
			});
			jQuery('.fw-video-area').animate({
				top:'-100%'
			}, 1000, 'easeInOutExpo', function(){
				jQuery('.fw-video-area .fw-video').remove();
			});
			
			// pause videos
			jQuery('.fw-video-area video').each(function(){
				this.pause();
			});
			setTimeout(function() {
				jQuery('.fw-video-area').find('iframe').remove();
			}, 1500);
			
			return false;
		},
		introAnimations: function() {
			
			if (!isMobileAlt) {
				jQuery('.sf-animation').each(function() {
	
					var animatedItem = jQuery(this),
						itemAnimation = animatedItem.data('animation'),
						itemDelay = animatedItem.data('delay');
										
					animatedItem.appear(function() {				
						if (itemAnimation == 'fade-from-left') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'left' : '0px'
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'fade-from-right') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'right' : '0px'
							}, 600, 'easeOutCubic');
						} else if(itemAnimation == 'fade-from-bottom') {
							if (animatedItem.hasClass('image-banner-content')) {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '50%'
								}, 1000, 'easeOutCubic');
							} else {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '0px'
								}, 600, 'easeOutCubic');
							}
						} else if (itemAnimation == 'fade-in') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'grow') {
							setTimeout(function(){ 
								animatedItem.addClass('sf-animate');
							}, itemDelay);
						} else {
							setTimeout(function() {
								animatedItem.addClass('sf-animate');						
							}, itemDelay);
						}
					}, {accX: 0, accY: -150}, 'easeInCubic');
				
				});
			}
		},
		iconBoxes: function() {
			jQuery('.sf-icon-box').hover(
				function() {
					jQuery(this).addClass('sf-hover');
				}, function() {
					jQuery(this).removeClass('sf-hover');
				}
			);
		},
		countAssets: function() {
			jQuery('.sf-count-asset').each(function() {

				var countAsset = jQuery(this),
					countNumber = countAsset.find('.count-number'),
					countDivider = countAsset.find('.count-divider').find('span'),
					countSubject = countAsset.find('.count-subject');
				
				if (!isMobileAlt) {						
					countAsset.appear(function() {				
					
						countNumber.countTo({
							onComplete: function () {
								countDivider.animate({
									'width': 50
								}, 400, 'easeOutCubic');
								countSubject.delay(100).animate({
									'opacity' : 1,
									'bottom' : '0px'
								}, 600, 'easeOutCubic');
							}
						});
						
					}, {accX: 0, accY: -150}, 'easeInCubic');
				} else {
					countNumber.countTo({
						onComplete: function () {
							countDivider.animate({
								'width': 50
							}, 400, 'easeOutCubic');
							countSubject.delay(100).animate({
								'opacity' : 1,
								'bottom' : '0px'
							}, 600, 'easeOutCubic');
						}
					});
				}
			
			});
		},
		countdownAssets: function() {
			jQuery('.sf-countdown').each(function() {
				var countdownInstance = jQuery(this),
					year = parseInt(countdownInstance.data('year'), 10),
					month = parseInt(countdownInstance.data('month'), 10),
					day = parseInt(countdownInstance.data('day'), 10),
					countdownDate = new Date(year, month - 1, day);
				
				var labelStrings = jQuery('#countdown-locale'),
					pluralLabels = [labelStrings.data('label_years'),labelStrings.data('label_months'),labelStrings.data('label_weeks'),labelStrings.data('label_days'),labelStrings.data('label_hours'),labelStrings.data('label_mins'),labelStrings.data('label_secs')],
					singularLabels = [labelStrings.data('label_year'),labelStrings.data('label_month'),labelStrings.data('label_week'),labelStrings.data('label_day'),labelStrings.data('label_hour'),labelStrings.data('label_min'),labelStrings.data('label_sec')];
				
				countdownInstance.countdown({
					until: countdownDate,
					since: null,
					format: 'dHMS',
					labels: pluralLabels,
					labels1: singularLabels,
					onExpiry: function() {
						setTimeout(function() {
							countdownInstance.fadeOut(500);						
						}, 1000);
					}
				});
			});
		},
		imageBanners: function() {
			jQuery('.sf-image-banner').each(function() {
				jQuery(this).find('.image-banner-content').vCenter();
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// TEAM MEMBERS FUNCTION
	/////////////////////////////////////////////
	
	var teamMembers = {
		init: function() {
			// TEAM EQUAL HEIGHTS
			var team = jQuery('.team-members.carousel-items');
			team.imagesLoaded(function () {
				team.equalHeights();
			});
			
			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.team-members.carousel-items').children().css('min-height','0');
				jQuery('.team-members.carousel-items').equalHeights();
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// PARALLAX FUNCTION
	/////////////////////////////////////////////
	
	var parallax = {
		init: function() {
			
			jQuery('.spb_parallax_asset').each(function() {
				
				var parallaxAsset = jQuery(this);
				
				if (parallaxAsset.hasClass('sf-parallax-video')) {
				
					if (!isMobileAlt) {
														
							var parallaxVideo = parallaxAsset.find('video'),
								parallaxContent = parallaxAsset.find('.spb_content_wrapper'),
								parallaxVideoTop = 0;
							
							parallaxVideo.css('top', - parallaxVideoTop);
							parallaxVideo.attr('data-top-default', parallaxVideoTop); 
							
							if (parallaxAsset.hasClass('parallax-video-height')) {
								parallaxAsset.animate({
									'height': parallaxVideo.height() / 2
								}, 400);
								setTimeout(function(){
									parallaxAsset.find('.video-overlay').animate({
										'opacity': 0.8
									}, 200);
								}, 100);
								parallaxContent.vCenterTop();
								setTimeout(function() {
									parallaxContent.animate({
										'opacity': 1,
										'top': '50%'
									}, 600, 'easeOutExpo');
								}, 600);
								parallaxAsset.attr('data-height-default', parallaxVideo.height() / 2); 
								$window.smartresize( function() {
									parallaxAsset.animate({
										height : parallaxVideo.height() / 2
									}, 400);
									parallaxVideo.css('top', - parallaxVideo.height() / 4);
									parallaxVideo.attr('data-top-default', parallaxVideo.height() / 4); 
									parallaxAsset.attr('data-height-default', parallaxVideo.height() / 2); 
								});
							}
						
							$window.scroll(function() {
								if ($window.width() > 1024) {
									parallax.videoScroll(parallaxAsset);
								}
							});
					} else {
						parallaxAsset.find('video').remove();
					}
					
				} else if (parallaxAsset.hasClass('parallax-window-height')) {
					jQuery(this).height($window.height() - (parseInt(jQuery(this).css('padding-top'), 10) * 2));
					jQuery(this).find('.spb_content_wrapper').vCenterTop();
					$window.scroll(function() {
						if ($window.width() > 1024) {
							parallax.windowImageScroll(parallaxAsset);
						}
					});
				}
			});
		},
		videoScroll: function(asset) {
			
			var offsetTop = asset.offset().top,
				windowTop = $window.scrollTop(),
				defaultHeight = parseInt(asset.data('height-default'), 10),
				diff = windowTop - offsetTop,
				currentTop = asset.find('.spb_content_wrapper').css('top'),
				heightDifference = defaultHeight - diff * 1.5;
				
			if (windowTop > offsetTop) {	
				asset.css('height', heightDifference); 
				asset.find('.spb_content_wrapper').css('opacity', 1 - (diff / 300));
				if (asset.hasClass('parallax-video-height')) {
				asset.find('.spb_content_wrapper').css('top', currentTop + (diff / 4));
				} else {
				asset.find('.spb_content_wrapper').css('top', (diff / 3));
				}
			} else {	
				asset.css('height', defaultHeight);
				asset.find('.spb_content_wrapper').css('opacity', 1);
				if (asset.hasClass('parallax-video-height')) {
				asset.find('.spb_content_wrapper').css('top', '50%');
				} else {
				asset.find('.spb_content_wrapper').css('top', 0);				
				}
			}
				
		},
		windowImageScroll: function(asset) {
			asset.height($window.height() - jQuery(this).css('padding-top') / 2);
			asset.find('.spb_content_wrapper').vCenterTop();
		}
	};
	
	
	
	/////////////////////////////////////////////
	// MAP FUNCTIONS
	/////////////////////////////////////////////
	
	var map = {
		init:function() {
			
			var maps = jQuery('.map-canvas');
			maps.each(function(index, element) {
				var mapContainer = element,
					mapAddress = mapContainer.getAttribute('data-address'),
					mapZoom = mapContainer.getAttribute('data-zoom'),
					mapType = mapContainer.getAttribute('data-maptype'),
					mapColor = mapContainer.getAttribute('data-mapcolor'),
					mapSaturation = mapContainer.getAttribute('data-mapsaturation'),
					pinLogoURL = mapContainer.getAttribute('data-pinimage');
				
				map.getCoordinates(mapAddress, mapContainer, mapZoom, mapType, mapColor, mapSaturation, pinLogoURL);
								
			});
			
			map.fullscreenMap();
			$window.smartresize( function() {
				map.fullscreenMap();
			});
			
		},
		getCoordinates: function(address, mapContainer, mapZoom, mapType, mapColor, mapSaturation, pinLogoURL) {
			var geocoder;
			geocoder = new google.maps.Geocoder();			
			geocoder.geocode({
				'address': address
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					
					if (mapSaturation == "mono") {
						mapSaturation = -100;
					} else {
						mapSaturation = -20;
					}
					
					var styles = [
						{
							stylers: [
								{hue: mapColor},
								{saturation: mapSaturation}
							]
						}
					];
					
					var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});  
					
					var mapTypeIdentifier = "",
						companyPos = "",
						isDraggable = true,
						mapCoordinates = results[0].geometry.location,
						latitude = results[0].geometry.location.lat(),
						longitude = results[0].geometry.location.lng();				
					
					if (isMobileAlt) {
					isDraggable = false;
					}
					
					if (mapType === "satellite") {
					mapTypeIdentifier = google.maps.MapTypeId.SATELLITE;
					} else if (mapType === "terrain") {
					mapTypeIdentifier = google.maps.MapTypeId.TERRAIN;
					} else if (mapType === "hybrid") {
					mapTypeIdentifier = google.maps.MapTypeId.HYBRID;
					} else {
					mapTypeIdentifier = google.maps.MapTypeId.ROADMAP;
					}
							
					var latlng = new google.maps.LatLng(latitude, longitude);
					var settings = {
						zoom: parseInt(mapZoom, 10),
						scrollwheel: false,
						center: latlng,
						draggable: isDraggable,
						mapTypeControl: true,
						mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
						navigationControl: true,
						navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
						mapTypeId: mapTypeIdentifier
					};
					var mapInstance = new google.maps.Map(mapContainer, settings);
					var companyMarker = "";
					
					// ADD MARKER AFTER 1 SECOND
					jQuery(mapContainer).appear(function() {
						setTimeout(function() {
							if (pinLogoURL) {
								var companyLogo = new google.maps.MarkerImage(pinLogoURL,
									new google.maps.Size(150,75),
									new google.maps.Point(0,0),
									new google.maps.Point(75,75)
								);
								companyPos = new google.maps.LatLng(latitude, longitude);
								companyMarker = new google.maps.Marker({
									position: mapCoordinates,
									map: mapInstance,
									icon: companyLogo,
									animation: google.maps.Animation.DROP
								});
							} else { 
								companyPos = new google.maps.LatLng(latitude, longitude);
								companyMarker = new google.maps.Marker({
									position: mapCoordinates,
									map: mapInstance,
									animation: google.maps.Animation.DROP
								});
							}
							
							google.maps.event.addListener(companyMarker, 'click', function() {
								window.location.href = 'http://maps.google.com/maps?q='+companyPos;
							});
							
							google.maps.event.addDomListener(window, 'resize', function() {
								mapInstance.setCenter(companyPos);
							});
						}, 1000);
					});
								
					// MAP COLOURIZE
					if (mapColor !== "") {
					mapInstance.mapTypes.set('map_style', styledMap);
					mapInstance.setMapTypeId('map_style');
					}

				} else {
					console.log(status);
				}
			});			
		},
		fullscreenMap: function() {
			var fullscreenMap = jQuery('.fullscreen-map'),
				container = jQuery('#page-wrap'),
				mapOffset = container.offset().left,
				windowWidth = $window.width();

			if (windowWidth > 768) {
				mapOffset = mapOffset;
			} else {
				mapOffset = 20;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width();
				
				if (windowWidth > 1024) {
					mapOffset = 45;
				} else if (windowWidth > 768) {
					mapOffset = 30;
				} else if (windowWidth > 480) {
					mapOffset = 24;
				} else {
					mapOffset = 20;
				}
			}
						
			fullscreenMap.find('.map-canvas').css('width', windowWidth);
			fullscreenMap.css('margin-left', '-' + mapOffset + 'px');
			
		}
	};
		
	
	/////////////////////////////////////////////
	// RELOAD FUNCTIONS
	/////////////////////////////////////////////
	
	var reloadFunctions = {
		init:function() {	
	
			// Remove title attributes from images to avoid showing on hover 
			jQuery('img[title]').each(function() {
				jQuery(this).removeAttr('title');
			});
			
			if (!isAppleDevice) {
				jQuery('embed').show();
			}
						
			// Animate Top Links
			jQuery('.animate-top').on('click', function(e) {
				e.preventDefault();
				jQuery('body,html').animate({scrollTop: 0}, 800, 'easeOutCubic');           
			});
		},
		load:function() {
			if (!isMobile) {
			
				// Button hover tooltips
				jQuery('.tooltip').each( function() {
					jQuery(this).css( 'marginLeft', '-' + Math.round( (jQuery(this).outerWidth(true) / 2) ) + 'px' );
				});
				
				jQuery('.comment-avatar').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '44px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '25px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
				
				jQuery('.grid-image').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '85px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '65px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
			
			}	
		}
	};
	
	
	/////////////////////////////////////////////
	// GLOBAL VARIABLES
	/////////////////////////////////////////////
	
	var $window = jQuery(window),
		body = jQuery('body'),
		sfIncluded = jQuery('#sf-included'),
		windowheight = page.getViewportHeight(),
		deviceAgent = navigator.userAgent.toLowerCase(),
		isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
		isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
		isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
		IEVersion = page.checkIE();
		
	/////////////////////////////////////////////
	// LOAD + READY FUNCTION
	/////////////////////////////////////////////
		
	var onReady = {
		init: function(){
			page.init();
			if (jQuery('.sf-super-search').length > 0) {
			superSearch.init();
			}
			header.init();
			nav.init();
			if (sfIncluded.hasClass('has-products') || body.hasClass('woocommerce-cart') || body.hasClass('woocommerce-account')) {
			woocommerce.init();
			}
			if (sfIncluded.hasClass('has-portfolio')) {
			portfolio.init();
			}
			if (sfIncluded.hasClass('has-portfolio-showcase')) {
			portfolio.portfolioShowcaseInit();
			}
			if (sfIncluded.hasClass('has-blog')) {
			blog.init();
			}
			if (sfIncluded.hasClass('has-infscroll') && !isMobile) {
			blog.infiniteScroll();
			}
			widgets.init();
			if (sfIncluded.hasClass('has-team')) {
			teamMembers.init();
			}
			if (sfIncluded.hasClass('has-carousel')) {
			carouselWidgets.init();
			woocommerce.productCarousel();
			}
			if (sfIncluded.hasClass('has-parallax')) {
			parallax.init();
			}
			reloadFunctions.init();
		}
	};
	var onLoad = {
		init: function(){
			flexSlider.init();
			if (sfIncluded.hasClass('has-gallery')) {
			flexSlider.gallery();
			}
			if (sfIncluded.hasClass('has-chart')) {
			widgets.charts();
			}
			if (sfIncluded.hasClass('has-progress-bar')) {
			widgets.initSkillBars();
			}
			if (sfIncluded.hasClass('has-map')) {
			map.init();
			}
			reloadFunctions.load();
			woocommerce.variations();
		}
	};
	
	jQuery(document).ready(onReady.init);
	jQuery(window).load(onLoad.init);
	
})(jQuery);