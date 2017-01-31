@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $pageTitle }}</h1>
    </div>

    <form action="{{ url('/level/store') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Level Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="description">Level Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
        </div>

        <input type="submit" class="btn btn-success" value="Save">

    </form>

@stop