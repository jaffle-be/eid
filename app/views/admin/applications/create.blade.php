@section('content')

<div class="container">

    <div class="page-header">
        <h3>Nieuwe applicatie aanmaken</h3>
    </div>

    <?= Form::model($application, array('route' => 'admin.applications.store')) ?>

    @include('admin.applications.form')

    <?= Form::close() ?>

</div>

@stop