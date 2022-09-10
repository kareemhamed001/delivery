@extends('layouts.front.index')
@section('content')
    <section class="container d-flex flex-column  justify-content-center mt-5 py-5  bg-opacity-75 rounded position-relative">
        <div class="pt-4">

            <h4 class="">
                <i class="fa-solid fa-house-chimney text-secondary "></i>
                 {{__('makeOrderPage.Make Order')}}
                <hr>
            </h4>
        </div>

        <div class="">
            <form class="d-flex flex-wrap justify-content-center bg-light shadow bg-opacity-50 p-2 rounded" method="post" action="{{url('order')}}" enctype="multipart/form-data">
                @csrf
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.Order Name')}} </label>
                    <input class="form-control" type="text" name="orderName" value="{{old('orderName')}}" placeholder="ما الذي تريد توصيله" title="ما الذي تريد توصيله">
                    <span class="text-danger">
                        @error('orderName'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.Order description')}} </label>
                    <input class="form-control" type="text" name="orderDescription" value="{{old('orderDescription')}}" placeholder="تفاصيل الطلب (الوزن,الابعاد)" title="تفاصيل الطلب">
                    <span class="text-danger">
                        @error('orderDescription'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.From')}} </label>
                    <input id="pac-input" class="form-control" type="text" name="fromAddress" value="{{old('fromAddress')}}" placeholder="مكان استلام الطلب" title="مكان استلام الطلب">
                    <span class="text-danger">
                        @error('fromAddress'){{$message}}@enderror
                    </span>
                </div>
                <div class="my-2 col-12 col-sm-12 col-md-6 p-1">
                    <label for="">{{__('makeOrderPage.To')}} </label>
                    <input  class="form-control" type="text" name="toAddress" value="{{old('toAddress')}}" placeholder="مكان توصيل الطلب" title="مكان توصيل الطلب">
                    <span class="text-danger">
                        @error('toAddress'){{$message}}@enderror
                    </span>

                </div>
{{--                <div class="col-12 col-sm-12 col-md-12">--}}
{{--                    <div id="map" class="w-50" style="height: 200px"></div>--}}
{{--                </div>--}}


                <div class="row w-100">
                    <div class="my-2 col-6 col-md-6 p-1">
                        <label for="">{{__('makeOrderPage.Date')}} </label>
                        <input class="form-control" type="date" name="date" value="{{old('date')}}" placeholder="تاريخ التوصيل" title="تاريخ توصيل الطلب">
                        <span class="text-danger">
                        @error('date'){{$message}}@enderror
                    </span>
                    </div>
                    <div class="my-2 col-6 col-md-6 p-1">
                        <label for="">{{__('makeOrderPage.Time')}} </label>
                        <input class="form-control" type="time" name="time" value="{{old('time')}}" title="وقت تسليمنا الطلب" >
                        <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                    </div>
                </div>

                <div class="my-2 col-12 p-1">
                    <label for="">{{__('makeOrderPage.Notes')}} </label>

                    <textarea class="form-control" name="notes" id=""  rows="3" title="ملاحظات">{{old('notes')}}</textarea>
                    <span class="text-danger">
                        @error('time'){{$message}}@enderror
                    </span>
                </div>
                <div class="col-12 my-2  ">
                    <button class="btn text-white bg-secondary mx-1 float-end " type="submit" >{{__('makeOrderPage.Save')}}</button>
                    <button class="btn text-white bg-danger mx-1 float-end" type="reset">{{__('makeOrderPage.Cancel')}}</button>
                </div>

            </form>
        </div>
    </section>

@endsection
@section('scripts')

    <script>

        $("#pac-input").focusin(function() {
            $(this).val('');
        });

        $('#latitude').val('');
        $('#longitude').val('');


        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.740691, lng: 46.6528521 },
                zoom: 10,
                mapTypeId: 'roadmap'
            });

            // move pin and current location
            infoWindow = new google.maps.InfoWindow;
            geocoder = new google.maps.Geocoder();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(pos),
                        map: map,
                        title: 'موقعك الحالي'
                    });
                    markers.push(marker);
                    marker.addListener('click', function() {
                        geocodeLatLng(geocoder, map, infoWindow,marker);
                    });
                    // to get current position address on load
                    google.maps.event.trigger(marker, 'click');
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                console.log('dsdsdsdsddsd');
                handleLocationError(false, infoWindow, map.getCenter());
            }

            var geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function(event) {
                SelectedLatLng = event.latLng;
                geocoder.geocode({
                    'latLng': event.latLng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            deleteMarkers();
                            addMarkerRunTime(event.latLng);
                            SelectedLocation = results[0].formatted_address;
                            console.log( results[0].formatted_address);
                            splitLatLng(String(event.latLng));
                            $("#pac-input").val(results[0].formatted_address);
                        }
                    }
                });
            });
            function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
                $('#latitude').val(markerCurrent.position.lat());
                $('#longitude').val(markerCurrent.position.lng());

                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(8);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            markers.push(marker);
                            infowindow.setContent(results[0].formatted_address);
                            SelectedLocation = results[0].formatted_address;
                            $("#pac-input").val(results[0].formatted_address);

                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
                SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
            }
            function addMarkerRunTime(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
                markers.push(marker);
            }
            function setMapOnAll(map) {
                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }
            function clearMarkers() {
                setMapOnAll(null);
            }
            function deleteMarkers() {
                clearMarkers();
                markers = [];
            }

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            //$("#pac-input").val("أبحث هنا ");
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(1000, 1000),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));


                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
        function splitLatLng(latLng){
            var newString = latLng.substring(0, latLng.length-1);
            var newString2 = newString.substring(1);
            var trainindIdArray = newString2.split(',');
            var lat = trainindIdArray[0];
            var Lng  = trainindIdArray[1];

            $("#latitude").val(lat);
            $("#longitude").val(Lng);
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs&libraries=places&callback=initAutocomplete&language=ar&region=EG
async defer"></script>
@endsection
