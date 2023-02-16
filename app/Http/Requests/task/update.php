<?php

namespace App\Http\Requests\task;

use App\Rules\checkDeletedImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class update extends FormRequest
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
            "id"=>"required|exists:tasks,id",
            "name"=>"required",
            "status"=>"required|in:0,1",
            "critial"=>"required|in:0,1,2,3,4",
            "deadline"=>"required",
            "description"=>"required",
            "technicals.*"=>"required|exists:technicals,id",
            "deleted_image.*"=>new checkDeletedImage(request()->get("id")),
            "image.*"=>"exists:temps,id"
        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        
        throw new HttpResponseException(

            response()->json(["data"=>[],"message"=>$validator->errors()->first()],401)

        );
        
            
                
    }

}
