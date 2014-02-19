@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?language=<?= App::getLocale()?>&key=AIzaSyCnUu6T0LAXErwOkvIxi7fPjO4oiA98ti0&sensor=false"></script>
<script src="/js/home.min.js"></script>
@stop

@section('styles')
<link rel="stylesheet" href="/css/home.css"/>
@stop

@section('content')
<div class="container">

    @if(Session::has('message'))

    <div class="alert alert-success"><?= Lang::get('home.thanks_for_signing_up') ?></div>

    @endif

    <div class="page-header">
        <h3><?= Lang::get('home.application_name') ?></h3>
    </div>

    <div class="row">

        <div class="col-lg-6">

            <?= Form::text('postal', null, array('class' => 'city-query form-control text-center', 'placeholder' => Lang::get('home.search_postal_city') )) ?>

        </div>

        <div class="col-lg-6 geo-locator">
            <a class="btn btn-primary my-location form-control" href="#"><?= Lang::get('home.search_near') ?></a>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 map-container">
            <div id="map-canvas"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="btn btn-primary" href="<?= URL::route('sign-up') ?>"><?= Lang::get('home.want_to_join') ?></a>
        </div>
    </div>

</div>
@stop