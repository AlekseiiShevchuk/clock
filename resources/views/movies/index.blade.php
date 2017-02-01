@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $pageTitle }} <a href="{{ url('movies/create') }}" class="btn btn-success pull-right">Add new Movie</a></h1>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Path</th>
            <th>Answer</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->name }}</td>
                <td>{{ $movie->description }}</td>
                <td>{{ $movie->path }}</td>
                <td>{{ $movie->answer }}</td>
                <td>{{ $movie->levels->name }}</td>
                <td>
                    <a href="{{ action('MoviesController@edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ action('MoviesController@destroy', $movie->id) }}" method="POST" style="display: inline-block;">
                        {{ csrf_field() }}
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop