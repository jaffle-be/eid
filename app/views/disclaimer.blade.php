@section('styles')
<link rel="stylesheet" href="/css/disclaimer.min.css"/>
@stop

@section('content')

<div class="container disclaimer">
    {{ Lang::get('disclaimer.text') }}
</div>

@stop