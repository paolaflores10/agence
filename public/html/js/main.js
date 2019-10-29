"use strict";

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

jQuery(document).ready(function($) {
	
	// Are we on mobile?
	var onMobile = false;
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) { onMobile = true; }
	
var donutColor1 = '#00A0D1',
	donutColor2 = '#cdeaf5';

/* Controller js */
	if(!onMobile){
	jQuery('body').prepend('<div id="controller"><h6>Color Grid!</h6><ul><li><a href="#" id="ctrl1"></a></li><li><a href="#" id="ctrl2"></a></li><li><a href="#" id="ctrl3"></a></li><li><a href="#" id="ctrl4"></a></li><li><a href="#" id="ctrl5"></a></li><li><a href="#" id="ctrl6"></a></li><li><a href="#" id="ctrl7"></a></li></ul></div>');
	var controllerjs = jQuery('#controller');
	if(jQuery.cookie("controllercolor") == null){jQuery('head').append('<link rel="stylesheet" href="css/colors/default/css/main.css" type="text/css" />');	
		donutColor1 = '#00A0D1';
		donutColor2 = '#cdeaf5';
		};
		
	if(jQuery.cookie("controllercolor") == 'Swissred'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Swissred/css/main.css" type="text/css" />');	
		donutColor1 = '#E74C3C';
		donutColor2 = '#f6c8c4';
		};
	if(jQuery.cookie("controllercolor") == 'Cozygreen'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Cozygreen/css/main.css" type="text/css" />');
		donutColor1 = '#C7D530';
		donutColor2 = '#e8ebcc';
		};
	if(jQuery.cookie("controllercolor") == 'Caramel'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Caramel/css/main.css" type="text/css" />');
		donutColor1 = '#D97925';
		donutColor2 = '#eeeeee';
		};
	if(jQuery.cookie("controllercolor") == 'Candy'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Candy/css/main.css" type="text/css" />');
		donutColor1 = '#EA7A58';
		donutColor2 = '#eeeeee';
		};
	if(jQuery.cookie("controllercolor") == 'Coffeegreen'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Coffeegreen/css/main.css" type="text/css" />');
		donutColor1 = '#A6BF9F';
		donutColor2 = '#E8E6DF';
		};
	if(jQuery.cookie("controllercolor") == 'Softpink'){jQuery('head').append('<link rel="stylesheet" href="css/colors/Softpink/css/main.css" type="text/css" />');
		donutColor1 = '#F17A77';
		donutColor2 = '#E8E6DF';
		};

	controllerjs.find('#ctrl1').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/default/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "default");
	location.reload();
	});
	controllerjs.find('#ctrl2').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Swissred/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Swissred");
	location.reload();
	});
	controllerjs.find('#ctrl3').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Cozygreen/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Cozygreen");
	location.reload();
	});
	controllerjs.find('#ctrl4').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Caramel/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Caramel");
	location.reload();
	});
	controllerjs.find('#ctrl5').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Candy/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Candy");
	location.reload();
	});
	controllerjs.find('#ctrl6').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Coffeegreen/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Coffeegreen");
	location.reload();
	});
	controllerjs.find('#ctrl7').click(function(){
	jQuery('head').append('<link rel="stylesheet" href="css/img/colors/Softpink/css/main.css" type="text/css" />');
	jQuery.cookie("controllercolor", "Softpink");
	location.reload();
	});
	};

	var headerHeight = $('#master-header-wrap').height();
	
	/* Functions that space stuff around, and fire every time the site is resized, as well on first load */
	$(window).on('resize load', function () {
	
		/* Vertical align function */
		$('.alignverticalcenter').each(function(){
			var height = $(this).outerHeight();
			$(this).css({position:'absolute',top:'50%',marginTop: -height/2});
		});
		
		/* Horizontal align function */
		$('.alignhorizontalcenter').each(function(){
			var width = $(this).outerWidth();
			$(this).css({position:'relative',left:'50%',marginLeft: -width/2});
		});
	
	}).resize();
	
	
	/* The menus dropdown rolldown script */
	var menu = $('nav#master-nav');
	menu.find('li:has(ul)').addClass('hassubmenu');
	
	$('#mobile-switch').click(function(){
		menu.slideToggle();
	});
	
	menu.find('li').hoverIntent({
		over: makeTall, 
		timeout: 200,
		sensitivity: 30,
		out: makeShort
	});
	function makeTall(){
	
		if( onMobile == true ){
			$(this).has('ul').addClass('current-menu-item-hover').find('ul:first').slideDown({queue:false,duration:220});
		} else {
			$(this).has('ul').addClass('current-menu-item-hover').find('ul:first').fadeIn({queue:false,duration:220});
		}
		
		var availableSpace = $(window).width() - $(this).offset().left;
		
		if(( onMobile == false ) && ( availableSpace < 520 )){
			$(this).find('ul').find('li').find('ul').css({left: '-262px'});
		}
	}
	function makeShort(){
		if( onMobile == true ){
			$(this).has('ul').removeClass('current-menu-item-hover').find('ul:first').slideUp({queue:false,duration:200});
		} else {
			$(this).has('ul').removeClass('current-menu-item-hover').find('ul:first').fadeOut({queue:false,duration:200});
		}
	}

	
	/* The Donuts around services widgets */
	$(".donut-halo").each(function(){
	
		var doughnutData = [
			{
				value: $(this).data('donut-percent'),
				color: donutColor1
			},
			{
				value : 100 - $(this).data('donut-percent'),
				color : donutColor2
			},

		];
			
		var myDoughnut = new Chart( this.getContext("2d")).Doughnut(doughnutData);
	});
	
	/* Clear input on focus in fields */
	$('input[type=text]').each(function(){
	var inputfieldval = $(this).val();
		$(this).focus(function(){
			if(inputfieldval==$(this).val()){
				$(this).val('');
			}
		});
		$(this).blur(function(){
			if($(this).val()==''){
				$(this).val(inputfieldval);
			}
		});
	});
	
	/* Contact form validation, ajax response */
    var paraTag = jQuery('input#cf-submit').parent('p');
    jQuery(paraTag).children('input').remove();
    jQuery(paraTag).append('<input type="button" name="submit" id="cf-submit" value="Send it" class="btn" />');

    jQuery('#form_main input#cf-submit').click(function() {
        jQuery('#form_main p').append('<img src="css/img/ajax-loader.gif" class="loaderIcon" alt="Loading..." />');

        var name = jQuery('input#name').val();
        var email = jQuery('input#cf-email').val();
        var phone = jQuery('input#phone').val();
        var comments = jQuery('textarea#comments').val();

        jQuery.ajax({
            type: 'post',
            url: 'sendEmail.php',
            data: 'name=' + name + '&email=' + email + '&comments=' + comments,

            success: function(results) {
                jQuery('#form_main img.loaderIcon').fadeOut(5000);
                jQuery('ul#form_response').html(results);
            }
        }); // end ajax
    });
		
	
	/* Isotope init */
	var collage = $('.collage');
	  collage.isotope({
		// options...
	  });
	
	// If the page has filterer
	if ( $('#isotope_filter_wrap') ) {
		// Rerun isotope filter on new sizes
		$('#isotope_filter_wrap a').click(function(){
			$('#isotope_filter_wrap a').removeClass('current');
			$(this).addClass('current');
			var selector = $(this).attr('data-filter');
			collage.isotope({
				filter: selector,
			});
			return false;
		});
	}
	
	
	/* Toggle */
	$('.toggle-handle').each( function() {
		if ( !$(this).hasClass('active') ) {
			$(this).siblings().hide();
		}
		$(this).click( function() {
			if ( $(this).hasClass('active') ) {
				$(this).parent().parent().find('.toggle-handle').removeClass('active');
			} else {
				$(this).parent().parent().find('.toggle-handle').removeClass('active');
				$(this).addClass('active');
			}
			$(this).siblings().slideToggle(250);
			$(this).parent().siblings().find('.toggle').slideUp(250);
		});
	});
	
	/* Close alertbox */
	$('.alertbox a.close').click( function() {
		$(this).parent().fadeOut();
		return false;
	});
	
	/* Faq */
	$('div.faq:not(.open)').hide();
	$('.faq-handle').click(function(){
		$(this).toggleClass("active").next().slideToggle("fast");
	});
	
	/* Tabber */
	jQuery('.ds_tabber_wrap,.ds_vtabber_wrap').each(function(){
	var tabContainers = jQuery(this).find('.ds_tabber');
	var tabSelectors = jQuery(this).find('.tabber li');
    tabContainers.hide();
    jQuery(this).find('ul.tabber li a').click(function(){
        tabContainers.hide().filter(this.hash).fadeIn(500);
        tabSelectors.removeClass('selected');
        jQuery(this).parent().addClass('selected');
        return false;
    });
	jQuery(this).find('ul.tabber li a:first').click();
	});

			
});

jQuery(window).load(function() {

	// Are we on mobile?
	var onMobile = false;
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) { onMobile = true; }
  
	
	/* Flexslider carousel (logos) */
	$('#carousel-logos').flexslider({
		animation: "slide",
		animationLoop: false,
		controlNav: false,
		keyboard: false,
		itemWidth: 228,
		itemMargin: 0,
		minItems: 1,
		maxItems: 5
	});
	
	
	/* Flexslider main slider */
	$('#entertainer .flexslider').flexslider({
		animation: "fade",
		keyboard: true,
		multipleKeyboard: true,
		before: function(slider) {
			slider.slides.eq(slider.currentSlide).find('.flex-caption .vertical-align-middle .move-that').fadeOut().animate({top:'-100px'},{queue:false, easing: 'easeOutQuad', duration: 550});
			slider.slides.eq(slider.animatingTo).find('.flex-caption .vertical-align-middle .move-that').hide().css({top:'100px'});
		},
		after: function(slider) {
			slider.slides.eq(slider.currentSlide).find('.flex-caption .vertical-align-middle .move-that').fadeIn().animate({top:'0'},{queue:false, easing: 'easeOutQuad', duration: 450});
		},
		slideshow: true,
		useCSS: true
	});
	$('#entertainer .flex-control-nav li').attr('data-300','margin:0px 60px; opacity: 0;').attr('data-start','margin:0px 6px; opacity: 1;');
	$('#entertainer .flex-direction-nav a').attr('data-500','top:89%; opacity: 0;').attr('data-start','top:50%; opacity: 1;').attr('data-smooth-scrolling','on'); 
	
	
	/* Parallax madness firing up only on desktop/capable stuff */
	if( ( onMobile === false ) && ( $('#entertainer').length ) ) {
	
		skrollr.init({
			edgeStrategy: 'set',
			smoothScrolling: false,
			forceHeight: false
		});
		
	}
	
	var $container = $('.collage');
	$container.isotope('reLayout')
	
});