<?php

namespace App\Http\Controllers;

use App\Http\Requests\feature\delete;
use App\Http\Requests\feature\import;
use App\Http\Requests\feature\store;
use App\Http\Requests\feature\update;
use App\Http\Requests\task\adminfilter;
use App\Imports\featureImport;
use App\Models\feature as ModelsFeature;
use App\Services\repo\interfaces\featureInterface;
use App\Services\repo\interfaces\imageInterface;
use App\Services\repo\interfaces\userInterface;
use File;
use Maatwebsite\Excel\Facades\Excel;

class feature extends Controller
{


    public $feature;
    public $user;


    public $temp;
    public function __construct(featureInterface $feature,imageInterface $temp,userInterface $user){


        $this->feature=$feature;
        $this->user=$user;
        $this->temp=$temp;
    }


    public function store(store $request){

        try{

            $status=$request->status;
            $critial=$request->critial;
            $task_id=$request->task_id;
            $base_feature_id=$request->base_feature_id;
            $description=$request->description;
            $deadline=$request->deadline;
            $technicals=$request->technicals;
            $members=$request->members;
            $images=$request->images;
            $activity=$request->activity;


            $feature=$this->feature->store($status,$critial,0,$task_id,$base_feature_id,$description,$deadline,$activity);
            $feature->technicals()->sync($technicals);
            $feature->members()->sync($members);
            $this->temp->saveImages($images,"feature",$feature->id);
            $feature->technicals;
            $feature->members;
            return response()->json(["data"=>$feature],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function update(update $request){
        try{

            $id=$request->id;
            $status=$request->status;
            $critial=$request->critial;
            $task_id=$request->task_id;
            $base_feature_id=$request->base_feature_id;
            $description=$request->description;
            $deadline=$request->deadline;
            $activity=$request->activity;

            $members=$request->members;
            $images=$request->images;
            $technicals=$request->technicals;
            $deleted_images=$request->deleted_images;
            $feature=$this->feature->update($id,$status,$critial,$task_id,$base_feature_id,$description,$deadline,$activity);
            $feature->technicals()->sync($technicals);
            $feature->members()->sync($members);
            ($deleted_images)?$this->temp->deleteImage($deleted_images,"feature"):null;
            ($images)?$this->temp->saveImages($images,"feature",$feature->id):null;
            $feature->technicals;
            $feature->members;
            return response()->json(["data"=>$feature],200);




        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }

    }



    public function delete(delete $request){

        try{

            $feature=$this->feature->getFeature($request->id);
            File::deleteDirectory(public_path("feature/v1/".$feature->id));
            File::deleteDirectory(public_path("feature/v2/".$feature->id));
            File::deleteDirectory(public_path("feature/v3/".$feature->id));
            $feature->technicals()->delete();
            $feature->images()->delete();
            return response()->json([],200);




        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }

    }



    public function import(import $request){


        try{

            $file=$request->file("file");
            Excel::queueImport(new featureImport(),$file);



            return response()->json(["message"=>"the import is start ..."],200);




        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }



    }


    public function adminfeaturefilter(adminfilter $request){

        try{


            return response()->json(["data"=>$this->feature->getfilter()]);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }


    public function userfeaturefilter(adminfilter $request){


        try{

            // $features=User

            // return response()->json(["data"=>$features],200);
            return response()->json(["data"=>$this->user->getfilteredfeature()]);





        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);

        }


    }

}