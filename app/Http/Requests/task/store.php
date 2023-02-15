<?php

namespace App\Http\Requests\task;

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
            "status"=>"required|in:0,1",
            "critial"=>"required|in:0,1,2,3,4",
            "deadline"=>"required|date",
            "team_id"=>"required|exists:teams,id",
            "description"=>"required",
            "technicals"=>"array|required",
            "technicals.*"=>"required|exists:technicals,id",
            "images"=>"array|required",
            "images.*"=>"required|exists:temps,id"

            


        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        
        throw new HttpResponseException(

            response()->json(["data"=>[],"message"=>$validator->errors()->first()],401)

        );
        
        
                
    }

}
