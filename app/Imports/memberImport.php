<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class memberImport implements ToModel,WithValidation,WithHeadingRow,SkipsOnFailure
{
    /**
    * @param Collection $collection
    */
    use SkipsErrors;
    public function model($row)
    {

        try{


            User::updateOrCreate(["email"=>$row["email"]],
            [
                "name"=>$row["name"],
                "password"=>Hash::make($row["password"]),
                "gender"=>$row["gender"],
                "user_id"=>$row["id"],
                "date_of_birth"=>Date::excelToDateTimeObject($row["date_of_birth"])

            ]);


        }catch(\Exception $ex){



        }



    }



    public function rules():Array{

        return[

            "name"=>"required|string",
            "date_of_birth"=>"required",
            "id"=>"required",
            "gender"=>"required|in:0,1",
            "email"=>"required"



        ];
    }


    public function onError(\Throwable $e)
    {



    }
    public function onFailure(Failure ...$failures)
    {
    }

}
