<div class="row toolbar">
    <div class="col-lg-12">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                    <ul class="nav navbar-nav">
                        <li class=""><a class="" href="<?= URL::route('admin.applications.create') ?>">Nieuwe applicatie</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acties <b class="caret"></b></a>
                            <ul class="dropdown-menu page-actions">
                                <li><a href="#" class="delete">Verwijderen</a></li>
                                <li><a href="<?= Url::route('admin.applications.export') ?>?<?= Request::getQueryString() ?>">Exporteren</a></li>
<!--                                <li><a href="#">Something else here</a></li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">Separated link</a></li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">One more separated link</a></li>-->
                            </ul>
                        </li>
                    </ul>
                    <form action="<?= Url::route('admin.applications.index') ?>" class="navbar-form navbar-right" role="search">

                        <label class="inline btn btn-checkbox btn-checkbox-inverted btn-sm" title="Enkel applicaties zichtbaar op de kaart">
                            <?= Form::checkbox('validForMap', '1', Input::get('validForMap') ? true : false ) ?><span class="glyphicon glyphicon-map-marker"></span>
                        </label>

                        <label class="inline btn btn-checkbox btn-sm" title="Enkel geimporteerde applicaties">
                            <?= Form::checkbox('is_csv_import', '1', Input::get('is_csv_import') ? true : false ) ?><span class="glyphicon glyphicon-import"></span>
                        </label>

                        <label class="inline btn btn-checkbox btn-sm" title="Enkel applicaties zichtbaar in de lijst onder de kaart">
                            <?= Form::checkbox('show_in_list', '1', Input::get('show_in_list') ? true : false ) ?><span class="glyphicon glyphicon-list"></span>
                        </label>

                        <div class="form-group">
                            <?= Form::select('marketing_campaign_disclaimer', array(
                                0 => 'Geen wedstrijd selectie',
                                1 => 'Enkel via wedstrijd',
                                2 => 'Enkel niet via wedstrijd',
                            ), Input::get('marketing_campaign_disclaimer'), array('class' => 'form-control')) ?>
                        </div>

                        <div class="form-group">
                            <?= Form::select('FK_ApplicationStatus', $statusOptions, Input::get('FK_ApplicationStatus'), array('class' => 'form-control')) ?>
                        </div>

                        <div class="form-group">
                            <input name="name" type="text" class="form-control" placeholder="Organisatienaam">
                        </div>

                        <input class="btn btn-primary" type="submit" value="Zoeken"/>

                        <a class="btn btn-primary" href="<?= URL::route('admin.applications.index') ?>">Opnieuw</a>
                    </form>
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>