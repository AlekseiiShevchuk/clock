@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.abuses.title')</h3>
    @can('abus_create')
    <p>
        <a href="{{ route('abuses.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($abuses) > 0 ? 'datatable' : '' }} @can('abus_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('abus_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.abuses.fields.player-movie')</th>
                        <th>@lang('quickadmin.abuses.fields.description')</th>
                        <th>@lang('quickadmin.abuses.fields.by-player')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($abuses) > 0)
                        @foreach ($abuses as $abuse)
                            <tr data-entry-id="{{ $abuse->id }}">
                                @can('abus_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $abuse->player_movie->name or '' }}</td>
                                <td>{{ $abuse->description }}</td>
                                <td>{{ $abuse->by_player->device_id or '' }}</td>
                                <td>
                                    @can('abus_view')
                                    <a href="{{ route('abuses.show',[$abuse->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('abus_edit')
                                    <a href="{{ route('abuses.edit',[$abuse->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('abus_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['abuses.destroy', $abuse->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('abus_delete')
            window.route_mass_crud_entries_destroy = '{{ route('abuses.mass_destroy') }}';
        @endcan

    </script>
@endsection