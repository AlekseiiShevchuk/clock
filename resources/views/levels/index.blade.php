@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.levels.title')</h3>
    @can('level_create')
    <p>
        <a href="{{ route('levels.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($levels) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('level_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.levels.fields.name')</th>
                        <th>@lang('quickadmin.levels.fields.description')</th>
                        <th>@lang('quickadmin.levels.fields.language')</th>
                        <th>Is movie list randomized?</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($levels) > 0)
                        @foreach ($levels as $level)
                            <tr data-entry-id="{{ $level->id }}">
                                @can('level_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $level->name }}</td>
                                <td>{{ $level->description }}</td>
                                <td>{{ $level->language->name or '' }}</td>
                                <td>{{ Form::checkbox("randomize_movies", 1, $level->randomize_movies == 1, ["disabled"]) }}</td>
                                <td>
                                    @can('level_view')
                                    <a href="{{ route('levels.show',[$level->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('level_edit')
                                    <a href="{{ route('levels.edit',[$level->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('level_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['levels.destroy', $level->id])) !!}
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
        @can('level_delete')
            window.route_mass_crud_entries_destroy = '{{ route('levels.mass_destroy') }}';
        @endcan

    </script>
@endsection