<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-md-3">
                &copy; Eid locator
            </div>

            <div class="col-xs-6 col-md-3">
                <a href="{{ URL::route('disclaimer') }}">{{ Lang::get('general.disclaimer') }}</a>
            </div>

            <div class="col-xs-12 col-md-6">
                @if(Auth::guest())
                    <form class="" action="<?= URL::route('login') ?>" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="<?= Lang::get('general.email') ?>" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="<?= Lang::get('general.paswoord') ?>" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary"><?= Lang::get('general.login') ?></button>
                    </form>
                @else
                    <div class="navbar-right navbar-form">
                        <a class="btn btn-primary" href="<?= URL::route('logout') ?>"><?= Lang::get('general.logout') ?></a>
                    </div>
                @endif
            </div>
        </div>

    </div>

</footer>

@yield('modals')


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

<script src="/js/vendor/bootstrap.min.js"></script>
@yield('scripts')

</body>
</html>
