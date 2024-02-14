<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(array $data)
{


    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);


    $databaseName = $data['name'];
    DB::statement("CREATE DATABASE IF NOT EXISTS $databaseName");


    config(['database.connections.user_database.database' => $databaseName]);
    DB::reconnect();



    return $user;
}

}
