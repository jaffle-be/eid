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

    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="btn btn-primary" href="<?= URL::route('sign-up') ?>"><?= Lang::get('home.want_to_join') ?></a>
        </div>
    </div>

    <div id="typeahead-messages" class="col-lg-12 alert alert-danger invisible">
        <?= Lang::get('home.no-applications-found') ?>
    </div>


    <div class="row">

        <div class="col-lg-12">
            <div id="no-results" class="alert alert-info hide"><?= Lang::get('home.no_results_found') ?></div>
        </div>

        <div class="col-lg-4">

            <?= Form::text('postal', null, array('class' => 'city-query form-control text-center', 'placeholder' => Lang::get('home.search_postal_city') )) ?>

        </div>

        <div class="col-lg-4 geo-locator">
            <a class="btn btn-primary my-location form-control" href="#"><?= Lang::get('home.search_near') ?></a>
        </div>

        <div class="col-lg-4">
            <?= Form::select('category', $categories, null, array('class' => 'form-control category-filter')) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 map-container">
            <div id="map-canvas"></div>
        </div>
    </div>

    <div class="row">

        @if(count($applications))

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th><?= Lang::get('home.organisation') ?></th>
                    <th><?= Lang::get('home.description') ?></th>
                </tr>
            </thead>
            <tbody>

            @foreach($applications as $application)

                <tr>

                    <td><?= $application->OrganisationName ?></td>
                    <td><?= App::getLocale() === 'nl' ? $application->Description : $application->Description_Translated ?></td>

                </tr>

            </tbody>

            @endforeach

        </table>

        @endif

    </div>

</div>
@stop