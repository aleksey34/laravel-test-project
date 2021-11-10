<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){


$formFields = $request->only(['email' , 'password']);

        if(Auth::check()){
            // redirect back  or pointed route
            return redirect()
                ->intended(route('user.private'));
        }

        if(Auth::attempt($formFields)){
            //redirect back or pointed route
            return redirect()
                ->intended(route('user.private'));
        }else{
            return redirect()
                ->route('user.login')
                ->withErrors(['email'=>"Авторизоваться не удалось. Проверьте email или пароль."]);
        }
    }

}
