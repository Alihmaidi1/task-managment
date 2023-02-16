<?php 


namespace App\Services\repo\concrete;

use App\Models\image as ModelsImage;
use App\Models\temp;
use App\Services\fileOperation\intervenationImage;
use App\Services\repo\interfaces\imageInterface;
use Image;
use File;

class image1 implements imageInterface{


    public $image;

    public function __construct(){


        $this->image=new intervenationImage($this);

    }
  
    public function saveInImage($url,$type,$image_id){

        return ModelsImage::create([

            "url"=>$url,
            "imageable_id"=>$image_id,
            "imageable_type"=>"App\\Models\\".$type

        ]);

    }


    

    

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
 
    public function deleteImage($images,$type){

        foreach($images as $image){

            $image=ModelsImage::findOrFail($image);
            unlink(public_path($type."/v1/".$image->getRawOriginal("url")));
            $image->delete();
        }


    }
 
    public function saveImages($images,$type,$id){

        foreach($images as $image){

            $url=$this->getTempFile($image)->getRawOriginal("url");
            $this->image->MoveFile($url,"temp",$type);
            $this->deleteTempFile($image);
            $this->saveInImage($url,$type,$id);

        }


    }
    

}