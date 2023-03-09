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

    /**
     * APIリセット
     */
    public function ResetKey(Request $request){
        $login_user = Auth::user();
        $user_id = $login_user->id;
 //       $user = Auth::loginUsingId($user_id);
       

        $token_base = $login_user->createToken('API'.'_UserID_'.$user_id,['super_user'])->plainTextToken;
        $new_token = substr($token_base, strpos($token_base, "|") + 1);

        $resetAPI = User::find($user_id);
        $resetAPI->remember_token = $new_token;
        $resetAPI->update();
        return redirect('/superuser/ResetKey')->with('status', 'リセットが完了しました');

        
    }

}
