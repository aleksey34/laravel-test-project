<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// auth login logout register and etc
Route::name('user.')->group(function(){

    // route - user profile
    Route::view('/private' , 'private')
        ->middleware('auth')
        ->name('private');

    Route::get('/login' , function (){
        if(\Illuminate\Support\Facades\Auth::check()){
            return  redirect()->route('user.private');
        }
        return  view('login');
    })->name('login');

    Route::post('/login' , [ \App\Http\Controllers\LoginController::class ,'login'])->name("loginForm");

    Route::get('/logout' , function (){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('/registration' , function (){
        if( \Illuminate\Support\Facades\Auth::check()){
            return  redirect()->route('user.private');
        }
        return view('registration');
    })->name('registration');
    Route::post('/registration' , [\App\Http\Controllers\RegisterController::class , 'save']);




});


Route::get('/', function () {
//    return env('APP_NAME ');
   return view('welcome');
})->name('main');


Route::match(['get' , 'post'] , '/test' , function (){
    return 'route::match <h1>test</h1> ';
});
Route::any('/any' , function (){
    return "any1!";
});
Route::any('/redirect' , function (){
    return redirect('/');
});
Route::redirect('/redirect1' , '/' , '302' );
//Route::permanentRedirect('/' , '/test1'); 301  постоянный редирект
Route::view('/view' , 'welcome' , ['name'=>'this is name'])->name('view');

Route::get('/goods/{id?}/{name?}' , function ($id='' , $name = ''){

    $first = !empty($id) ?  $id : "there is no id <br><hr>";
    $second = !empty($name) ? $name : 'there is no name';
    return response($first . $second , '200' )->header('Content-type' , 'text/html');
} )->name('goods')
  //  ->where('id' , '[0-9]+')
    //->where('name' , '[A-Za-z]+');
;



//Route::middleware('JsonResponseMiddleware:1')
Route::prefix('api2')->group(function(){
        // Routes are here!!
            Route::get('json/{data}' , function ($data){
                return ['data'=>$data];
            });
        Route::get('testing/{data}' , function ($data = false){
            return ['test_data'=>$data];
        });
        //
    });

// do not khow how works it!!
Route::domain('{subdomain}/example.com')->group(function(){
    Route::get('/domain/{id}' , function ($subdomain , $id){
       return 'this is method domain!!' . $subdomain . $id;
    });
});

// name  what are the same   // front --- route('name.profile')   - and etc!!
//Route::name('name.')->group();
