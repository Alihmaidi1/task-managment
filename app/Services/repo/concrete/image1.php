<?php 


namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Services\repo\interfaces\imageInterface;
use Image;
use File;

class image1 implements imageInterface{


    

    

    public function getTempFile($id){


        return temp::findOrFail($id);
    }




    public function deleteTempFile($id){

        $temp=temp::findOrFail($id);
        $temp1=$temp;
        $temp->delete();
        return $temp;
        
    }
 
    public function store($url){

        return temp::create([

            "url"=>$url
        ]);
    }
    

}