<?php

namespace App\Http\Controllers\Api\V1;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\UpdateLanguagesRequest;

class LanguagesController extends Controller
{
    public function index()
    {
        return Language::where('is_active_for_users',1)->get()->sortByDesc('number_of_movies')->values()->all();
    }
}
