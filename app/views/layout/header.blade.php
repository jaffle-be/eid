<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= Lang::get('home.application_name') ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>

    <link rel="stylesheet" href="/css/main.css">

    @yield('styles')

    <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= URL::route('home') ?>"><?= Lang::get('home.application_name') ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if(Auth::user())
                <li><a href="<?= URL::route('admin.applications.index') ?>"><?= Lang::get('home.applicaties') ?></a></li>
                @endif

<!--                <li><a href="#contact">Contact</a></li>-->
<!--                <li class="dropdown">-->
<!--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">Action</a></li>-->
<!--                        <li><a href="#">Another action</a></li>-->
<!--                        <li><a href="#">Something else here</a></li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li class="dropdown-header">Nav header</li>-->
<!--                        <li><a href="#">Separated link</a></li>-->
<!--                        <li><a href="#">One more separated link</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= App::getLocale() == 'nl' ? "http://eid.pinot.netwerklounge.be/nl/" : "http://eid.pinot.netwerklounge.be/fr" ?>"><?= Lang::get('general.take_me_back_jack') ?></a>
                    </li>
                </ul>
            </div>

        </div><!--/.navbar-collapse -->
    </div>
</div>

<div class="banner">
    <div class="container">
        <img class="img-responsive" src="/img/dame.jpg"/>
    </div>
</div>