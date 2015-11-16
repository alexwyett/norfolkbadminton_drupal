(function ($) {  
    Drupal.behaviors.nba_search = {
        attach: function (context, settings) {
            $('#opensearch').click(function() {
                $('.region-search')
                    .toggleClass('open')
                    .find('.sitesearch')
                        .slideToggle(200)
                    .end();
                $(this).toggleClass('icon-cross');
            });
            
            $('#dosearch').click(function() {
                $('#search-block-form').submit();
            });
        }
    };
})(jQuery);