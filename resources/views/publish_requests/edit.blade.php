@extends('layouts.app')

@section('content')
    <h3 class="page-title">Publish player movie to public movies</h3>
    
    {!! Form::model($publish_request, ['method' => 'PUT', 'route' => ['publish_requests.update', $publish_request->id]]) !!}

    <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('level_id', 'Select Level when you want to publish this movie', ['class' => 'control-label']) !!}
                    {!! Form::select('level_id', $levels, old('level_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('player_movie_id'))
                        <p class="help-block">
                            {{ $errors->first('level_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit('Publish', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

