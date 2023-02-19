<?php

namespace App\Services\repo\concrete;

use App\Models\comment as ModelsComment;
use App\Services\repo\interfaces\commentInterface;

class comment implements commentInterface{

    public function store($content,$from_id,$from_type,$for_id,$for_type){


        return ModelsComment::create([

            "content"=>$content,
            "fromable_id"=>$from_id,
            "fromable_type"=>$from_type,
            "forable_id"=>$for_id,
            "forable_type"=>$for_type,


        ]);


    }


}