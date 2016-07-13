@extends('main')

@section('title', 'Page by default')

@section('sidebar')
        <!--can add sidebar section -->
@stop


@section('content')



   <p>Default page!</p>


    <!-- Display Validation Errors -->
    @include('common.errors')
            <!--User information -->
    @if(Session::has('user-info'))
        <div class="alert-box success">
            <h2>{{ Session::get('user-info') }}</h2>
        </div>
    @endif
                <!--End user information -->
@stop
