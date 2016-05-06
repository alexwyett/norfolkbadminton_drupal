(function ($) {    
    Drupal.behaviors.nbaclubs_block = {
        attach: function (context, settings) {
            var plugin = Drupal.behaviors.nbaclubs_layermap.getPlugin();
            
            var layerMap = new plugin({
                container: 'nbaclubs_map'
            });
        }
    };
})(jQuery);