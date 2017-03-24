<?php

namespace App\Http\Controllers\Api\V1;

use App\Abuse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbusesRequest;
use App\Http\Requests\UpdateAbusesRequest;

class AbusesController extends Controller
{
    public function index()
    {
        return Abuse::all();
    }

    public function show($id)
    {
        return Abuse::findOrFail($id);
    }

    public function update(UpdateAbusesRequest $request, $id)
    {
        $abuse = Abuse::findOrFail($id);
        $abuse->update($request->all());

        return $abuse;
    }

    public function store(StoreAbusesRequest $request)
    {
        $abuse = Abuse::create($request->all());

        return $abuse;
    }

    public function destroy($id)
    {
        $abuse = Abuse::findOrFail($id);
        $abuse->delete();
        return response()->json('',204);
    }
}
