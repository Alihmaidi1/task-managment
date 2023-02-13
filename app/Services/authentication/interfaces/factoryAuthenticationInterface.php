<?php 


namespace App\Services\authentication\interfaces;

interface factoryAuthenticationInterface{



    public function create($type);

    public function getUser($type);

}