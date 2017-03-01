@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.publish-request.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['publish_requests.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('player_movie_id', 'Player movie*', ['class' => 'control-label']) !!}
                    {!! Form::select('player_movie_id', $player_movies, old('player_movie_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('player_movie_id'))
                        <p class="help-block">
                            {{ $errors->first('player_movie_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

