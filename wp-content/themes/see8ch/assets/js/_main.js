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

