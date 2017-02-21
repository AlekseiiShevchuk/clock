@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.playerMovieCollection.title')</h3>
    @can('playerMovieCollection_create')
    <p>
        <a href="{{ route('playermoviecollections.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($playerMovieCollections) > 0 ? 'datatable' : '' }} @can('playerMovieCollection_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('playerMovieCollection_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.playerMovieCollection.fields.player')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.language')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.name')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.description')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($playerMovieCollections) > 0)
                        @foreach ($playerMovieCollections as $playerMovieCollection)
                            <tr data-entry-id="{{ $playerMovieCollection->id }}">
                                @can('playerMovieCollection_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $playerMovieCollection->player->device_id or '' }}</td>
                                <td>{{ $playerMovieCollection->language->name or '' }}</td>
                                <td>{{ $playerMovieCollection->name }}</td>
                                <td>{{ $playerMovieCollection->description }}</td>
                                <td>
                                    @can('playerMovieCollection_view')
                                    <a href="{{ route('playermoviecollections.show',[$playerMovieCollection->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('playerMovieCollection_edit')
                                    <a href="{{ route('playermoviecollections.edit',[$playerMovieCollection->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('playerMovieCollection_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['playermoviecollections.destroy', $playerMovieCollection->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('playerMovieCollection_delete')
            window.route_mass_crud_entries_destroy = '{{ route('playermoviecollections.mass_destroy') }}';
        @endcan

    </script>
@endsection