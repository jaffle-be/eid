
<h4>Algemene info</h4>

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

</div>

<div class="row">
    <p class="col-xs-12 text-center">
        <?= Form::submit('Bevestigen', array('class' => 'btn btn-primary btn-lg' )) ?>
    </p>
</div>