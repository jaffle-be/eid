
<h4>Bedrijfsinformatie</h4>

<div class="row">

    <div class="col-xs-12 col-md-6">
        <p>
            <?= Form::label('OrganisationName', 'Naam van de organisatie*') ?>
            <?= Form::text('OrganisationName', null, array('class' => 'form-control')) ?>
        </p>
        <?= Form::error($errors, 'OrganisationName') ?>
    </div>

    <div class="col-xs-12 col-md-6">

        <div class="row">
            <p class="col-xs-9 col-md-8">
                <?= Form::label('Street', 'Straat') ?>
                <?= Form::text('Street', null, array('class' => 'form-control')) ?>
            </p>

            <p class="col-xs-3 col-md-4">
                <?= Form::label('NrAndBox', 'Nummer') ?>
                <?= Form::text('NrAndBox', null, array('class' => 'form-control')) ?>
            </p>

        </div>
        <div class="row">

            <p class="col-xs-3 col-md-4">
                <?= Form::label('ZipCode', 'Postcode') ?>
                <?= Form::text('ZipCode', null, array('class' => 'form-control')) ?>
            </p>

            <p class="col-xs-9 col-md-8">
                <?= Form::label('Village', 'Stad/Gemeente') ?>
                <?= Form::text('Village', null, array('class' => 'form-control')) ?>
            </p>
        </div>

    </div>

</div>

<div class="row">

    <p class="col-xs-12">
        <?= Form::label('Description', 'Omschrijving van de organisatie') ?>
        <?= Form::textarea('Description', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-12">
        <?= Form::label('Description_Translated', 'Omschrijving van de organisatie (vertaling)') ?>
        <?= Form::textarea('Description_Translated', null, array('class' => 'form-control')) ?>
    </p>

</div>

<h4>Contact informatie </h4>

<div class="row">
    <p class="col-xs-12 col-md-6">
        <?= Form::label('Telephone', 'Telefoon') ?>
        <?= Form::text('Telephone', null, array('class' => 'form-control')) ?>
    </p>

    <div class="col-xs-12 col-md-6">
        <p>
            <?= Form::label('Email', 'E-mailadres') ?>
            <?= Form::text('Email', null, array('class' => 'form-control')) ?>
        </p>

        <?= Form::error($errors, 'Email') ?>
    </div>

    <div class="col-xs-12 col-md-6">
        <p>
            <?= Form::label('Website', 'Website') ?>
            <?= Form::text('Website', null, array('class' => 'form-control')) ?>
        </p>
        <?= Form::error($errors, 'Website') ?>
    </div>
</div>

<h4>Coordinaten</h4>

<div class="row">

    <p class="col-xs-12 col-md-6">
        <?= Form::label('Latitude', 'Latitude') ?>
        <?= Form::text('Latitude', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-12 col-md-6">
        <?= Form::label('Longitude', 'Longitude') ?>
        <?= Form::text('Longitude', null, array('class' => 'form-control')) ?>
    </p>

</div>

<h4>Applicatie gegevens</h4>

@if($application->is_csv_import)
<div class="alert alert-info">
    <p>
        In de import file stond deze applicatie aangeduid als <strong>{{ $application->csv_import_category ? : 'NIET INGEVULD' }}<strong>
    </p>
</div>
@endif

<div class="row">

    <div class="col-xs-12 col-md-6">

        <div>
            <p>
                <?= Form::label('subcategory_id', 'Categorie*') ?>
                <?= Form::select('subcategory_id', $categories, null, array('class' => 'form-control')) ?>

                <?= Form::error($errors, 'subcategory_id') ?>
            </p>
        </div>

        <div>
            <p>
                <?= Form::label('FK_ApplicationStatus', 'Status') ?>
                <?= Form::select('FK_ApplicationStatus', $status, null, array('class' => 'form-control')) ?>
            </p>

            <?= Form::error($errors, 'FK_ApplicationStatus') ?>


        </div>



        <p>*
            <label>
                <?= Form::radio('LanguageCode', 'nl-BE') ?>
                Nederlands
            </label>

            <label>
                <?= Form::radio('LanguageCode', 'fr-BE') ?>
                Frans
            </label>
        </p>

        <?= Form::error($errors, 'LanguageCode') ?>


        <p>
            <label>
                <?= Form::checkbox('IsOnlineApplication', '1', null) ?>
                Online applicatie
            </label>
        </p>

        <p>
            <label>
                <?= Form::checkbox('show_in_list', '1', null) ?>
                Ook tonen in de algemene lijst
            </label>
        </p>




    </div>

    <div class="col-xs-12 col-md-6">

        <p>
            <?= Form::label('FK_ApplicationAreaRegion', 'Provincie') ?>
            <?= Form::select('FK_ApplicationAreaRegion', $provincies, null, array('class' => 'form-control')) ?>
        </p>

        <?= Form::error($errors, 'FK_ApplicationAreaRegion') ?>

        <p>
            <?= Form::label('FK_ApplicationArea', 'Regio*') ?>
            <?= Form::select('FK_ApplicationArea', $regions, null, array('class' => 'form-control')) ?>
        </p>

        <?= Form::error($errors, 'FK_ApplicationArea') ?>

    </div>


</div>


<div class="row">
    <p class="col-xs-12 text-center">
        <?= Form::submit('Bevestigen', array('class' => 'btn btn-primary btn-lg' )) ?>
    </p>
</div>
