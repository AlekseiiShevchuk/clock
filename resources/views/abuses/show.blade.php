@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.abuses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.abuses.fields.player-movie')</th>
                            <td>{{ $abuse->player_movie->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.abuses.fields.description')</th>
                            <td>{{ $abuse->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.abuses.fields.by-player')</th>
                            <td>{{ $abuse->by_player->device_id or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('abuses.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop