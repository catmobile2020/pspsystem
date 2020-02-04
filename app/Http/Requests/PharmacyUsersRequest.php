<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyUsersRequest extends FormRequest
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
        ];

        if ($this->routeIs('users.update'))
        {
            $roles['email'] ='required|email|unique:pharmacy_users,email,'.$this->user->id;
            $roles['username'] ='required|unique:pharmacy_users,username,'.$this->user->id;
            if ($this->has('password') and $this->get('password') !== null)
            {
                $roles['password']='required|confirmed|min:6';
            }
        }else
        {
            $roles['email'] ='required|email|unique:pharmacy_users,email';
            $roles['username'] ='required|unique:pharmacy_users,username';
            $roles['password'] ='required|confirmed|min:6';
        }
        return $roles;
    }
}
