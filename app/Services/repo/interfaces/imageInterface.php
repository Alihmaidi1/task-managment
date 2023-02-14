<?php 

namespace App\Services\repo\interfaces;

interface imageInterface{


    public function resize($images);
    public function resizeOne($image);


    public function getTempFile($id);


    public function MoveFile($imageUrl,$from,$to);


    public function deleteTempFile($id);



}