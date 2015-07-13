/*
 Theme Name: see8ch
 Theme URI: http://see8ch.com
 Author: Chris Holder <chris@codemotel.com>
 Description: Personal Portfolio Theme
 Version: 1.0.0
 Copyright Copyright 2015 — Chris Holder
 Text Domain: see8ch
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
} )();

( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! /^[A-z0-9_-]+$/.test( id ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

// -- Set Dynamic Heights and CSS -- //
function resizeDiv() {
  vpw = $(window).width();
  vph = $(window).height();

  headerH = $('.site-header').outerHeight();
  // $('body').css({'margin-top': headerH + 60 + 'px'});
}

$(document).ready(function(){
  resizeDiv();
});

window.onresize = function() {
  resizeDiv();
};


// Sticky Nav Background
$(function() {
  var stickyNavigationOffsetTop = 1;
  var stickyNavigation = function(){
    var scrollTop = $(window).scrollTop();
    if (scrollTop > stickyNavigationOffsetTop) {
      $('#masthead').addClass('active');
    } else {
      $('#masthead').removeClass('active');
    }
  };

  stickyNavigation();

  $(window).scroll(function() {
    stickyNavigation();
  });
});

