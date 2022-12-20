<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' =>['required', 'confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-!"#$%&\'()]{8,16}$/'],

        ]);
    }
   
    public function edit()
    {
      return view('auth.passwords.edit')
              ->with('user', \Auth::user());
    }
   
    public function update(Request $request)
    {
        // ID のチェック
    //（ここでエラーになることは通常では考えられない）
    if ($request->id != \Auth::user()->id) {
        return redirect('/home')
                ->with('warning', '致命的なエラーです');
      }
      $user = \Auth::user();
      // 現在のパスワードを確認
      if (!password_verify($request->current_password, $user->password)) {
        return redirect('/change_pass')
                ->with('warning', 'パスワードが違います');
      }
      // Validation（
      $this->validator($request->all())->validate();
      // パスワードを保存
      $user->password = bcrypt($request->new_password);
      $user->save();
      return redirect('/change_pass')
              ->with('status', 'パスワードを変更しました');
    }
    }

