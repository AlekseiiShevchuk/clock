<?php
namespace App\Http\Requests;

use App\PlayerMovie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApiUpdatePlayerMoviesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $playerMovie = PlayerMovie::findOrFail($this->route()->parameters()['player_movie']);
        if ($playerMovie->player_id == Auth::user()->id){
        return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
