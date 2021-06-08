<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client As Guzzle;
use GuzzleHttp\Exception\RequestException;

class Produto extends Model
{
    private $token;
    
    public function __construct()
    {
        $guzzle = new Guzzle;
        try{
            $response = $guzzle->request('POST', 'http://127.0.0.1:8000/api/auth',[

                'form_params' => [
                    'email' => 'renato@acessohost.com.br',
                    'password' => 'adm!@#'
                ]
            ]);
    
           $this->token = json_decode($response->getBody())->token;

        }catch(RequestException $e){
            dd("error: {$e}");
        }

    }

    public function getToken ()
    {
       return $this->token;
    }
}
