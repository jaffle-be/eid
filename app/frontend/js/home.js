(function($, google, app, window){
    //google map global objects
    var map = null,
        info = new google.maps.InfoWindow();


    if(!Modernizr.input.placeholder){
        $("input[placeholder]").each(function(){
            $(this).val($(this).attr('placeholder'));
        });
        $("input[placeholder]").on('focus', function(){
            $(this).val('');
        });
        $("input[placeholder]").on('blur', function(){
            var tekst = $(this).attr('placeholder');
            if($(this).val() == ''){
                $(this).val(tekst);
            }
        });
    }

    var Typeahead = function (map)
    {
        this.instance = $(".city-query");
        this.init(map);
    }

    Typeahead.prototype = {
        init: function(map)
        {
            this.instance.typeahead({
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
                            $("#typeahead-messages").toggleClass('invisible', response.length > 0 ? true : false);
                            results = [];
                            for(var i in response)
                            {
                                results.push({
                                    realValue: response[i].ZipCode,
                                    value: response[i].ZipCode + ', ' + response[i].Village
                                });
                            }

                            return process(results);
                        }
                    });
                }
            }).on('typeahead:selected', function(event, suggestion, datasetname)
            {
                map.getLocations({
                    near: suggestion.realValue,
                    mode: 'zipcity',
                    category: that.getCategory(),
                    callback: function(response)
                    {
                        that.clearMarkers();
                        that.setCenter(response.center, response.bounds);
                        that.setLocations(response.locations);
                    }
                })
            });
        }
    }

    var Map = function()
    {
        this.init();
    }

    //our map helper functions
    Map.prototype = {
        /**
         * local cache of all the application markers in the map
         */
        markers: [],
        myPosition: false,
        /**
         * The algorithm used to search near me
         */
        searchNearMe: function()
        {
            this.addMyMarker(function(coords)
            {
                that.myPosition = coords;
                that.getLocations({
                    near: coords,
                    mode: 'geolocation',
                    category: that.getCategory(),
                    callback: function(response)
                    {
                        this.clearMarkers();
                        /**
                         * Only set bounds if we actually have locations, else we see the whole world on the map
                         */
                        if(response.locations.length > 0)
                        {
                            this.setCenter(response.center, response.bounds);
                        }
                        this.setLocations(response.locations);
                    }
                });
            });
        },
        getCategory: function()
        {
            return $(".category-filter").val()
        },
        setCenter: function(center, bounds)
        {
            var center = new google.maps.LatLng(center.latitude, center.longitude);

            map.setCenter(center);

            if(this.myPosition)
            {
                bounds = this.adjustBounds(bounds);
            }

            var leftBottom = new google.maps.LatLng(bounds.minLat, bounds.minLong);
            var rightTop = new google.maps.LatLng(bounds.maxLat, bounds.maxLong);

            map.fitBounds(new google.maps.LatLngBounds(leftBottom, rightTop));

            if(map.getZoom() > 8)
            {
                map.setZoom(8);
            }

        },
        adjustBounds: function(bounds)
        {
            if(bounds.minLat > this.myPosition.latitude)
            {
                bounds.minLat = this.myPosition.latitude;
            }
            else if(bounds.maxLat < this.myPosition.latitude)
            {
                bounds.maxLat = this.myPosition.latitude;
            }

            if(bounds.minLong > this.myPosition.longitude)
            {
                bounds.minLong = this.myPosition.longitude;
            }
            else if(bounds.maxLong < this.myPosition.longitude)
            {
                bounds.maxLong = this.myPosition.longitude;
            }

            return bounds;
        },
        /**
         * Return a marker object based on data object
         * @param data
         * @returns {google.maps.Marker}
         */
        getMarker: function(data)
        {
            var marker = new google.maps.Marker();
            var that = this;
            marker.setPosition(new google.maps.LatLng(data.Latitude, data.Longitude));
            google.maps.event.addListener(marker, "mouseover", function()
            {
                info.setPosition(new google.maps.LatLng(data.lat, data.long));
                info.setContent(that.getInfoContent(data));
                info.open(map, marker);
            });
            return marker;
        },

        getInfoContent: function(data)
        {
            var street = data.Street == null ? '' : data.Street,
                box = data.NrAndBox == null ? '' : data.NrAndBox,
                zip = data.ZipCode == null ? '' : data.ZipCode,
                village = data.Village == null ? '' : data.Village,
                description = app.language.get() == 'nl' ? data.Description : data.Description_Translated;


            if(description == null)
            {
                description = '';
            }


            return '<h4><b>' + data.OrganisationName + '</b></h4>' + '<p>' + street + ' ' + box + '<br/>' + zip + ' ' + village + '</p><p>' + description + '</p>';
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
            if(locations.length == 0)
            {
                $("#no-results").show();
            }
            else
            {
                $("#no-results").hide();
            }

            for(var i in locations)
            {
                marker = this.getMarker(locations[i]);
                marker.setMap(map);
                this.markers.push(marker);
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

            $(".category-filter").on('change', function()
            {
                that.getLocations({
                    category: that.getCategory(),
                    callback: function(response)
                    {
                        this.clearMarkers();
                        /**
                         * Only set bounds if we actually have locations, else we see the whole world on the map
                         */
                        if(response.locations.length > 0)
                        {
                            this.setCenter(response.center, response.bounds);
                        }
                        this.setLocations(response.locations);
                    }
                });
            });
        },
        /**
         * Method to setup the map on pageload
         */
        init: function()
        {
            this.typeahead = new Typeahead(this);
            this.events();
            //load the locations
            this.getLocations({
                'callback': function(data)
                {
                    var mapOptions = {
                        zoom: 8
                    };
                    
                    map = new google.maps.Map(document.getElementById("map-canvas"),
                        mapOptions);

                    this.setCenter(data.center, data.bounds);

                    this.setLocations(data.locations);
                }
            });
        }

    }

    $(document).ready(function()
    {
        new Map();
    });

})(window.jQuery, window.google, window.app, window);