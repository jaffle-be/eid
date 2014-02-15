@section('content')


<div class="container">

    <div class="page-header">
        <h3>Applicatie aanpassen</h3>
    </div>

    <?= Form::model($application, array('route' => array('admin.applications.update', $application->id), 'method' => 'PUT')) ?>

    @include('admin/applications/form')

    <?= Form::close() ?>

</div>

@stop