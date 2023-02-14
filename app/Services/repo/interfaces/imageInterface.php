<?php 

namespace App\Services\repo\interfaces;

interface imageInterface{


    public function getTempFile($id);


    public function store($url);

    public function deleteTempFile($id);



}