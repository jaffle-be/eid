(function($, google, window){
    //google map global objects
    var map = null,
        info = new google.maps.InfoWindow();


    //our map helper functions
    var Map = {
        /**
         * local cache of all the application markers in the map
         */
        markers: [],
        setupTypeahead: function()
        {
            $(".city-query").typeahead({
            }, {
                source: function(query, process)
                {
                    $.ajax({
                        url: '/api/application/query-city',
                        data: {
                            query: query
                        },
                        type:'GET',
                        dataType:'json',
                        success: function(response)
                        {
                            results = [];
                            for(var i in response)
                            {
                                results.push({
                                    realValue: $.isNumeric(query) ? response[i].ZipCode : response[i].Village,
                                    value: response[i].ZipCode + ', ' + response[i].Village
                                });
                            }

                            return process(results);
                        }
                    });
                }
            }).on('typeahead:selected', function(event, suggestion, datasetname)
            {
                Map.getLocations({
                    near: suggestion.realValue,
                    mode: 'zipcity',
                    callback: function(response)
                    {
                        that.clearMarkers();
                        that.setCenter(response.center, response.bounds);
                        that.setLocations(response.locations);
                    }
                })
            });
        },
        /**
         * The algorithm used to search near me
         */
        searchNearMe: function()
        {
            this.addMyMarker(function(coords)
            {
                that.getLocations({
                    near: coords,
                    mode: 'geolocation',
                    callback: function(response)
                    {
                        this.clearMarkers();
                        this.setCenter(response.center, response.bounds);
                        this.setLocations(response.locations);
                    }
                });
            });
        },
        setCenter: function(center, bounds)
        {
            var center = new google.maps.LatLng(center.latitude, center.longitude);

            map.setCenter(center);

            var leftBottom = new google.maps.LatLng(bounds.minLat, bounds.minLong);
            var rightTop = new google.maps.LatLng(bounds.maxLat, bounds.maxLong);

            map.fitBounds(new google.maps.LatLngBounds(leftBottom, rightTop));
        },
        /**
         * Return a marker object based on data object
         * @param data
         * @returns {google.maps.Marker}
         */
        getMarker: function(data)
        {
            var marker = new google.maps.Marker();
            marker.setPosition(new google.maps.LatLng(data.Latitude, data.Longitude));
            google.maps.event.addListener(marker, "mouseover", function()
            {
                info.setPosition(new google.maps.LatLng(data.lat, data.long));
                info.setContent('<h4><b>' + data.OrganisationName + '</b></h4>' + '<p>' + data.Street + ' ' + data.NrAndBox + '<br/>' + data.ZipCode + ' ' + data.Village + '</p>');
                info.open(map, marker);
            });
            return marker;
        },
        /**
         * Method to add a marker for my position
         * @param callback
         */
        addMyMarker: function(callback)
        {
            if(this.geolocation())
            {
                window.navigator.geolocation.getCurrentPosition(function(position){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                        icon: 'http://maps.google.com/mapfiles/ms/micons/green.png'
                    });

                    marker.setMap(map);

                    if(typeof callback === 'function')
                    {
                        callback(position.coords);
                    }
                });
            }
        },
        /**
         * does the user have a browser supporting geolocation
         * @returns {*}
         */
        geolocation: function()
        {
            return $('html').hasClass('geolocation');
        },
        /**
         * This method will fetch all necessary location data including:
         * the map center
         * all different locations to show
         */
        getLocations: function(options)
        {
            if(typeof options.callback === 'function')
            {
                callback = options.callback;
                delete options.callback;
            }

            that = this;

            $.ajax({
                url: '/api/application',
                data: options,
                type:'GET',
                dataType:'json',
                success: function(response)
                {
                    if(callback && typeof callback === 'function')
                    {
                        callback.call(that, response);
                    }
                }
            });

        },
        /**
         * Add the given locations to the map
         */
        setLocations: function(locations)
        {
            for(var i in locations)
            {
                marker = this.getMarker(locations[i]);
                marker.setMap(map);
                Map.markers.push(marker);
            }
        },
        clearMarkers: function()
        {
            for(var i in this.markers)
            {
                this.markers[i].setMap(null);
            }
            this.markers = [];
        },
        events: function()
        {
            /**
             * EVENTS
             */
            var that = this;

            $('.my-location').on('click', function(event)
            {
                that.searchNearMe();
                event.preventDefault();
            });
        },
        /**
         * Method to setup the map on pageload
         */
        init: function()
        {
            this.setupTypeahead();
            this.events();
            //load the locations
            Map.getLocations({
                'callback': function(data)
                {
                    var mapOptions = {
                        zoom: 8
                    };
                    
                    map = new google.maps.Map(document.getElementById("map-canvas"),
                        mapOptions);

                    Map.setCenter(data.center, data.bounds);

                    Map.setLocations(data.locations);
                }
            });
        }

    }

    $(document).ready(function()
    {
        Map.init();
    });

})(window.jQuery, window.google, window);