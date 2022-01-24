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

Route::middleware(['auth'])->group(function () {
    Route::get('/','DataController@dashboard');

    Route::middleware(['role:PIH,admin'])->group(function(){
        Route::get('/kegiatan', 'DataController@kegiatan');
        Route::put('/kegiatan', 'DataController@storeUpdateKegiatan')->name('kegiatan.update');
        Route::delete('/kegiatan', 'DataController@deleteKegiatan')->name('kegiatan.delete');

        Route::get('/subkegiatan', 'DataController@subkegiatan');
        Route::put('/subkegiatan', 'DataController@storeUpdateSubKegiatan')->name('subkegiatan.update');
        Route::delete('/subkegiatan', 'DataController@deleteSubKegiatan')->name('subkegiatan.delete');

        Route::get('/rekening', 'DataController@rekening');
        Route::put('/rekening', 'DataController@storeUpdateRekening')->name('rekening.update');
        Route::delete('/rekening', 'DataController@deleteRekening')->name('rekening.delete');

        Route::get('/unitKerja', 'DataController@unitKerja');

        Route::get('/user', 'DataController@user');
        Route::put('/user', 'DataController@storeUpdateUser')->name('user.update');
        Route::delete('/user', 'DataController@deleteUser')->name('user.delete');

        Route::get('/saldo', 'DataController@saldo')->name('saldo');
        Route::put('/saldo', 'DataController@storeSaldo')->name('saldo.update');
        
        Route::get('/pajak', 'DataController@pajak');
        Route::put('/pajak', 'DataController@storeUpdatePajak')->name('pajak.update');
        Route::delete('/pajak', 'DataController@deletePajak')->name('pajak.delete');
    });

    Route::middleware(['role:PIH,admin,PKM'])->group(function(){
        
        Route::get('/pejabat', 'DataController@pejabat');
        Route::put('/pejabat', 'DataController@storeUpdatePejabat')->name('pejabat.update');
        Route::delete('/pejabat', 'DataController@deletePejabat')->name('pejabat.delete');

        Route::get('/rekanan', 'DataController@rekanan');
        Route::put('/rekanan', 'DataController@storeUpdateRekanan')->name('rekanan.update');        
        Route::delete('/rekanan', 'DataController@deleteRekanan')->name('rekanan.delete');
    });

    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
    Route::post('/transaksi/data', 'TransaksiController@data')->name('transaksi.data');
    Route::put('/transaksi', 'TransaksiController@storeUpdateTransaksi')->name('transaksi.update');
    Route::delete('/transaksi', 'TransaksiController@deleteTransaksi')->name('transaksi.delete');
    Route::put('/transaksi/acc', 'TransaksiController@accTransaksi')->name('transaksi.acc');
    Route::delete('/transaksi/tolak', 'TransaksiController@tolakTransaksi')->name('transaksi.tolak');
    Route::put('/transaksi/batal', 'TransaksiController@batalkanPengajuanSP2D')->name('transaksi.batal');
});
Route::get('/coba', function () {
    return view('coba');
});
Route::get('/cobasppup', function () {
    return view('report.sppup');
});
Route::get('/cobaspm', function () {
    return view('report.spm');
});
Route::get('/sptb/{id}', 'TransaksiController@sptb');
Route::get('/spp/{id}', 'TransaksiController@spp');
Route::get('/sppup/{id}', 'TransaksiController@sppup');
Route::get('/spm/{id}', 'TransaksiController@spm');
Route::get('/sp2d/{id}', 'TransaksiController@sp2d');

Route::get('/pejabat/byunitkerja/{idunitkerja}','DataController@getPejabatByUnitKerja')->name('pejabat.byunitkerja');