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
    //return view('welcome');
    return redirect('/login');
	//return view('adminlte::auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('/peta', function () {
	return view('peta');
});

Route::get('/data', function () {
	return view('data');
});

Route::resource('bangunan', 'BangunanController');
Route::get('/bangunan/hapus/{id}', 'BangunanController@destroy');
Route::get('/bangunan', 'BangunanController@index')
	->name('bangunan'); 
Route::get('/bangunan/hapusfoto/{id}/{foto}', 'BangunanController@hapusfoto');
Route::get('/bangunan/data', 'BangunanController@bangunandata')
	->name('bangunan.data');

Route::get('/irigasi', function () {
    return view('irigasi');
});
Route::resource('irigasi', 'IrigasiController');

Route::get('/pembuang', function () {
    return view('pembuang');
});
Route::resource('pembuang', 'PembuangController');