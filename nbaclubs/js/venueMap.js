(function ($) {    
    Drupal.behaviors.nbaclubs_venueMap = {
        attach: function (context, settings) {
            var nbaclubs_venueMap = leafletMap.extend({
                createMarker: function() {
                    var marker = Drupal.behaviors.leafletmaputils.createMarker(
                        this.options.center[0],
                        this.options.center[1]
                    ).addTo(this.getMap());
                }
            });
            
            var plugin = new nbaclubs_venueMap({
                center: [
                    Drupal.settings.nbaclubvenue.lng,
                    Drupal.settings.nbaclubvenue.lat
                ],
                zoom: 12,
                container: 'nbaclubvenue_map'
            });
            plugin.createMarker();
        }
    };
})(jQuery);