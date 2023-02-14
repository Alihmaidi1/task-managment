<?php 

namespace App\Services\repo\interfaces;

interface teamInterface{



    public function store($name,$members);
    public function update($id,$name,$members);


    public function getAllTeam();


    
    public function getTeam($id);


    public function delete($id);


}