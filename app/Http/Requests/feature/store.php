<?php

namespace App\Http\Requests\feature;

use App\Rules\checkMemberTask;
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

            "status"=>"required|in:0,1",
            "critial"=>"required|in:0,1,2,3,4",
            "task_id"=>"required|exists:tasks,id",
            "base_feature_id"=>"required|exists:base_features,id",
            "description"=>"required",
            "deadline"=>"required",
            "images"=>"required|array",
            "images.*"=>"exists:temps,id",
            "members"=>"array",
            "members.*"=>new checkMemberTask(request()->get("task_id")),
            "technicals"=>"required|array",
            "technicals.*"=>"exists:technicals,id"


        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        
        throw new HttpResponseException(

            response()->json(["data"=>[],"message"=>$validator->errors()->first()],401)

        );
        
        
                        
    }

}
