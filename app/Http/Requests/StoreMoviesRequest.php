<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMoviesRequest extends FormRequest
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
            'name' => 'required',
            'movie_file' => 'required|max:' . env('MAX_SIZE_UPLOAD_VIDEO'),
            'answer' => 'required',
            'level_id' => 'required',
            'language_id' => 'required',
        ];
    }
}
