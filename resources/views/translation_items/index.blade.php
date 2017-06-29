@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Translation Items
        </div>

            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="/excel-import" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>
        <br>
            <a href="/excel-export/xls" target="_blank">Download Excel xls</a> |
            <a href="/excel-export/xlsx" target="_blank">Download Excel xlsx</a>
            {{--<a href="/api/excel-export/csv" target="_blank">Download CSV</a>--}}
        @include('flash::message')
    {!! Form::open(['method' => 'PUT', 'action' => 'TranslationItemsController@massUpdate']) !!}
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Value name</th>
                    @foreach($languages as $language)
                        <th>Value in {{$language->name}}</th>
                    @endforeach

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="content-blocks">
                @forelse(old('content_blocks', []) as $index => $data)
                    @include('translation_items.item_row', [
                        'index' => $index
                    ])
                @empty
                    @foreach($translation_items as $item)
                        @include('translation_items.item_row_for_edit', [
                            'index' => 'id-' . $item->id,
                            'field' => $item
                        ])
                    @endforeach
                @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.add_new')</a>
        </div>
    </div>
    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="content-blocks-template">
        @include('translation_items.item_row', [
            'index' => '_INDEX_'
        ])
    </script>

    <script>
        $(document).ready(function () {
            $('.add-new').click(function () {
                var tableBody = $(this).parent().find('tbody');
                var template = $('#' + tableBody.attr('id') + '-template').html();
                var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
                if (isNaN(lastIndex)) {
                    lastIndex = 0;
                }
                tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
                return false;
            });
            $(document).on('click', '.remove', function () {
                var row = $(this).parentsUntil('tr').parent();
                row.remove();
                return false;
            });
        });
    </script>
@stop