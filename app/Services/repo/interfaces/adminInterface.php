<?php 


namespace App\Services\repo\interfaces;


interface adminInterface{



    public function getUserByEmail($email);
    public function getAllAdmin();


    public function store($name,$email,$password,$role_id);


    public function update($id,$name,$email,$password,$role_id);


    public function delete($id);


}