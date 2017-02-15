@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.movies.title')</h3>
    
    {!! Form::model($movie, ['method' => 'PUT', 'route' => ['movies.update', $movie->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
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
                    {!! Form::label('movie_file', 'Movie file', ['class' => 'control-label']) !!}
                    @if ($movie->movie_file)
                        <a href="{{ asset('uploads/'.$movie->movie_file) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('movie_file', ['class' => 'form-control']) !!}
                    {!! Form::hidden('movie_file_max_size', 1024) !!}
                    <p class="help-block"></p>
                    @if($errors->has('movie_file'))
                        <p class="help-block">
                            {{ $errors->first('movie_file') }}
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
                    {!! Form::label('level_id', 'Level*', ['class' => 'control-label']) !!}
                    {!! Form::select('level_id', $levels, old('level_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('level_id'))
                        <p class="help-block">
                            {{ $errors->first('level_id') }}
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
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

