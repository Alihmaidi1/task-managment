<?php

namespace App\Services\repo\concrete;

use App\Models\team as ModelsTeam;
use App\Models\team_member;
use App\Services\repo\interfaces\teamInterface;
use Illuminate\Support\Facades\Cache;

class team implements teamInterface{


    public function store($name,$members){

        $team=ModelsTeam::create([

            "name"=>$name
        ]);
        $team->members()->sync($members);
        Cache::pull("teams");


        return $team;


    }


    public function update($id,$name,$members){

        $team=ModelsTeam::FindOrFail($id);
        $team->name=$name;
        $team->save();
        $team->members()->sync($members);
        Cache::pull("teams");
        Cache::pull("team:".$team->id);
        return $team;

    }


    public function getAllTeam(){


        return Cache::rememberForever("teams",function(){

            return ModelsTeam::with(["tasks"])->get();
        });


    }

    public function getTeam($id){


        return Cache::rememberForever("team:".$id,function()use($id){

            return ModelsTeam::with(["tasks"])->where("id",$id)->firstOrFail();
        });
    }



    public function delete($id){

        ModelsTeam::findOrFail($id)->delete();
        Cache::pull("teams");
        Cache::pull("team:".$id);

    }

    public function findOrcreate($name){

        return ModelsTeam::firstOrCreate(["name"=>$name]);

    }

}