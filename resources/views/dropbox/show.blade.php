@extends('main')

@section('title', 'Dropbox page')

@section('sidebar')
        <!--can add sidebar section -->
@stop


@section('content')

    <div class="container-fluid">

        <p>Dropbox page!</p>


        <div class="col-xs-12">
            <div style="float: none;margin: 0 auto" class="col-xs-4">
                @if(count($file_name) > 0) <!--Display all image name -->
                    <form  class="form-horizontal" action="{{action('Dropbox\DropboxController@update')}}" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">File name</label>
                            <input type="hidden" class="form-control" value="{{$file_name->id}}" name="f_id" placeholder="New file name">

                            <input type="hidden" class="form-control" value="{{$file_name->file_type}}" name="f_type" placeholder="New file name">

                            <input type="text" class="form-control" value="{{$file_name->file_name}}" name="f_name"  placeholder="New file name">
                        </div>
                        <div class="form-group">
                            <div style="text-align: center" class="col-xs-12">
                                <input class="btn btn-default" type="submit" value="SUBMIT">
                            </div>
                        </div>
                        {!! csrf_field() !!}
                    </form>
                @endif

            </div>
        </div>




        <div class="col-xs-12">
            <div style="float: none;margin: 0 auto" class="col-xs-6">
                <!-- Display Validation Errors -->
                @include('common.errors')
                        <!--User information -->
                @if(Session::has('user-info'))
                    <div class="alert-box success">
                        <h2>{{ Session::get('user-info') }}</h2>
                    </div>
                    @endif
                            <!--End user information -->
            </div>
        </div>

    </div>
@stop
