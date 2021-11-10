<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Illuminate\Routing\CustomRouter;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

function customResponseJson($data){
     return   response()->json($data , 200 , [] , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // for unicode RU and OTHERs
}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects' , function (){
    $json1 = json_encode(['test'=>"25151ajfla"]) ;
    $json2 = '{"test":"25151ajfla  русский текст"}';
    $arr = ['test'=>'some data' , 'test2'=>[1,3 ,3 ,3.34], 'ru'=>'русский текст'];

  //  return customResponseJson($arr);

   // return response($arr); // for unicode RU and OTHERs  custom class customrouter
    return response()->json($arr , 200 ) ; //->header('Content-type' , 'text/json'); // for unicode RU and OTHERs  custom class customrouter
//    return response()->json($arr , 200 , [] , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // for unicode RU and OTHERs
})
;  //  ->middleware([\App\Http\Middleware\JsonResponseMiddleware::class]); // add middleware where it needs ; array or not!!
//    ->middleware(\App\Http\Middleware\JsonResponseMiddleware::class); // add middleware where it needs




// backup DB  -- command to terminal BASH!!!
// mysqldump -u admin -p123 laravel-itproger > backup/db_backup29_10_21.sql  // all table!
// create backup file DB !!  -- TERMINAL!!!  bask !!
//mysqldump -u admin -p123 laravel-itproger users > backup/db_backup29_10_21.sql  // users table ONLY!
//mysqldump -u admin -p123 laravel-itproger contacts users > backup/db_backup29_10_21.sql  // users contacts tables ONLY!!
// //mysqldump -u admin -p123 laravel-itproger --no-data > backup/db_backup29_10_21.sql // without data!! structure only!
// //mysqldump -u admin -p123 laravel-itproger --no-create-info > backup/db_backup29_10_21.sql // data only!! without structure of tables!!
// //mysqldump -u admin -p123 laravel-itproger --no-create-info --replace > backup/db_backup29_10_21.sql // for replace data if ids are the same!! INSERT replace REPLACE
// exist many other options!! for export!
// safety enter pass
//mysqldump -u admin -p laravel-itproger > backup/db_backup29_10_21.sql // password will request after command!!
//утилита    юзер имя  пароль (слитно  или без- будет запрошен позже!!) имя базы данных  опции  таблици для экспорта   путь куда сохранить файл

// mysqldump -u admin -p123 laravel-itproger  --no-create-info --replace where="created_at > '29.10.2021'" users > backup/db_backup29_10_21.sql
// выборка по строкам - через --where="created_at > '29.10.2021'" -пример -- через услоие!!




// group route for middleware
Route::middleware([\App\Http\Middleware\JsonResponseMiddleware::class] )
    ->group(function(){
        // Route  - are here!
        // Route:: ....
        // Route:: ....


    });

