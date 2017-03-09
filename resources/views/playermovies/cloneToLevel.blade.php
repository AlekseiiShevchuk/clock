@extends('layouts.app')

@section('content')
    <h3 class="page-title">Select Level when you want to add <strong>{{$playerMovie->name}}</strong> Player movie</h3>
    
    {!! Form::open(['method' => 'POST', 'route' => ['playermovies.clone-to-level', $playerMovie->id], 'files' => true,]) !!}

    <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('level_id', 'Levels*', ['class' => 'control-label']) !!}
                    {!! Form::select('level_id', $levels, old('level_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('player_id'))
                        <p class="help-block">
                            {{ $errors->first('player_id') }}
                        </p>
                    @endif
                </div>
            </div>

            
        </div>
    </div>

    {!! Form::submit('Add '. $playerMovie->name . ' to selected Level', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

