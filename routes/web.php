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

Auth::routes();

Route::get('/','DataController@dashboard');

Route::get('/kegiatan','DataController@kegiatan');

Route::get('/subkegiatan','DataController@subkegiatan');

Route::get('/rekening','DataController@rekening');

Route::get('/pejabat','DataController@pejabat');

Route::get('/unitKerja','DataController@unitKerja');

Route::get('/rekanan','DataController@rekanan');

Route::put('/kegiatan','DataController@storeUpdateKegiatan')->name('kegiatan.update');
Route::put('/subkegiatan','DataController@storeUpdateSubKegiatan')->name('subkegiatan.update');
Route::put('/pejabat','DataController@storeUpdatePejabat')->name('pejabat.update');
Route::put('/rekanan','DataController@storeUpdateRekanan')->name('rekanan.update');

Route::delete('/kegiatan','DataController@deleteKegiatan')->name('kegiatan.delete');
Route::delete('/subkegiatan','DataController@deleteSubKegiatan')->name('subkegiatan.delete');
Route::delete('/pejabat','DataController@deletePejabat')->name('pejabat.delete');
Route::delete('/rekanan','DataController@deleteRekanan')->name('rekanan.delete');

Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/tu', function () {
    return view('tu');
});
Route::get('/coba', 'DataController@coba');