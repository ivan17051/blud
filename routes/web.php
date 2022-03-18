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

    Route::middleware(['role:PIH,admin,KEU'])->group(function(){
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
        Route::post('/saldo/{idunitkerja}', 'DataController@saldoTable')->name('saldo.table');
        Route::put('/saldo', 'DataController@storeSaldo')->name('saldo.update');
        
        Route::get('/pajak', 'DataController@pajak');
        Route::put('/pajak', 'DataController@storeUpdatePajak')->name('pajak.update');
        Route::delete('/pajak', 'DataController@deletePajak')->name('pajak.delete');
    });

    Route::middleware(['role:PIH,admin,KEU,PKM'])->group(function(){
        
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
    Route::put('/transaksi/inputCek', 'TransaksiController@inputCek')->name('transaksi.inputCek');
    Route::post('/transaksi/espj2transaksi', 'TransaksiController@espjToTransaksi')->name('transaksi.espj2transaksi');
    Route::post('/transaksi/lpjToTransaksi', 'TransaksiController@lpjToTransaksi')->name('transaksi.lpj2transaksi');

    Route::put('/ubah-password', 'PasswordController@update');

    Route::get('/sptb/{id}', 'TransaksiController@sptb');
    Route::get('/spp/{id}', 'TransaksiController@spp');
    Route::put('/ceklist/{id}', 'TransaksiController@ceklist');
    Route::get('/sppup/{id}', 'TransaksiController@sppup');
    Route::get('/spm/{id}', 'TransaksiController@spm');
    Route::get('/sp2d/{id}', 'TransaksiController@sp2d');
    Route::get('/sp2d/info/{idtransaksi}', 'TransaksiController@getsp2dinfo')->name('getsp2d.info');

    Route::get('/bku', 'BkuController@index')->name('bku');
    Route::post('/bku/data', 'BkuController@data')->name('bku.data');
    Route::put('/bku', 'BkuController@storeUpdateBKU')->name('bku.update');
    Route::post('/bku/transaksi2bku', 'BkuController@transaksiToBKU')->name('bku.transaksi2bku');
    Route::get('/bku/cetak/{idunitkerja}/{bulan}', 'BkuController@cetak')->name('bku.cetak');
    Route::delete('/bku', 'BkuController@deleteBKU')->name('bku.delete');
    Route::post('/bku/getspp', 'BkuController@getSPP')->name('bku.getspp');

    Route::get('/spj', 'SPJController@spj');
    Route::post('/spj/data', 'SPJController@data')->name('spj.data');
    Route::put('/spj', 'SPJController@storeUpdateSPJ')->name('spj.update');
    Route::delete('/spj', 'SPJController@deleteSPJ')->name('spj.delete');

    Route::get('/lpj', 'LPJController@lpj');
    Route::put('/lpj/up', 'LPJController@storeUpdateLPJ_UP')->name('lpj.update.up');
    Route::put('/lpj/tu', 'LPJController@storeUpdateLPJ_TU')->name('lpj.update.tu');
    Route::delete('/lpj', 'LPJController@deleteLPJ')->name('lpj.delete');
    Route::post('/lpj/data', 'LPJController@data')->name('lpj.data');
    Route::get('/lpj/getrelatedbku/{idlpj}', 'LPJController@getRelatedBKU')->name('lpj.getrelatedbku');
    Route::get('/lpj/getbkubyperiod/{idsubkegiatan}/{tipe}/{month}/{year}', 'LPJController@getBKUByPeriod')->name('lpj.getbkubyperiod');
    Route::post('/lpj/getlpj', 'LPJController@getLPJ')->name('lpj.getlpj');

    Route::get('/laporan/fungsional','LaporanFungsional@index')->name('fungsional');
    Route::get('/laporan/fungsional/excel','LaporanFungsional@excel')->name('fungsional.excel');

    Route::get('/bukuBank', 'BukuBankController@bukuBank')->name('bukuBank.view');
    Route::post('bukuBank/cetak', 'BukuBankController@cetak')->name('bukuBank.cetak');
    Route::post('/bukuBank', 'BukuBankController@bukuBankTable');
    Route::put('/bukuBank/saldo', 'BukuBankController@storeUpdateSaldo')->name('bukuBank.updateSaldo');
    Route::put('/bukuBank/create', 'BukuBankController@storeUpdateBukuBank')->name('bukuBank.update');
    Route::delete('/bukuBank/delete', 'BukuBankController@delete')->name('bukuBank.delete');
});