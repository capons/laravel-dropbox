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
                <form enctype="multipart/form-data" class="form-horizontal" action="{{action('Dropbox\DropboxController@store')}}" method="post">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="row">
                                <input id="upfile" type="file" name="image">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div style="text-align: center" class="col-xs-12">
                            <input class="btn btn-default" type="submit" value="SUBMIT">
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>


        <div style="margin-top: 50px" class="col-xs-12">
            <div style="margin: 0 auto" class="col-xs-6">
                @if(count($image) > 0) <!--Display all image name -->
                <?php
                $count = 0;
                ?>
                <table class="table">
                    <tr>
                        <td>#</td>
                        <td>Fila name</td>
                        <td>Edit file</td>
                        <td>Delete file</td>
                    </tr>
                    @foreach($image as $row)
                        <?php
                        $count++;
                        ?>
                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td>
                                    <a href="{{ url('dropbox')}}/{{$row->id}}">{{$row->file_name}}</a>
                                </td>
                                <td>
                                    <a class="glyphicon glyphicon-pencil" href="{{ url('dropbox')}}/{{$row->id}}"></a>
                                </td>
                                <td>
                                    <form  class="form-horizontal" action="<?php echo Config::get('app.url'); ?>dropbox/{{$row->id}}" method="post">
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                        </table>
                @endif
            </div>
        </div>


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
@stop
