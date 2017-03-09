@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.playerMovie.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['playermovies.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('player_id', 'Player*', ['class' => 'control-label']) !!}
                    {!! Form::select('player_id', $players, old('player_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('player_id'))
                        <p class="help-block">
                            {{ $errors->first('player_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('language_id', 'Language*', ['class' => 'control-label']) !!}
                    {!! Form::select('language_id', $languages, old('language_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('language_id'))
                        <p class="help-block">
                            {{ $errors->first('language_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('collection_id', 'Collection*', ['class' => 'control-label']) !!}
                    {!! Form::select('collection_id', $collections, old('collection_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('collection_id'))
                        <p class="help-block">
                            {{ $errors->first('collection_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
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
                    {!! Form::label('answer', 'Answer*', ['class' => 'control-label']) !!}
                    {!! Form::text('answer', old('answer'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('answer'))
                        <p class="help-block">
                            {{ $errors->first('answer') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('movie_file', 'Movie file*', ['class' => 'control-label']) !!}
                    {!! Form::file('movie_file', ['class' => 'form-control']) !!}
                    {!! Form::hidden('movie_file_max_size', 512) !!}
                    <p class="help-block"></p>
                    @if($errors->has('movie_file'))
                        <p class="help-block">
                            {{ $errors->first('movie_file') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

