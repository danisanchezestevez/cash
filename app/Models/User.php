<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use GuzzleHttp\Client;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getAllFromReqres ($page=1)
    {
        $client = new Client();
        $url = env('URL_REGRES_USER_LIST');
        $headers = [
            'Accept' => 'application/json'
        ];
        $response = $client->request('GET', $url.'?page='.$page, [
            'headers' => $headers,
            'verify'  => false,
        ]);
        $respuesta = json_decode($response->getBody());

        return $respuesta;
    }

    public static function createFromReqres($datos){
        try {
            if(!$datos['usuario_email']){
                throw new InvalidArgumentException('Session Error');
            }
            $user = new User();
            $user->name = $datos['usuario_email'];
            $user->email = $datos['usuario_email'];
            $user->password = bcrypt($datos['usuario_password']);
            $user->save();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
