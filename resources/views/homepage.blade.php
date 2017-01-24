@extends('layout')


@section('content')
    <div class="col-md-12">
        <tasks></tasks>
    </div>

    @include('partials/tasks')
@stop

@section('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.7/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.17/vue-resource.js"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');
    </script>
    <script src="js/tasks.js"></script>
@stop