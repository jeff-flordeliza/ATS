<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class AccountController extends Controller
{
    public function index(){
        $users = User::paginate(10);

        return view('');
    }

    /** page account profile */
    public function profileDetail($user_id)
    {
        $profileDetail = User::where('user_id', $user_id)->first();
        return view('pages.account-profile', compact('profileDetail'));
    }
}
