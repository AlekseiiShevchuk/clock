<?php

namespace App\Http\Controllers\Api\V1;

use App\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMoviesRequest;
use App\Http\Requests\UpdateMoviesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class MoviesController extends Controller
{
   /* use FileUploadTrait;

    public function index()
    {
        return Movie::all();
    }

    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    public function update(UpdateMoviesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return $movie;
    }

    public function store(StoreMoviesRequest $request)
    {
        $request = $this->saveFiles($request);
        $movie = Movie::create($request->all());

        return $movie;
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return '';
    }
   */
}
