<?php

namespace App\Http\Controllers;

use App\Http\Requests\images\upload;
use App\Http\Requests\images\uploadone;
use App\Services\repo\interfaces\imageInterface;
use Illuminate\Http\Request;

class image extends Controller
{


    public $image;
    public function __construct(imageInterface $image){

        $this->image=$image;

    }



    public function upload(upload $request){

        try{

            $images=$request->images;
            $images=$this->image->resize($images);
            return response()->json(["data"=>$images],200);

        

        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }



    }



    public function uploadone(uploadone $request){
        
        
        try{



            $images=$request->file("image");
            $images=$this->image->resizeOne($images);
            return response()->json(["data"=>$images],200);



        }catch(\Exception $ex){

            return response()->json(["message"=>$ex->getMessage()],500);

        }





    }





}
