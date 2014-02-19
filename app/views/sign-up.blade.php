@section('content')


<div class="container">

    @if(Session::has('message'))

    <div class="alert alert-danger"><?= Lang::get('general.form-failure') ?></div>

    @endif

    <?= Form::model($application, array('action' => 'HomeController@postSignup')) ?>

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
            <?= Form::label('Description', Lang::get('signup.description')) ?>
            <?= Form::textarea('Description', null, array('class' => 'form-control')) ?>
        </p>

        <p class="col-xs-12">
            <?= Form::label('Description_Translated', Lang::get('signup.description_alternate')) ?>
            <?= Form::textarea('Description_Translated', null, array('class' => 'form-control')) ?>
        </p>

    </div>

    <h4><?= Lang::get('signup.contact-info')?></h4>

    <div class="row">
        <p class="col-xs-12 col-md-6">
            <?= Form::label('Telephone', Lang::get('signup.phone')) ?>
            <?= Form::text('Telephone', null, array('class' => 'form-control')) ?>
        </p>

        <div class="col-xs-12 col-md-6">
            <p>
                <?= Form::label('Email', Lang::get('signup.email')) ?>
                <?= Form::text('Email', null, array('class' => 'form-control')) ?>
            </p>

            <?= Form::error($errors, 'Email') ?>
        </div>

        <div class="col-xs-12 col-md-6">
            <p>
                <?= Form::label('Website', Lang::get('signup.website')) ?>
                <?= Form::text('Website', null, array('class' => 'form-control')) ?>
            </p>
            <?= Form::error($errors, 'Website') ?>
        </div>
    </div>

    <h4><?= Lang::get('signup.coords') ?></h4>

    <div class="row">

        <p class="col-xs-12 col-md-6">
            <?= Form::label('Latitude', Lang::get('signup.lat')) ?>
            <?= Form::text('Latitude', null, array('class' => 'form-control')) ?>
        </p>

        <p class="col-xs-12 col-md-6">
            <?= Form::label('Longitude', Lang::get('signup.long')) ?>
            <?= Form::text('Longitude', null, array('class' => 'form-control')) ?>
        </p>

    </div>

    <h4><?= Lang::get('signup.application-info') ?></h4>

    <div class="row">

        <div class="col-xs-12 col-md-6">

            <div>
                <p>
                    <?= Form::label('subcategory_id', Lang::get('signup.categorie') . '*') ?>
                    <?= Form::select('subcategory_id', $categories, null, array('class' => 'form-control')) ?>

                    <?= Form::error($errors, 'subcategory_id') ?>
                </p>
            </div>

            <p>
                <label>
                    <?= Form::checkbox('IsOnlineApplication', '1', null) ?>
                    <?= Lang::get('signup.online-app') ?>
                </label>
            </p>

            <p>*
                <label>
                    <?= Form::radio('LanguageCode', 'nl-BE') ?>
                    <?= Lang::get('signup.nl') ?>
                </label>

                <label>
                    <?= Form::radio('LanguageCode', 'fr-BE') ?>
                    <?= Lang::get('signup.fr') ?>
                </label>
            </p>

            <?= Form::error($errors, 'LanguageCode') ?>



        </div>

        <div class="col-xs-12 col-md-6">

            <p>
                <?= Form::label('FK_ApplicationAreaRegion', Lang::get('signup.provincie')) ?>
                <?= Form::select('FK_ApplicationAreaRegion', $provincies, null, array('class' => 'form-control')) ?>
            </p>

            <?= Form::error($errors, 'FK_ApplicationAreaRegion') ?>

            <p>
                <?= Form::label('FK_ApplicationArea', Lang::get('signup.regio') . '*') ?>
                <?= Form::select('FK_ApplicationArea', $regions, null, array('class' => 'form-control')) ?>
            </p>

            <?= Form::error($errors, 'FK_ApplicationArea') ?>

        </div>


    </div>


    <div class="row">
        <p class="col-xs-12 text-center">
            <?= Form::submit(Lang::get('signup.submit'), array('class' => 'btn btn-primary btn-lg' )) ?>
        </p>
    </div>


    <?= Form::close() ?>




</div>



@stop