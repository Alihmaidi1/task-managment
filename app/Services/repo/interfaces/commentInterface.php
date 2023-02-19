<?php

namespace App\Services\repo\interfaces;

interface commentInterface{



    public function store($content,$from_id,$from_type,$for_id,$for_type);


}
