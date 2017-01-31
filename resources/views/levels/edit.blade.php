@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $level->name }}</h1>
    </div>

    <form action="{{ action('LevelsController@update', $level->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Level Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $level->name }}">
        </div>

        <div class="form-group">
            <label for="description">Level Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $level->description }}">
        </div>

        <input type="submit" class="btn btn-success" value="Save">

    </form>

@stop