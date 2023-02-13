<?php 

namespace App\Services\authentication\interfaces;


interface  authenticationInterface{



    public function login($email,$password);


    public function getToken($refreshToken);


}