<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\UpdateLanguagesRequest;
use App\Language;
use Illuminate\Support\Facades\Gate;

class LanguagesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Language.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('language_access')) {
            return abort(401);
        }
        $languages = Language::query()->orderBy('is_active_for_admin', 'desc')->get();

        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for editing Language.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('language_edit')) {
            return abort(401);
        }
        $language = Language::findOrFail($id);

        return view('languages.edit', compact('language'));
    }

    /**
     * Update Language in storage.
     *
     * @param  \App\Http\Requests\UpdateLanguagesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguagesRequest $request, $id)
    {
        if (!Gate::allows('language_edit')) {
            return abort(401);
        }
        $language = Language::findOrFail($id);
        $request = $this->saveFiles($request);
        $language->update($request->all());

        return redirect()->route('languages.index');
    }

}
