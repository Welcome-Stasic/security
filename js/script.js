$(document).on('ready', function() {
    if ($(window).width() < 991) {
        $(".vertical-center-4").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1300,
            arrow: false,
            nextArrow: false,
            prevArrow: false,
        });
    } else {
        $(".vertical-center-4").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1300,
            nextArrow: false,
            prevArrow: false,
        });
    }
    $('#burger').click(function(e) {
        $('#menu-header').toggleClass('show');
        $(this).toggleClass('active');
        
        if ($('#menu-header').hasClass('show')) {
            $('body').css('overflow', 'hidden');
        } else {
            $('body').css('overflow', 'unset');
        }
    });
});
