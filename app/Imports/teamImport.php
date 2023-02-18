<?php

namespace App\Imports;

use App\Models\team;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class teamImport implements ToModel,WithValidation,WithHeadingRow,SkipsOnFailure,SkipsOnError
{
    public function model(array $row)
    {

      try{

        $members=explode(",",$row["member_id"]);
        $users=User::select("id")->whereIn("user_id",$members)->get();
        if($users!=null&&count($members)==count($users)){
            $team=team::updateOrCreate(["name"=>$row["name"]],[]);
            $team->members()->sync($users);
        }


      }catch(\Exception $ex){


      }

    }
    public function rules():Array{

        return[

            "name"=>"required|string",
            "member_id"=>"required",
        ];
    }


    public function onError(\Throwable $e)
    {
    }
    public function onFailure(Failure ...$failures)
    {
    }



}
