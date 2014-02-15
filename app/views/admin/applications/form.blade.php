
<h4>Bedrijfsinformatie</h4>

<div class="row">

    <p class="col-xs-12 col-md-6">
        <?= Form::label('OrganisationName', 'Naam van de organisatie') ?>
        <?= Form::text('OrganisationName', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-9 col-md-4">
        <?= Form::label('Street', 'Straat') ?>
        <?= Form::text('Street', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-3 col-md-2">
        <?= Form::label('NrAndBox', 'Nummer') ?>
        <?= Form::text('NrAndBox', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-3 col-md-2 col-md-offset-6">
        <?= Form::label('ZipCode', 'Postcode') ?>
        <?= Form::text('ZipCode', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-9 col-md-4">
        <?= Form::label('Village', 'Stad/Gemeente') ?>
        <?= Form::text('Village', null, array('class' => 'form-control')) ?>
    </p>

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

    <p class="col-xs-12 col-md-6">
        <?= Form::label('Email', 'E-mailadres') ?>
        <?= Form::text('Email', null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-12 col-md-6">
        <?= Form::label('Website', 'Website') ?>
        <?= Form::text('Website', null, array('class' => 'form-control')) ?>
    </p>
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

<div class="row">

    <p class="col-xs-12 col-md-6">
        <?= Form::label('subcategory_id', 'Categorie') ?>
        <?= Form::select('subcategory_id', $categories, null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-12 col-md-6">
        <?= Form::label('FK_ApplicationArea', 'Regio') ?>
        <?= Form::select('FK_ApplicationArea', $regions, null, array('class' => 'form-control')) ?>
    </p>

    <p class="col-xs-12 col-md-6">
        <?= Form::checkbox('IsOnlineApplication', null, array('class' => 'form-control')) ?>
        <?= Form::label('IsOnlineApplication', 'Online applicatie') ?>
    </p>


    <p class="col-xs-12 col-md-6">
        <label>
            <?= Form::radio('LanguageCode', 'nl-BE') ?>
            Nederlands
        </label>

        <label>
            <?= Form::radio('LanguageCode', 'fr-BE') ?>
            Frans
        </label>
    </p>



</div>


<div class="row">
    <p class="col-xs-12 text-center">
        <?= Form::submit('Bevestigen', array('class' => 'btn btn-primary btn-lg' )) ?>
    </p>
</div>
