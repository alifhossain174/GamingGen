<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUserList(){
        $users = User::all();
        return view('backend.all_users',compact('users'));
    }
}
