<?php

namespace App\Imports;

use App\Services\repo\interfaces\taskInterface;
use App\Services\repo\interfaces\teamInterface;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class taskImport implements ToCollection,WithValidation,WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    public $team;
    public $task;


    public function __construct(teamInterface $team,taskInterface $task){


        $this->team=$team;
        $this->task=$task;


    }

    public function collection(Collection $rows)
    {

        foreach($rows as $row){

            $team=$this->team->findOrcreate($row["team_name"]);
            $task=$this->task->store($row["name"],$row["status"],$row["critial"],$row["deadline"],$team->id,$row["description"],"Excel");







        }



    }


    public function rules():Array
    {

        return [

            "name"=>"required",
            "status"=>"required|in:0,1,2",
            "critial"=>"required|in:0,1,2,3,4",
            "process"=>"required|integer",
            "deadline"=>"required|date",
            "description"=>"required",
            "technicals"=>"required",
            "team_name"=>"required"

        ];


    }


}
