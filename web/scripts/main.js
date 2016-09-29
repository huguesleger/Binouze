
//Scroll Menu
$(window).on('scroll', function () {
    if ($(window).scrollTop() > 100) {
        $('.navbar-main').addClass('navbar-min');
        $('.navbar-main').addClass('navbar-brand-min');
        $('.navbar-main').addClass('navbar-nav-min');
        $('.navbar-main').removeClass('navbar-nav');
        $('.navbar-main').removeClass('navbar-brand');

    } else {
        $('.navbar-main').removeClass('navbar-min');
        $('.navbar-main').removeClass('navbar-brand-min');
        $('.navbar-main').removeClass('navbar-nav-min');
    }
});
$(document).ready(function () {
//    réglage hauteur navbar/section
    var hauteurNavbar = $('.navbar').innerHeight();
    $('.header').css('padding-top', +hauteurNavbar + 'px');

    $('li').click(function () {
        var classe = $(this).attr('class');
        if (classe === 'active') {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
});
