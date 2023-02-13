<?php

namespace App\Http\Requests\admin;

use App\Models\admin;
use Illuminate\Foundation\Http\FormRequest;

class getadmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

     public $superadmin;
     public function __construct()
     {
         $this->superadmin=admin::first();
     }
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

            "id"=>"required|exists:admins,id|not_in:".$this->superadmin->id

        ];
    }
}
