@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.publish-request.title')</h3>
    @can('publish_request_create')
        <p>
            <a href="{{ route('publish_requests.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
        </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($publish_requests) > 0 ? 'datatable' : '' }} @can('publish_request_delete') dt-select @endcan">
                <thead>
                <tr>
                    @can('publish_request_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>
                    @endcan

                    <th>@lang('quickadmin.publish-request.fields.player-movie')</th>
                    <th>Movie file</th>
                    <th>@lang('quickadmin.publish-request.fields.is-published')</th>
                    <th>created at</th>
                    <th>updated at</th>
                    <th>Published to</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($publish_requests) > 0)
                    @foreach ($publish_requests as $publish_request)
                        <tr data-entry-id="{{ $publish_request->id }}">
                            @can('publish_request_delete')
                                <td></td>
                            @endcan

                            <td>{{ $publish_request->player_movie->name or '' }}</td>
                            <td>
                                <a href="{{asset('uploads/'.$publish_request->player_movie->movie_file)}}">{{$publish_request->player_movie->movie_file}}</a>
                            </td>
                            <td>
                                @if($publish_request->is_published == 1)
                                    Published
                                @endif
                                @if($publish_request->is_published == 0)
                                    Wait for publishing
                                @endif
                            </td>
                            <td>{{ $publish_request->created_at or '' }}</td>
                            <td>{{ $publish_request->updated_at or '' }}</td>
                            <td>
                                @if($publish_request->published_to instanceof \App\Movie)
                                    <a href="{{route('movies.show',['id' =>$publish_request->published_to->id])}}">{{$publish_request->published_to->name}}</a>
                                @else
                                    Wait for publishing
                                @endif
                            </td>
                            <td>
                                @if($publish_request->is_published == 0)
                                    <a href="{{ route('publish_requests.edit',[$publish_request->id]) }}"
                                       class="btn btn-xs btn-info">publish</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('publish_request_delete')
            window.route_mass_crud_entries_destroy = '{{ route('publish_requests.mass_destroy') }}';
        @endcan

    </script>
@endsection