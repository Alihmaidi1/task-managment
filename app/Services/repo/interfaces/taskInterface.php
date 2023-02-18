<?php


namespace App\Services\repo\interfaces;

interface taskInterface{



    public function store($name,$status,$critial,$deadline,$team_id,$description,$from,$activity);
    public function update($id,$name,$status,$critial,$deadline,$description,$activity);



    public function getTask($id);


    public function getAllTask();
}