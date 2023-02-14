<?php 

namespace App\Services\repo\interfaces;

interface userInterface{

    public function getUserByEmail($email);


    public function store($name,$email,$password,$gender,$image_id,$date_of_birth);


}