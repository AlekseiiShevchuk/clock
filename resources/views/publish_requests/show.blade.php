@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.publish-request.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.publish-request.fields.player-movie')</th>
                            <td>{{ $publish_request->player_movie->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.publish-request.fields.is-published')</th>
                            <td>{{ Form::checkbox("is_published", 1, $publish_request->is_published == 1, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('publish_requests.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop