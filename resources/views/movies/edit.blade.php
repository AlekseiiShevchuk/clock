@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <form action="{{ action('MoviesController@update', $movie->id) }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $movie->name }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ $movie->description }}">
        </div>

        <div class="form-group">
            <label for="path">Upload file <sup class="text-danger">*</sup></label>
            <input type="file" class="form-control" name="path" id="path" value="{{ $movie->path }}">
        </div>

        <div class="form-group">
            <label for="answer">Answer <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="answer" id="answer" value="{{ $movie->answer }}">
        </div>

        <div class="form-group">
            <select class="form-control" name="level_id">
                @foreach($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" class="btn btn-success" value="Save">

    </form>

@stop