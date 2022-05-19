<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminProfileRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(
          response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
          ], 200)
        ); 
    }

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
            'email'       =>  'required|email|unique:users,email,'.\Request::get('id'),
            'username'   =>  'required|unique:users,username,'.\Request::get('id'),
            'confirm_password' =>  'same:password'
        ];
    }
}
