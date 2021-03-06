<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerMoviesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'player_id' => 'required',
            'language_id' => 'required',
            'collection_id' => 'required',
            'name' => 'required',
            'answer' => 'required',
            'movie_file' => 'required|max:' . env('MAX_SIZE_UPLOAD_VIDEO'),
            
        ];
    }
}
