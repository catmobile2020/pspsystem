<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $rules = [
            'name'=>'required',
            'description'=>'required',
            'url'=>'nullable|url',
            'address'=>'required',
        ];

        if ($this->routeIs('companies.store'))
        {
            $rules +=['photo' => 'required|image|max:20000'];
        }else
        {
            $rules +=['photo' => 'nullable|image|max:20000'];
        }
        return $rules;
    }
}
