<?php

namespace App\Imports;

use App\Models\task;
use App\Models\technicalable;
use App\Models\User;
use App\Models\feature;
use App\Models\technical;
use App\Models\base_feature;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class featureImport implements ToModel,WithValidation,WithHeadingRow,SkipsOnFailure,SkipsOnError,WithChunkReading,ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function model($row)
    {

        // try{

        $technicals=$row["technicals"];
        $technicals=explode(",",$technicals);
        $arr=[];
        foreach($technicals as $technical){

            $arr[]=technical::firstOrCreate(['name'=>$technical])->id;

        }
        $members=explode(",",$row["member_id"]);
        $members=User::select("id")->whereIn("user_id",$members)->get();
        $members=($members!=null)?$members->toArray():[];
        $task=task::where("name",$row["task_name"])->first();
        $base_feature=base_feature::firstOrCreate(["name"=>$row["name"]]);
        $feature=feature::create([

            "activity"=>$row["activity"],
            "status"=>$row["status"],
            "critial"=>$row["critial"],
            "process"=>$row["process"],
            "deadline"=>Date::excelToDateTimeObject($row["deadline"]),
            "description"=>$row["description"],
            "from"=>1,
            "task_id"=>$task->id,
            "base_feature_id"=>$base_feature->id


        ]);

        $feature->members()->sync($members);

        foreach($arr as $technical){



            $technical1=new technicalable();
            $technical1->technical_id=$technical;
            $technical1->technicalable_id=$feature->id;
            $technical1->technicalable_type="App\\Models\\task";
            $technical1->save();

        }



        // }catch(\Exception $ex){


        // }



    }

    public function rules():Array{

        return[

            "name"=>"required|string",
            "technicals"=>"required",
            "activity"=>"required|in:0,1,2,3",
            "member_id"=>"required",
            "deadline"=>"required",
            "status"=>"required|in:0,1,2",
            "critial"=>"required|in:0,1,2,3,4",
            "task_name"=>"required|exists:tasks,name",
            "description"=>"required",
            "process"=>"required|integer",



        ];


    }

    public function onError(\Throwable $e)
    {
    }
    public function onFailure(Failure ...$failures)
    {
    }


    public function chunkSize(): int
    {
        return 1;
    }



}