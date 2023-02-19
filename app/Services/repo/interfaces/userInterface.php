<?php

namespace App\Services\repo\interfaces;

interface userInterface{

    public function getUserByEmail($email);


    public function store($name,$email,$password,$gender,$url,$date_of_birth,$user_id);
    public function update($id,$name,$email,$password,$gender,$url,$date_of_birth,$user_id);

    // public function filter();
    public function getUser($id);


    public function getAllUser();

    public function delete($id);

}
