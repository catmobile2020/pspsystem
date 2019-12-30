<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUsersRequest extends FormRequest
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
        $roles = [
            'name'=>'required',
            'type'=>'required',
            'email'=>'required|email',
            'product_id'=>'required|exists:products,id',
        ];

        if ($this->routeIs('marketing.update'))
        {
            $roles['email'] ='required|unique:company_users,email,'.$this->marketing->id;
            $roles['username'] ='required|unique:company_users,username,'.$this->marketing->id;
            if ($this->has('password') and $this->get('password') !== null)
            {
                $roles['password']='required|confirmed|min:6';
            }
        }else
        {
            $roles['email'] ='required|unique:company_users,email';
            $roles['username'] ='required|unique:company_users,username';
            $roles['password'] ='required|confirmed|min:6';
        }
        return $roles;
    }
}
