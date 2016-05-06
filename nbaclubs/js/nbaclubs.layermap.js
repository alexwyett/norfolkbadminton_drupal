(function ($) {    
    Drupal.behaviors.nbaclubs_layermap = {
        getPlugin: function () {
            var layermap = leafletClusterMap.extend({
                init: function(args) {
                    this._super(args);
                    loaded = false;
                    jQuery.ajax({
                        url: Drupal.settings.basePath + '/clubs.json',
                        async: false,
                        dataType: 'json',
                        success: function(json) {
                            this.geoJson = L.geoJson(json, {
                                pointToLayer: function (feature, latlng) {
                                    return this.defineMarker(feature, latlng);
                                }.bind(this),
                                onEachFeature: function (feature, layer) {
                                    this.definePopup(feature, layer);
                                }.bind(this)
                            });

                            this.resetCluster();
                        }.bind(this)
                    });

                    this.tiles.on('load', function() {
                        if (loaded === false) {
                            this.fitBounds();
                            loaded = true;
                        }
                    }.bind(this));

                    // Call function which can be prototyped
                    this.hook_init();
                },

                hook_init: function() {},

                resetCluster: function() {
                    this.fireEvent('clubmap_resetCluster_before');
                    this.refreshLayers();
                    this.fireEvent('clubmap_resetCluster_after');
                },

                refreshLayers: function() {
                    this.markerClusters.clearLayers();
                    this.geoJson.eachLayer(function (layer) {
                        this.markerClusters.addLayer(layer);
                    }.bind(this));
                },

                definePopup: function(feature, layer) {
                    tag = '<h4 class="c-title c-title-small">' + feature.properties.venue.name + '</h4>';
                    if (feature.properties.hasOwnProperty('clubs')) {
                        tag += '<p>The following clubs play here: </p><ul>';
                        for (var i = 0; i < feature.properties.clubs.length; i++) {
                            tag += '<li>' + feature.properties.clubs[i].name + ' <a href="' + feature.properties.clubs[i].url + '" class="show-venue button tiny round">View details</a></li>';
                        }
                        tag += '</ul>';
                    }
                    tag += '<p><a href="https://maps.google.com?saddr=Current+Location&daddr=' + layer.getLatLng().lat + ',' + layer.getLatLng().lng + '" target="_blank">Click to get directions</a></p>';
                    layer.bindPopup(tag);
                },

                defineMarker: function(feature, latlng) {
                    return Drupal.behaviors.leafletmaputils.createMarker(
                        this.options.center[0],
                        this.options.center[1]
                    );
                }
            });
            
            return layermap;
        }
    };
})(jQuery);