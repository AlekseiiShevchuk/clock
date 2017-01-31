@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $level->name }}</h1>
    </div>

    <form action="{{ url('/level/store') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Name Level</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="{{ $level->name }}">
        </div>

        <div class="form-group">
            <label for="description">Name Level</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="{{ $level->description }}">
        </div>

        <input type="submit" class="btn btn-success" value="Save">

    </form>

@stop