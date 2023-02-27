<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MakeApiKeyController extends Controller
{
    public function ResetKey(){
        // $userid = Auth::User()->id;
        // $user = Auth::loginUsingId($userid);
        // $token = $user->createToken('test');
        // dd($token);
        //  dd($userid);

        return view('super.resetapi');
    }
}
