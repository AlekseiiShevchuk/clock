@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.abuses.title')</h3>
    
    {!! Form::model($abuse, ['method' => 'PUT', 'route' => ['abuses.update', $abuse->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('by_player_id', 'By player', ['class' => 'control-label']) !!}
                    {!! Form::select('by_player_id', $by_players, old('by_player_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('by_player_id'))
                        <p class="help-block">
                            {{ $errors->first('by_player_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

