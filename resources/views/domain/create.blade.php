@extends('layouts.master')
@section('content')
 
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  
  
  
    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmU2-8WMF56Sa_VGbziREkGnW0CW6zR6U">
    </script>
 
<div id="app">
    <div class="modal-content animated bounceInRight">
        <div class="modal-header">
            <h4 class="modal-title">Create Domain</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['id'=>'perform_domain_create_Form', 'name'=>'perform_domain_create_Form']) !!}
        <div class="form-group">
                <label>Domain</label>
                {{ Form::text('name','',['placeholder'=>'Domain Name',' class'=>'p-xs'])}}
            </div>
            <div class="form-group">
                <label>Link</label>
                {{ Form::text('link','',['placeholder'=>'Link',' class'=>'p-xs'])}}
            </div>
      <div class="form-group">
                <label>language</label>
                {{ Form::text('language','',['placeholder'=>'language',' class'=>'p-xs'])}}
            </div>
            <div class="form-group">
                <label>location</label>
                {{ Form::text('location','',['placeholder'=>'location',' class'=>'p-xs'])}}
            </div>
 
 
            {!! Form::close() !!}
            <div class="clearfix">&nbsp;</div>
               <div id="map"></div>
        </div>
        <div class="modal-footer">
            <div id='perform_domain_create_Loader'> </div>
            <div id="perform_domain_create_Results" class="success-element alert-info"></div>

            <button type="button" id="perform_domain_create_Button" class="btn btn-primary">save</button>
        </div>
    </div>

</div>

@endsection