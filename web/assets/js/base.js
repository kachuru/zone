function scrollToCenter() {
    $([document.documentElement, document.body]).animate({
        scrollTop: ($(document).height() - $(window).height()) / 2
    }, 2000);

    $([document.documentElement, document.body]).animate({
        scrollLeft: ($(document).width() - $(window).width()) / 2
    }, 2000);
}
