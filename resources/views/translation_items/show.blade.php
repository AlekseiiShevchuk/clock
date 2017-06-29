@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.translation-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.translation-items.fields.value-name')</th>
                            <td>{{ $translation_item->value_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.translation-items.fields.value-en')</th>
                            <td>{{ $translation_item->value_en }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('translation_items.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop