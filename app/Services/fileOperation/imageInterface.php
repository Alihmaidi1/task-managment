<?php 


namespace App\Services\fileOperation;

interface imageInterface{


    public function resize($images);
    public function resizeOne($image);

    public function MoveFile($imageUrl,$from,$to);


}