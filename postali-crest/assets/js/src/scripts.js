/**
 * Theme scripting
 *
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
    "use strict";
    
    // window width
    var winWidth = $(window).width();

    // mobile menu breakpoint
    if (winWidth <= 1024) {
        // set all needed classes when we start
        $('.sub-menu').addClass('closed');

        //Hamburger animation
        $('.toggle-nav').click(function() {
            $(this).toggleClass('active');
            $('.menu').toggleClass('opened');
            $('.menu').toggleClass('active'); 
            $('.sub-menu').removeClass('opened');
            $('.sub-menu').addClass('closed');
            return false;
        });

        //Close navigation on anchor tap
        $('.active').click(function() {	
            $('.menu').addClass('closed');
            $('.menu').toggleClass('opened');
            $('.menu .sub-menu').removeClass('opened');
            $('.menu .sub-menu').addClass('closed');
        });	

        //Mobile menu accordion toggle for sub pages
        $('.menu > li.menu-item-has-children').prepend('<div class="accordion-toggle"><span class="icon-chevron-right"></span></div>');
        $('.menu > li.menu-item-has-children > .sub-menu').prepend('<div class="child-close"><span class="icon-chevron-left"></span> back</div>');

        //Mobile menu accordion toggle for third-level pages
        $('.menu > li.menu-item-has-children > .sub-menu > li.menu-item-has-children').prepend('<div class="accordion-toggle2"><span class="icon-chevron-right"></span></div>');
        $('.menu > li.menu-item-has-children > .sub-menu > li.menu-item-has-children > .sub-menu').prepend('<div class="child-close2"><span class="icon-chevron-left"></span> back</div>');

        $('.menu .accordion-toggle').click(function(event) {
            event.preventDefault();
            var currentMenuPosition = $(this).parent().position().top;
            $(this).siblings('.sub-menu').addClass('opened').css('top', '-' + currentMenuPosition + 'px');
            $(this).siblings('.sub-menu').removeClass('closed');
        });

        $('.menu .accordion-toggle2').click(function(event) {
            event.preventDefault();
            var currentMenuPosition = $(this).parent().position().top;
            $(this).siblings('.sub-menu').addClass('opened').css('top', '-' + currentMenuPosition + 'px');
            $(this).siblings('.sub-menu').removeClass('closed');
            
        });

        $('.child-close').click(function() {
            $(this).parent().toggleClass('opened');
            $(this).parent().toggleClass('closed');
        });

        $('.child-close2').click(function() {
            $(this).parent().toggleClass('opened');
            $(this).parent().toggleClass('closed');
        });

    }

    // adjust header position on scroll
    $('document').ready(function () {
        var marketingBannerHeight = $('.marketing-banner').outerHeight();
        var currentScrollPosition = $(window).scrollTop();

        $('document').on('scroll', function () {
            currentScrollPosition = $(window).scrollTop();
            if (currentScrollPosition > marketingBannerHeight) {
                $('header').addClass('scrolled');
            } else {
                $('header').removeClass('scrolled');
            }
        })
    })

    // desktop child click close parent subnav
    $('.menu > li.menu-item-has-children > .sub-menu > li > a').click(function(event) {
        $(this).closest('.sub-menu').css('display', 'none');
    });

    //add button before child links on landing page
    $("<div class='all-pages'>View All Pages <span></span></div>").insertBefore('.children');
    $('.all-pages').click(function() {
        $(this).toggleClass("active");
        $(this).parent().find('.children').toggleClass("active");
        $(this).parent().find('.children').slideToggle(400);
	});

    // script to make accordions function
	$(".accordions").on("click", ".accordions_title", function() {
        // will (slide) toggle the related panel.
        $(this).toggleClass("active").next().slideToggle();
        $(this).parent().toggleClass("active");
    });

	// Toggle search function in nav
	$( document ).ready( function() {
		var width = $(document).outerWidth();
		if (width > 992) {
			var open = false;
			$('#search-button').attr('type', 'button');
			
			$('#search-button').on('click', function(e) {
					if ( !open ) {
						$('#search-input-container').removeClass('hdn');
						$('#search-button span').removeClass('icon-search-icon').addClass('icon-close-x');
						$('.menu li.menu-item').addClass('disable');
						open = true;
						return;
					}
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-search-icon');
						$('.menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
			}); 
			$('html').on('click', function(e) {
				var target = e.target;
				if( $(target).closest('.navbar-form-search').length ) {
					return;
				} else {
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-search-icon');
						$('.menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
				}
			});
		}
	});

    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
           $('header').addClass('scrolled');
        } else {
           $('header').removeClass('scrolled');
        }
    });

    $(document).ready(function () {
        $('.view-all-awards').on('click', function () {
            console.log('clicked');
            $('.hidden-awards').slideToggle(400).css('display', 'grid');
        })
    })


    $(document).ready(function () { 
        if ($('.enable-accordion').length > 0) { 
            var count = 0;

            $('.enable-accordion.wp-block-group > .wp-block-group__inner-container').each(function () {
                var $container = $(this);
                count++;
                // prevent duplicates
                if ($container.children('.accordion-body').length) {
                    return;
                }

                var $firstP = $container.children('p').first().next();
                if (!$firstP.length) {
                    return;
                }

                // wrap from the first <p> through the last sibling element (regardless of type)
                var $toWrap = $firstP.nextAll().addBack();
                $toWrap.wrapAll('<div id="section-' + count + '" role="region" aria-labelledby="accordion-toggle-' + count + '" class="accordion-body"></div>');

                // add toggle after this specific accordion body
                $container.children('.accordion-body').last()
                    .after('<button aria-controls="section-' + count + '" aria-expanded="false" id="accordion-toggle-' + count + '" class="accordion-toggle btn orange-btn"><span>Read More</span></button>');
            });

            if ($('.accordion-toggle').length > 0) { 

                $('.accordion-toggle').on('click', function () {
                    var $this = $(this);
                    var wasActive = $this.hasClass('active');
                    var $accordionBody = $this.prev('.accordion-body');
                    
                    if ($accordionBody.is(':visible')) {
                        $accordionBody.slideUp(400, function () {
                            $this.removeClass('active');
                            $this.find('span').first().text('Read More');

                            // If it was active (now closing), scroll to parent container
                            if (wasActive) {
                                var $container = $this.closest('.wp-block-group__inner-container');
                                if ($container.length) {
                                    var headerOffset = $('header').outerHeight() || 0;
                                    var targetTop = Math.max(0, $container.offset().top - headerOffset - 16);
                                    $('html, body').animate({ scrollTop: targetTop }, 300);
                                }
                            }
                        });
                    } else {
                        $accordionBody.slideDown(400);
                        $this.addClass('active');
                        $this.attr('aria-expanded', 'true');
                        $this.find('span').first().text('Read Less');
                    }
                });
            }

            $('.on-page-navigation ul li a').on('click', function (e) {

                var hash = this.hash;
                if (!hash) return;

                var $target = $(hash);
                if (!$target.length) return;

                var $enable = $target.closest('.enable-accordion');
                if ($enable.length) {
                    e.preventDefault();

                    // Find the accordion body containing the target (or the first one in this container)
                    var $accordionBody = $target.closest('.accordion-body');
                    if (!$accordionBody.length) {
                        $accordionBody = $enable.find('.accordion-body').first();
                    }
                    var $toggle = $accordionBody.next('.accordion-toggle');

                    // Open if hidden
                    if ($accordionBody.length && $accordionBody.is(':hidden')) {
                        $accordionBody.slideDown(0);
                        if ($toggle.length) {
                            $toggle.addClass('active').attr('aria-expanded', 'true');
                            $toggle.find('span').first().text('Read Less');
                        }
                    }

                    // Smooth scroll to target accounting for header
                    var headerOffset = $('header').outerHeight() || 0;
                    var targetTop = Math.max(0, $target.offset().top - headerOffset - 26);
                    $('html, body').animate({ scrollTop: targetTop }, 300);
                }
            });

        }
    })

});