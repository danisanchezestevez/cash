<?php

namespace App\Http;

use App\Models\User;
use GuzzleHttp\Client;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Helpers {

    public static function verifyToken(Request $request)
    {
        try {
            $user = User::where('email', '=', $request->input('email'))->first();
            if($user){
                return true;
            }
            $client = new Client();
            $params = array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            );

            $headers = [
                'Accept' => 'application/json'
            ];
            $url = env('URL_REGRES_LOGIN');
            $response = $client->request('POST', $url, [
                'form_params' => $params,
                'headers' => $headers,
                'verify'  => false,
            ]);
            $respuesta = json_decode($response->getBody());

            if(!isset($respuesta->token))
            {
                throw new InvalidArgumentException('Error verify token from reqres');
            }

            $datos['access_token'] = $respuesta->token;
            $datos['usuario_email'] = $request->input('email');
            $datos['usuario_password'] = $request->input('password');

            User::createFromReqres($datos);

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
