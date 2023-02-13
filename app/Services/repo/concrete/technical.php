<?php 


namespace App\Services\repo\concrete;

use App\Models\technical as ModelsTechnical;
use App\Services\repo\interfaces\technicalInterface;


class technical implements technicalInterface{


    public function store($name){



        return ModelsTechnical::create([


            "name"=>$name

        ]);
    }


    public function update($id,$name){


        $technical=ModelsTechnical::findOrFail($id);
        $technical->name=$name;
        $technical->save();
        return $technical;
        
    }
    public function getTechnical($id){


        return ModelsTechnical::findOrFail($id);
    }

    public function getAllTechnical(){


        return ModelsTechnical::all();
    }



    public function delete($id){


        $technical=ModelsTechnical::findOrFail($id);
        $technical1=$technical;
        $technical->delete();
        return $technical1;
        
    }

}