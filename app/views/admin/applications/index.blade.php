@section('content')


<div class="container">
    <div class="page-header">
        <h1>Applicaties</h1>
    </div>

    @if(count($apps))

    <div class="text-center">
        {{ $apps->links() }}
    </div>

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Applicatie</th>
            <th>Locatie</th>
            <th>Categorie</th>
            <th>Aangemaakt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($apps as $app)
        <tr>
            <td><?= $app->OrganisationName ?></td>
            <td><?= $app->Village ?></td>
            <td><?= $app->subcategory->CategoryDutch ?></td>
            <td><?= $app->created_at->format('d/m/Y') ?></td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">

        {{ $apps->links() }}

    </div>


    @else


    <div class="alert alert-info">Er zijn geen categorieën gevonden</div>


    @endif
</div>

@stop