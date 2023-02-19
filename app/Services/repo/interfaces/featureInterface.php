<?php

namespace App\Services\repo\interfaces;

interface featureInterface{



    public function store($status,$critial,$from,$task_id,$base_feature_id,$description,$deadline,$activity);
    public function update($id,$status,$critial,$task_id,$base_feature_id,$description,$deadline,$activity);


    public function getFeature($id);

    public function getfilter();


}
