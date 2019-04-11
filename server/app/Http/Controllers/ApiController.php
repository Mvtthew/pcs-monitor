<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ApiController extends Controller
{
    /**
     * User login based on tokens
     *
     * @param Request $request
     * @return mixed
     */
    public function login (Request $request)
    {
        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => env('PASSPORT_CLIENTID'),
            'client_secret' => env('PASSPORT_CLIENTSECRET'),
            'username'      => $request->post('username'),
            'password'      => $request->post('password'),
            'scope'         => '*'
        ]);
        $res = $request::create('/oauth/token', 'post');

        $user = User::where('email', $request->post('username'))->first();
        Auth::loginUsingId($user->id);

        return Route::dispatch($res);
    }
}
