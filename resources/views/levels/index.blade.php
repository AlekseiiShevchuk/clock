@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{ $pageTitle }} <a href="{{ url('levels/create') }}" class="btn btn-success pull-right">Add new Level</a></h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($levels as $level)
                <tr>
                    <td>{{ $level->name }}</td>
                    <td>{{ $level->description }}</td>
                    <td>
                        <a href="{{ action('LevelsController@edit', $level->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ action('LevelsController@destroy', $level->id) }}" method="POST" style="display: inline-block;">
                            {{ csrf_field() }}
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop