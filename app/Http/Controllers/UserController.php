<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('users.profile', compact('user'));
    }
}
