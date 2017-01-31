<?php

namespace App\Http\Controllers;

use Response;
//use Request;

use App\Movie;
use App\Level;

use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
//use App\Http\Controllers\Traits\FileUploadTrait;

class MoviesController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Movies',
//            'movies' => Movie::with('levels')->get()
            'movies' => Movie::all()
        ];

        return view('movies/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Add new Movie',
            'levels' => Level::all()
        ];

        return view('movies/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $this->saveFiles($request);
        $movies = Movie::create($request->all());
        return redirect()->action('MoviesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'pageTitle' => 'Edit Movie',
            'movie' => Movie::find($id),
            'levels' => Level::all()
        ];

        return view('movies/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return redirect()->action('MoviesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->action('MoviesController@index');
    }
}
