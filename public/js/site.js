

// animate scrolling whenever an anchor link is clicked
$(function() {
	
  var scrollTime = 1000; // Speed of animated scroll, lower = faster

  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if(this.hash.slice(1) == "") return;
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, scrollTime);
        return false;
      }
    }
  });
});









// mask inputs with custom patterns
$(document).ready(function(){

  $('.phone-mask').inputmask("(999)999-9999");

  $(".roster-nav li").click(function(){
    $('.roster-nav li').removeClass('active');
    $(this).addClass('active');
    $('.roster').hide();
    $('#'+$(this).attr('x-toggles')).show();
  })


});