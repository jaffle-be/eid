<div class="row toolbar">
    <div class="col-lg-12">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                    <ul class="nav navbar-nav">
                        <li class=""><a class="" href="<?= URL::route('admin.applications.create') ?>">Nieuwe applicatie</a></li>
<!--                        <li class="dropdown">-->
<!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a href="#">Action</a></li>-->
<!--                                <li><a href="#">Another action</a></li>-->
<!--                                <li><a href="#">Something else here</a></li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">Separated link</a></li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">One more separated link</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                    </ul>
                    <div class="navbar-right navbar-form">
                        <a class="btn btn-primary form-control" href="<?= URL::route('admin.applications.index') ?>">Opnieuw</a>
                    </div>
                    <form action="<?= Url::route('admin.applications.index') ?>" class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Zoeken">
                        </div>
                    </form>
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>