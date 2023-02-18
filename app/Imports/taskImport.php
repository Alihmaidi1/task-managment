<?php

namespace App\Imports;

use App\Models\task;
use App\Models\team;
use App\Models\technical;
use App\Models\technicalable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class taskImport implements ToModel,WithValidation,WithHeadingRow,SkipsOnFailure,SkipsOnError
{
    /**
    * @param Collection $collection
    */
    public function model($row)
    {

        try{


            $technicals=$row["technicals"];
            $technicals=explode(",",$technicals);
            $arr=[];
            foreach($technicals as $technical){


                $arr[]=technical::firstOrCreate(['name'=>$technical])->id;

            }

            $team=team::firstOrCreate(["name"=>$row["name"]]);
            $task=task::updateOrCreate(["team_id"=>$team->id,"name"=>$row["name"]],

                [
                    "status"=>$row["status"],
                    "critial"=>$row["critial"],
                    "deadline"=>Date::excelToDateTimeObject($row["deadline"]),
                    "process"=>$row["process"],
                    "activity"=>$row["activity"],
                    "description"=>$row["description"],
                    "from"=>1
                ]

            );

            foreach($arr as $technical){


                $technical1=new technicalable();
                $technical1->technical_id=$technical;
                $technical1->technicalable_id=$task->id;
                $technical1->technicalable_type="App\\Models\\task";
                $technical1->save();

            }


        }catch(\Exception $ex){


        }



    }

    public function rules():Array{

        return[

            "name"=>"required|string",
            "status"=>"required|in:0,1,2",
            "critial"=>"required|in:0,1,2,3,4",
            "process"=>"required|integer",
            "deadline"=>"required",
            "description"=>"required",
            "technicals"=>"required",
            "team_name"=>"required",
            "activity"=>"required|in:0,1,2,3"
        ];


    }

    public function onError(\Throwable $e)
    {
    }
    public function onFailure(Failure ...$failures)
    {
    }

}