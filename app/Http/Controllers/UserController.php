<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Model
use App\Models\User;

class UserController extends Controller
{
    public function users(Request $request)
    {
        $user = new User(); // Model Name
        $user->first_name         =   $request['first_name'];
        $user->last_name          =   $request['last_name'];
        $user->email              =   $request['email'];
        $user->password           =   $request[md5('password')];
        $user->confirm_password   =   $request[md5('confirm_password')];
        $user->phone              =   $request['phone'];
        $user->post_code          =   $request['post_code'];
        $user->country            =   $request['country'];
        $user->user_type          =   $request['user_type'];

        $user->save();
    }
}
