<?php 

namespace App\Services\repo\interfaces;

interface roleInterface{



    public function store($name,$permissions);

    public function update($id,$name,$permissions);


    public function getRole($id);


    public function delete($id);



    public function getAllRole();


}