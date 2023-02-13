<?php 

namespace App\Services\authentication\concrete;
use App\Services\authentication\interfaces\authenticationInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class user implements authenticationInterface{



    public function login($email,$password){

        
        $client= DB::table('oauth_clients')->where("provider","users")->first();            
            $token=Http::asForm()->post(request()->root()."/oauth/token",[
                        'grant_type' => 'password',
                        'client_id' =>$client->id,
                        'client_secret' => $client->secret ,
                        'username' => $email ,
                        'password' => $password
                    ]);
            if ($token->status() != 200) {
                    throw new HttpResponseException(response()->json(["message"=>"we have error"],500));
            }
            
        return $token->json();
        


        
    }


}