<?php 


namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Services\repo\interfaces\imageInterface;
use Image;

class image1 implements imageInterface{


    public function resize($images){


        $arr=[];
        foreach($images as $image){


            $name=time().rand(100000,999999).".".$image->extension();
            $image=Image::make($image);
            $image->resize(200,300)->save(public_path("temp/v1/".$name),50);
            $image->resize(500,700)->save(public_path("temp/v2/".$name),70);
            $image->resize(1000,1200)->save(public_path("temp/v3/".$name),90);
            $temp=temp::create([
                "url"=>$name
            ]);
            $arr[]=$temp->id;


        }


        return $arr;


    }

}