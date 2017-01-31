@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <form action="{{ url('/movie/store') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
        </div>

        <div class="form-group">
            <label for="path">Upload file <sup class="text-danger">*</sup></label>
            <input type="file" class="form-control" name="path" id="path" placeholder="Path">
        </div>

        <div class="form-group">
            <label for="answer">Answer <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer">
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