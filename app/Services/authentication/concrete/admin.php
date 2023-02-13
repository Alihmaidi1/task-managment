<?php 


namespace App\Services\authentication\concrete;
use App\Services\authentication\interfaces\authenticationInterface;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class admin implements authenticationInterface{



    public function login($email,$password){

        
        $client= DB::table('oauth_clients')->where("provider","admins")->first();            

            $token=Http::asForm()->post(request()->root()."/oauth/token",[
                        'grant_type' => 'password',
                        'client_id' =>$client->id,
                        'client_secret' => $client->secret ,
                        'username' => $email ,
                        'password' => $password
                    ]);
            if ($token->status() != 200) {
                    throw new Exception("the Email Or Password Is Not Correct");
            }
            
        return $token->json();
        

    }


    public function getToken($refreshToken){

        $client=DB::table('oauth_clients')->where("provider","admins")->first();
        return  Http::asForm()->post(request()->root()."/oauth/token",[
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ])->json();




    }


}