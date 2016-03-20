(function ($) {  
    Drupal.behaviors.nbabanner = {
        attach: function (context, settings) {
            $('.nbabanners').flickity({
                cellAlign: 'left',
                wrapAround: true,
                cellSelector: '.nbabanner_banner',
                pageDots: false,
                imagesLoaded: true
            });
        }
    };
})(jQuery);