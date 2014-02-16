@section('scripts')

<script src="/js/admin/applications/index.min.js"></script>

@stop

@section('content')


<div class="container">
    <div class="page-header">
        <h3>Applicaties</h3>
    </div>

    @if(count($apps))

    <div class="text-center">
        {{ $apps->links() }}
    </div>

    @endif

    @include('admin.applications.toolbar')

    @if(count($apps))

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Applicatie</th>
            <th>Locatie</th>
            <th>Categorie</th>
            <th>Aangemaakt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($apps as $app)
        <tr data-application-id="<?= $app->id?>">
            <td><input type="checkbox" class="selector"/></td>
            <td><a href="<?= URL::route('admin.applications.edit', array($app->id)) ?>"><?= $app->OrganisationName ?></a></td>
            <td><?= $app->Village ?></td>
            <td><?= $app->subcategory ? $app->subcategory->CategoryDutch : null ?></td>
            <td><?= $app->created_at->format('d/m/Y') ?></td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">

        {{ $apps->links() }}

    </div>


    @else


    <div class="alert alert-info">Er zijn geen applicaties gevonden met de huidige zoekinstellingen.</div>


    @endif
</div>

@stop

@section('modals')

@include('modals/confirmation')

@stop