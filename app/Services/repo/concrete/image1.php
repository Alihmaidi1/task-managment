<?php 


namespace App\Services\repo\concrete;

use App\Models\temp;
use App\Services\repo\interfaces\imageInterface;
use Image;
use File;

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


    public function resizeOne($image){


        $name=time().rand(100000,999999).".".$image->extension();
        $image=Image::make($image);
        $image->resize(200,300)->save(public_path("temp/v1/".$name),50);
        $image->resize(500,700)->save(public_path("temp/v2/".$name),70);
        $image->resize(1000,1200)->save(public_path("temp/v3/".$name),90);
        $temp=temp::create([
            "url"=>$name
        ]);

        return $temp->id;

    }


    public function getTempFile($id){


        return temp::findOrFail($id);
    }


    public function MoveFile($imageUrl,$from,$to){


        File::move(public_path($from."/v1/".$imageUrl), public_path($to."/v1/".$imageUrl));
        File::move(public_path($from."/v2/".$imageUrl), public_path($to."/v2/".$imageUrl));
        File::move(public_path($from."/v3/".$imageUrl), public_path($to."/v3/".$imageUrl));

    }


    public function deleteTempFile($id){

        $temp=temp::findOrFail($id);
        $temp1=$temp;
        $temp->delete();
        return $temp;
        
    }
    

}