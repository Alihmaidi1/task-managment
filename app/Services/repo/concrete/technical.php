<?php 


namespace App\Services\repo\concrete;

use App\Models\technical as ModelsTechnical;
use App\Services\repo\interfaces\technicalInterface;
use Illuminate\Support\Facades\Cache;

class technical implements technicalInterface{


    public function store($name){



        $technical=ModelsTechnical::create([


            "name"=>$name

        ]);
        Cache::pull("technicals");

        
    }


    public function update($id,$name){


        $technical=ModelsTechnical::findOrFail($id);
        $technical->name=$name;
        $technical->save();
        Cache::pull("technicals");
        Cache::pull("technical:".$id);
        return $technical;
        
    }
    public function getTechnical($id){


        return Cache::rememberForever("technical:".$id,function()use($id){

            return ModelsTechnical::with(["tasks","features"])->where("id",$id)->firstOrFail();

        });
    }

    public function getAllTechnical(){


        return Cache::rememberForever("technicals",function(){

            return ModelsTechnical::with(["tasks","features"])->get();
        });
    }



    public function delete($id){


        $technical=ModelsTechnical::findOrFail($id);
        $technical1=$technical;
        $technical->delete();
        return $technical1;
        
    }

}