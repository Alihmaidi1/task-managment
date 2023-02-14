<?php 

namespace App\Services\repo\interfaces;

interface baseFeatureInterface{



    public function store($name);
    public function update($id,$name);


    public function getAll();

    public function getOne($id);


    public function delete($id);
}