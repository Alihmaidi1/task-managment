<?php 


namespace App\Services\repo\interfaces;

interface taskInterface{



    public function store($name,$status,$critial,$deadline,$team_id,$description,$from);
    public function update($id,$name,$status,$critial,$deadline,$description);


 
    public function getTask($id);


    public function getAllTask();
}