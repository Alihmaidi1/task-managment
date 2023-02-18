<?php

namespace App\Http\Requests\member;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class store extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            "name"=>"required",
            "email"=>"required|email|unique:users,email",
            "password"=>"required",
            "gender"=>"required|in:1,0",
            "image_id"=>"required|exists:temps,id",
            "date_of_birth"=>"required|date",
            "user_id"=>"required|unique:users,user_id"

        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){

        throw new HttpResponseException(

            response()->json(["data"=>[],"message"=>$validator->errors()->first()],401)

        );



    }


}
