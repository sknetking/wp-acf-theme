$ = jQuery;
$(document).ready(function () {

    // Header js 
    $('.site-header .menu-icon').click(function () {
        $('.site-header .main-navigation').addClass('active');
        $("html").addClass("overflow-hidden");
        $(".draw-back").show();
    });
    $('.site-header .menu-close').click(function () {
        $('.site-header .main-navigation').removeClass('active');
        $("html").removeClass("overflow-hidden");
        $(".draw-back").hide();
    });

    $(".site-header ul > li.menu-item-has-children").each(function(i)   {
        if ($(this).has("ul").length){
            $(this).find('> a').after('<span class="caret-arrow"></span>');
            $(this).find('> .sub-menu').css('display', 'none');
        }
    });
    $('.caret-arrow').click(function () {
        var catSubUl = $(this).next('.sub-menu');
        if (catSubUl.is(':hidden')){
            catSubUl.parent().siblings("li.menu-item-has-children").children(".sub-menu").slideUp();
            catSubUl.parent().siblings("li.menu-item-has-children").children(".arrow").removeClass('active');
            catSubUl.slideDown();
            $(this).addClass('active');
        }
        else{
            catSubUl.slideUp();
            $(this).removeClass('active');
        }
    });
});
// sticky header js start
// Hide header on scroll down
var $window       = $(window);
  var lastScrollTop = 0;
  var $header       = $('.site-header');
  var headerHeight  = $header.outerHeight();

  $window.scroll(function() {
    var windowTop  = $window.scrollTop();
    if ( windowTop >= headerHeight ) {
      $header.addClass( 'nav-up' );
    } else {
      $header.removeClass( 'nav-up' );
    }
  
} );
// sticky header js end
