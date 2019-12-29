<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'paid_num'=>'required|numeric',
            'free_num'=>'required|numeric',
            'company_id'=>'required|exists:companies,id',
            'program_id'=>'required|exists:programs,id',
        ];
        if ($this->routeIs('products.store'))
        {
            $rules +=['photo' => 'required|image|max:20000'];
        }else
        {
            $rules +=['photo' => 'nullable|image|max:20000'];
        }

        return $rules;
    }
}
