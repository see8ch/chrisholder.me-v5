// -- Set Dynamic Heights and CSS -- //
$(document).ready(function(){
    resizeDiv();
});
window.onresize = function(event) {
    resizeDiv();
};
function resizeDiv() {
    vpw = $(window).width();
    vph = $(window).height();

    headerH = $('.site-header').outerHeight();

    // $('body').css({'margin-top': headerH + 60 + 'px'});
}


// Sticky Nav Background
$(function() {
 var sticky_navigation_offset_top = 1;
 var sticky_navigation = function(){
   var scroll_top = $(window).scrollTop();
   if (scroll_top > sticky_navigation_offset_top) {
     $('#masthead').addClass('active');
   } else {
     $('#masthead').removeClass('active');
   }
 };

 sticky_navigation();

 $(window).scroll(function() {
    sticky_navigation();
 });
});