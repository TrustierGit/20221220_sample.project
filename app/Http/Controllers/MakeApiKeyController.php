<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class MakeApiKeyController extends Controller
{
    /**
     * APIリセット画面表示
     */
    public function ShowAPIKey(){
        return view('super.ResetKey');
    }

   


}
