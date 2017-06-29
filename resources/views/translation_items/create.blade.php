@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.translation-items.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['translation_items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value_name', 'Value name*', ['class' => 'control-label']) !!}
                    {!! Form::text('value_name', old('value_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value_name'))
                        <p class="help-block">
                            {{ $errors->first('value_name') }}
                        </p>
                    @endif
                </div>
            </div>
            @foreach($languages as $language)
            @php($value_name = 'value_' . $language->abbreviation)
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label($value_name, 'Value in '.$language->name.'*', ['class' => 'control-label']) !!}
                    {!! Form::text($value_name, old($value_name), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has($value_name))
                        <p class="help-block">
                            {{ $errors->first($value_name) }}
                        </p>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

