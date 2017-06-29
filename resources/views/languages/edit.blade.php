@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.languages.title')</h3>
    
    {!! Form::model($language, ['method' => 'PUT', 'route' => ['languages.update', $language->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('abbreviation', 'Abbreviation*', ['class' => 'control-label']) !!}
                    {!! Form::text('abbreviation', old('abbreviation'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('abbreviation'))
                        <p class="help-block">
                            {{ $errors->first('abbreviation') }}
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
                    {!! Form::label('is_active_for_admin', 'Is active for admin*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_active_for_admin', 0) !!}
                    {!! Form::checkbox('is_active_for_admin', 1, old('is_active_for_admin')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_active_for_admin'))
                        <p class="help-block">
                            {{ $errors->first('is_active_for_admin') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_active_for_users', 'Is active for users*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_active_for_users', 0) !!}
                    {!! Form::checkbox('is_active_for_users', 1, old('is_active_for_users')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_active_for_users'))
                        <p class="help-block">
                            {{ $errors->first('is_active_for_users') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($language->flag_image)
                        <a href="{{ asset('uploads/'.$language->flag_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/'.$language->flag_image) }}"></a>
                    @endif
                    {!! Form::label('flag_image', 'Flag image', ['class' => 'control-label']) !!}
                    {!! Form::file('flag_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('flag_image_max_size', 16) !!}
                    {!! Form::hidden('flag_image_max_width', 8000) !!}
                    {!! Form::hidden('flag_image_max_height', 8000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('flag_image'))
                        <p class="help-block">
                            {{ $errors->first('flag_image') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

