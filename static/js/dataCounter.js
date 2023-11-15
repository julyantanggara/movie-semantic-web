$(document).ready(function() {
    var animationStarted = false;
    var scrollOffset = 2000;
  
    $(window).on('scroll', function() {
      if (!animationStarted && $(this).scrollTop() > scrollOffset) {
        animationStarted = true;
  
        $('.box').each(function () {
          $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
          }, {
            duration: Number($(this).attr("data-duration")),
            easing: 'swing',
            step: function (now) {
              $(this).text(Math.ceil(now));
            }
          });
        });
      }
    });
  });
  