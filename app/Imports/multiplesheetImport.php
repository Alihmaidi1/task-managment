<?php

namespace App\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class multiplesheetImport implements WithMultipleSheets,ShouldQueue,WithChunkReading
{
    /**
    * @param Collection $collection
    */



    public function sheets(): array
    {
        return [


            "member"=>new memberImport(),
            "team"=>new teamImport(),
            "task"=>new taskImport()

        ];
    }



    public function chunkSize(): int
    {
        return 1;
    }

}