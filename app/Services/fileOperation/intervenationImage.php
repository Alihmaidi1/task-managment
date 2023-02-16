<?php 

namespace App\Services\fileOperation;

use App\Services\repo\interfaces\imageInterface as imageRepoInterface ;
use Image;
use File;

class intervenationImage implements imageInterface{


    public $image;
    public function __construct(imageRepoInterface $image){

        $this->image=$image;
    }


    
    public function resize($images){

        $arr=[];
        foreach($images as $image){

            $arr[]=$this->resizeOne($image);

        }


        return $arr;


    }


    public function resizeOne($image){


        $name=time().rand(100000,999999).".".$image->extension();
        $image=Image::make($image);
        $image->resize(200,300)->save(public_path("temp/v1/".$name),50);
        $image->resize(500,700)->save(public_path("temp/v2/".$name),70);
        $image->resize(1000,1200)->save(public_path("temp/v3/".$name),90);
        $temp=$this->image->store($name);

        return $temp;

    }



    public function MoveFile($imageUrl,$from,$to){


        File::move(public_path($from."/v1/".$imageUrl), public_path($to."/v1/".$imageUrl));
        File::move(public_path($from."/v2/".$imageUrl), public_path($to."/v2/".$imageUrl));
        File::move(public_path($from."/v3/".$imageUrl), public_path($to."/v3/".$imageUrl));

    }



}