<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function save(Request $request){
        if(Auth::check()){
            return redirect()->route('user.private');
        }

        $validateFields = $request->validate([
            'email'=> 'email|required' ,
            'password'=> 'required',
            'name'=> 'required'
        ]);

        // check  user exists with this email - unique email -only!!
        if(User::where('email' , $validateFields['email'])->exists()){
            return redirect()->route('user.registration')->withErrors(['email'=> 'Пользователь с таким email уже существует!']);
        }

// create user and white it down in DB
       $user = User::create($validateFields);


        if($user){

            Auth::login($user);

            // or
//            auth()->login($user);

            return redirect()->route('user.private');
         }else{
            return  redirect()->route('user.register')->withErrors([
                'formError'=>'Произошла ошибка при сохранении пользователя'
            ]);
        }

    }
}
