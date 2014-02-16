@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?language=nl&key=AIzaSyCnUu6T0LAXErwOkvIxi7fPjO4oiA98ti0&sensor=false"></script>
<script src="/js/home.min.js"></script>
@stop

@section('styles')
<link rel="stylesheet" href="/css/home.css"/>
@stop

@section('content')
<div class="container">

    <div class="page-header">
        <h3>Eid Locator</h3>
    </div>

    <div class="row">

        <div class="col-lg-6">

            <?= Form::text('postal', null, array('class' => 'city-query form-control text-center', 'placeholder' => 'Zoek op basis van een postcode of stad')) ?>

        </div>

        <div class="col-lg-6 geo-locator">
            <a class="btn btn-primary my-location form-control" href="#">Of zoek in uw buurt</a>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 map-container">
            <div id="map-canvas"></div>
        </div>
    </div>


    <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-primary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
    </div>
</div>
@stop