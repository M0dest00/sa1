<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:191',
            'email' => 'required|max:191|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'address' => 'required',
            'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
        ];
    }


    // public function messages()
    // {
    //     return [
    //         // 'name.required' => 'يرجي ادخال البلد',
    //         'time.date_format' => 'time format must be in H:i',
    //     ];
    // }


  public function response(array $errors)
    {
       response()->json([
        'code' => 201,
        'errors' => $errors,
      ]);

    }
}
