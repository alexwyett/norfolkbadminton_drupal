(function ($) {  
    Drupal.behaviors.expandable = {
        attach: function (context, settings) {
            $('.c-expandable_toggle').click(function() {
                $(this).closest('.c-expandable').toggleClass('open')
            });
        }
    };
})(jQuery);