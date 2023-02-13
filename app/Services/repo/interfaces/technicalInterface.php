<?php 

namespace App\Services\repo\interfaces;


interface technicalInterface{



    public function store($name);
    public function update($id,$name);


    public function getTechnical($id);

    public function getAllTechnical();


    public function delete($id);

}