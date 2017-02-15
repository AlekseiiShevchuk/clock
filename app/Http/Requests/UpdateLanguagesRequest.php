<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguagesRequest extends FormRequest
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
            
            'abbreviation' => 'required|unique:languages,abbreviation,'.$this->route('language'),
            'name' => 'required|unique:languages,name,'.$this->route('language'),
            'is_active_for_admin' => 'required',
            'is_active_for_users' => 'required',
        ];
    }
}
