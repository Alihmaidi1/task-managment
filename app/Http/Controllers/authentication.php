<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\authentications\login as loginRequest;
use App\Services\authentication\concrete\factoryAuthentication;
use App\Services\repo\interfaces\adminInterface;

class authentication extends Controller
{

    public $admin;
    public $factory;
    public function __construct(adminInterface $admin){


        $this->admin=$admin;

    }
    public function login(loginRequest $request){

        try{
            
            $type=$request->type;
            $factory=new factoryAuthentication();
            $auth=$factory->create($type);
            $token=$auth->login($request->email,$request->password);
            $user=$factory->getUser($type)->getUserByEmail($request->email);
            $user->token_info=$token;
            return response()->json(["data"=>$user],200);

        }catch(\Exception $ex){


            return response()->json(["message"=>$ex->getMessage()],500);


        }


    }



}
