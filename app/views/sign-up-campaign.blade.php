@section('styles')

<link rel="stylesheet" href="/css/campaign.min.css"/>

@stop

@section('content')

<div class="container">

    <div class="campaign-text">
        <h2>{{ Lang::get('signup.campaign-title') }}</h2>

        <p>{{ Lang::get('signup.campaign-subtitle') }}</p>

    </div>

    @if(Session::has('message'))

    <div class="alert alert-danger"><?= Lang::get('general.form-failure') ?></div>

    @endif

    <?= Form::model($application, array('route' => 'sign-up.submit')) ?>

    <h4><?= Lang::get('signup.contact-info')?></h4>

    <div class="row">

        <div class="col-xs-12 col-md-6">
            <div class="row">
                <p class="col-xs-12">
                    <?= Form::label('contact_firstname', Lang::get('signup.contact_firstname')) ?>
                    <?= Form::text('contact_firstname', null, array('class' => 'form-control')) ?>
                </p>

                <p class="col-xs-12">
                    <?= Form::label('contact_lastname', Lang::get('signup.contact_lastname')) ?>
                    <?= Form::text('contact_lastname', null, array('class' => 'form-control')) ?>
                </p>
            </div>
        </div>

        <div class="col-xs-12 col-md-6">

            <div class="row">

                <p class="col-xs-12">
                    <?= Form::label('Telephone', Lang::get('signup.phone')) ?>
                    <?= Form::text('Telephone', null, array('class' => 'form-control')) ?>
                </p>

                <div class="col-xs-12">
                    <p>
                        <?= Form::label('Email', Lang::get('signup.email')) ?>
                        <?= Form::text('Email', null, array('class' => 'form-control')) ?>
                    </p>

                    <?= Form::error($errors, 'Email') ?>
                </div>

            </div>

        </div>

    </div>

    <h4><?= Lang::get('signup.Bedrijfsinformatie') ?></h4>

    <div class="row">

        <div class="col-xs-12 col-md-6">
            <p>
                <?= Form::label('OrganisationName', Lang::get('signup.organisation-name') . '*') ?>
                <?= Form::text('OrganisationName', null, array('class' => 'form-control')) ?>
            </p>
            <?= Form::error($errors, 'OrganisationName') ?>
        </div>

        <div class="col-xs-12 col-md-6">

            <div class="row">
                <p class="col-xs-9 col-md-8">
                    <?= Form::label('Street', Lang::get('signup.street')) ?>
                    <?= Form::text('Street', null, array('class' => 'form-control')) ?>
                </p>

                <p class="col-xs-3 col-md-4">
                    <?= Form::label('NrAndBox', Lang::get('signup.nrbox')) ?>
                    <?= Form::text('NrAndBox', null, array('class' => 'form-control')) ?>
                </p>

            </div>
            <div class="row">

                <p class="col-xs-3 col-md-4">
                    <?= Form::label('ZipCode', Lang::get('signup.zipcode')) ?>
                    <?= Form::text('ZipCode', null, array('class' => 'form-control')) ?>
                </p>

                <p class="col-xs-9 col-md-8">
                    <?= Form::label('Village', Lang::get('signup.city')) ?>
                    <?= Form::text('Village', null, array('class' => 'form-control')) ?>
                </p>
            </div>

        </div>

    </div>

    <div class="row">

        <p class="col-xs-12">
            <?= Form::label('Description' . (App::getLocale() == 'fr' ? '_Translated' : '' ), Lang::get('signup.description')) ?>
            <?= Form::textarea('Description' . (App::getLocale() == 'fr' ? '_Translated' : '' ), null, array('class' => 'form-control')) ?>
        </p>

    </div>

    <div class="row">
        <p class="col-xs-12 text-center">
            <?= Form::submit(Lang::get('signup.submit'), array('class' => 'btn btn-primary btn-lg' )) ?>
        </p>
    </div>


    <?= Form::close() ?>




</div>



@stop