<?php

namespace App\Http\Controllers;

use App\Machine;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

    /**
     * User post /user/renewpassword for machine password reset
     *
     * @param Request $request
     * @return string
     */
    public function renewPassword (Request $request)
    {

        User::generateMachinePassword($request->user()->id);

        return json_encode([
            'message' => 'New password generated successfully!'
        ]);
    }

    public function getMachines (Request $request)
    {
        $machines = Machine::where('user_id', $request->user()->id)->get();

        $machinesReturn = [];

        foreach ($machines as $machine) {

            $machineReturn = [
                'name' => $machine->name,
                'desc' => $machine->desc,
                'reported' => $machine->reported,
                'online' => false
            ];

            array_push($machinesReturn, $machineReturn);
        }

        return $machinesReturn;
    }

    /**
     * Post to /machine/new for new machine creation
     *
     * @param Request $request
     * @return string
     */
    public function registerMachine (Request $request)
    {
        $user = User::where('machine_password', $request->post('key'))->first();

        $machine = new Machine();
        $machine->user_id = $user->id;
        $machine->name = $request->post('name');
        $machine->desc = $request->post('desc');
        $machine->reported = Carbon::now()->toDateTimeString();
        $machine->machine_token = $user->id . Str::random(48);

        $machine->save();

        return json_encode($machine);
    }

}
