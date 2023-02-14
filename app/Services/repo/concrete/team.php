<?php 

namespace App\Services\repo\concrete;

use App\Models\team as ModelsTeam;
use App\Models\team_member;
use App\Services\repo\interfaces\teamInterface;


class team implements teamInterface{


    public function store($name,$members){

        $team=ModelsTeam::create([

            "name"=>$name
        ]);

        foreach($members as $member){

            team_member::create([
                "member_id"=>$member,
                "team_id"=>$team->id
            ]);


        }


        return $team;
        

    }


    public function update($id,$name,$members){

        $team=ModelsTeam::FindOrFail($id);
        $team->name=$name;
        $team->save();
        $team->members()->sync($members);
        return $team;
        
    }


    public function getAllTeam(){


        return ModelsTeam::all();


    }

    public function getTeam($id){


        return ModelsTeam::findOrFail($id);
    }



    public function delete($id){

        ModelsTeam::findOrFail($id)->delete();
        
    }

}