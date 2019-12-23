<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('student.login');
    }

    public function dologin(Request $request)
    {
        $rules = [
            'name' => 'required',
            'password' => 'required|confirmed',
        ];

        $customMessages = [
            'required' => 'Bạn không được để trống',
            'confirmed' => 'Sai tên mật khẩu và tên đăng nhập',
        ];
        $this->validate($request, $rules, $customMessages);

        $name = $request->get('name');
        $password = $request->get('password');
            $user = User::where('username', $name)->first();
        if ($user->password == $password) {
            return redirect('/registration');
        } else {
            return redirect('/');
        }
    }
}
