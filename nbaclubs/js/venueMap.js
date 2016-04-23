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
            
            $('.nbaclubvenue_map').each(function(i, ele) {
                console.log(i);
                var plugin = new nbaclubs_venueMap({
                    center: [
                        Drupal.settings.nbaclubvenue[i].lng,
                        Drupal.settings.nbaclubvenue[i].lat
                    ],
                    zoom: 12,
                    container: ele
                });
                plugin.createMarker();
            });
        }
    };
})(jQuery);