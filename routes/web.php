<?php

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
Route::get('/', function () {
    return view('layouts.main');
})->name('/');//main
//HomeControllers
Route::get('/home', 'HomeController@index')->name('home');//main_page(=all_page)
Route::get('/my_index/{check}','HomeController@my_index')->middleware('auth')->name('my_index');//my_page
Route::get('/detail-page/{id}','HomeController@detail_index')->name('detail_page');//detail page
Route::get('/search','HomeController@search')->name('search');//search
Route::get('/myStatus','HomeController@myStatus')->name('myStatus')->middleware('auth');//total Stauts
Route::get('/myLogStatus','HomeController@myLogStatus')->name('myLogStatus')->middleware('auth');
//login routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reLogin', function () {
  return view('layouts.redirectLogin');
})->name('reLogin');
Route::get('/reRegister', function () {
  return view('layouts.redirectRegister');
})->name('reRegister');
//CRUD-content
Route::resource('/content','ContentController');
//CRUD-comment
Route::resource('comment','CommentController');
//Social login relation Controller
Route::get('/redirect','Auth\AuthController@redirect');
Route::get('/callback','Auth\AuthController@callback');
/*project Route*/
//project-server
Route::get('/server/{data}','ProjectController@server')->name('server');//chart real time server
//chartUpdate
Route::get('/chart/{content_num}/{vote_num}','ProjectController@chart')->name('chart');//chart data update
//ck_fileUpload
Route::post('/ckUpload','ProjectController@ck_fileUpload')->name('ckUpload');//ck_edit fileUpload
//LocalizationController
Route::get('localization/{locale}','LocalizationController@index')->name('lcaliza');

Route::get('test',function(){
  event(new App\Events\StatusLiked('Someone'));
  return "Event has been sent!";
});










// // //mail
// // Route::get('/mail_send/{mail}','ProjectController@send');
// //
// Route::get('/',function(){
//   return view('welcome');
// });
