<?php 

namespace App\Services\repo\interfaces;

interface imageInterface{


    public function getTempFile($id);


    public function store($url);

    public function deleteTempFile($id);


    public function saveInImage($url,$type,$image_id);

    public function saveImages($images,$type,$id);

    public function deleteImage($images,$type);

}