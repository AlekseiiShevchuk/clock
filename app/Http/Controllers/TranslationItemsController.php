<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslationItemsRequest;
use App\Http\Requests\UpdateTranslationItemsRequest;
use App\Language;
use App\TranslationItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class TranslationItemsController extends Controller
{
    /**
     * Display a listing of TranslationItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('translation_item_access')) {
            return abort(401);
        }

        $translation_items = TranslationItem::orderBy('value_name')->get();
        $languages = Language::where('is_active_for_admin', 1)->get();

        return view('translation_items.index', compact('translation_items', 'languages'));
    }

    public function massUpdate(Request $request)
    {
        $translationItems = TranslationItem::all();
        $currentContentBlockData = [];
        foreach ($request->input('content_blocks', []) as $index => $data) {
            if (is_integer($index)) {
                TranslationItem::create($data);
            } else {
                $id = explode('-', $index)[1];
                $currentContentBlockData[$id] = $data;
            }
        }
        foreach ($translationItems as $item) {
            if (isset($currentContentBlockData[$item->id])) {
                $item->update($currentContentBlockData[$item->id]);
            } else {
                $item->delete();
            }
        }
        return redirect()->route('translation_items.index');
    }

    /**
     * Show the form for creating new TranslationItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('translation_item_create')) {
            return abort(401);
        }
        $languages = Language::where('is_active_for_admin', 1)->get();
        return view('translation_items.create', compact('languages'));
    }

    /**
     * Store a newly created TranslationItem in storage.
     *
     * @param  \App\Http\Requests\StoreTranslationItemsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranslationItemsRequest $request)
    {
        if (!Gate::allows('translation_item_create')) {
            return abort(401);
        }
        $translation_item = TranslationItem::create($request->all());


        return redirect()->route('translation_items.index');
    }


    /**
     * Show the form for editing TranslationItem.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('translation_item_edit')) {
            return abort(401);
        }
        $translation_item = TranslationItem::findOrFail($id);
        $languages = Language::where('is_active_for_admin', 1)->get();

        return view('translation_items.edit', compact('translation_item', 'languages'));
    }

    /**
     * Update TranslationItem in storage.
     *
     * @param  \App\Http\Requests\UpdateTranslationItemsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranslationItemsRequest $request, $id)
    {
        if (!Gate::allows('translation_item_edit')) {
            return abort(401);
        }
        $translation_item = TranslationItem::findOrFail($id);
        $translation_item->update($request->all());


        return redirect()->route('translation_items.index');
    }


    /**
     * Display TranslationItem.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('translation_item_view')) {
            return abort(401);
        }
        $translation_item = TranslationItem::findOrFail($id);

        return view('translation_items.show', compact('translation_item'));
    }


    /**
     * Remove TranslationItem from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('translation_item_delete')) {
            return abort(401);
        }
        $translation_item = TranslationItem::findOrFail($id);
        $translation_item->delete();

        return redirect()->route('translation_items.index');
    }

    /**
     * Delete all selected TranslationItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('translation_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TranslationItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function importExcel()
    {
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            try {
                foreach ($data as $item) {
                    $translation = TranslationItem::firstOrNew(['value_name' => $item->value_name], $item->toArray());
                    $translation->update($item->toArray());
                    $translation->save();
                }

            } catch (Exception $e) {
                flash('Bad file content! You have to fill all "value_name" and "value_en" fields values')->error();
                return redirect()->route('translation_items.index');
            }

        }
        flash('File was successfully imported')->success();
        return redirect()->route('translation_items.index');
    }

    public function exportExcel($type)
    {
        $data = TranslationItem::orderBy('value_name')->get(\App\Language::getAvailableColumnsForTranslationItems())->toArray();

        return Excel::create('Clock_translations', function ($excel) use ($data) {
            $excel->sheet('main', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

}
