<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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


       public function rules()
    {
        
        return [
            // 'name' => 'required|max:191',
            'email' => 'required',
            'password' => 'required',
            // 'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:6900',

        ];
    }


    // public function messages()
    // {
    //     return [
    //         // 'name.required' => 'يرجي ادخال البلد',
    //         'time.date_format' => 'time format must be in H:i',
    //     ];
    // }


  protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 201,
            'errors' => $validator->errors()->all(),
        ])); 
    }
}
