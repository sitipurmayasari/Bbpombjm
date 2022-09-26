<?php

//   --------------------------------------LAB OBAT & NAPPZA--------------------------------------------------
  //Route untuk Alat Gelas Kualitatif
  Route::get('/calibration/glasskual/create','Calibration\GlassKualController@create')->name('glasskual.create');
  Route::post('/calibration/glasskual/store','Calibration\GlassKualController@store')->name('glasskual.store');
  Route::get('/calibration/glasskual/edit/{id}','Calibration\GlassKualController@edit')->name('glasskual.edit');
  Route::post('/calibration/glasskual/update/{id}','Calibration\GlassKualController@update')->name('glasskual.update');
  Route::get('/calibration/glasskual/delete/{id}','Calibration\GlassKualController@delete')->name('glasskual.delete');
  Route::get('/calibration/glasskual/qrcode/{id}','Calibration\GlassKualController@qrcode')->name('glasskual.qrcode');
  Route::get('/calibration/glasskual/stock/{id}','Calibration\GlassKualController@stock')->name('glasskual.stock');
  Route::get('/calibration/glasskual/stockread/{id}','Calibration\GlassKualController@stockread')->name('glasskual.stockread');
  Route::post('/calibration/glasskual/storestock','Calibration\GlassKualController@storestock')->name('glasskual.storestock');
  Route::get('/calibration/glasskual/ubahstok/{id}','Calibration\GlassKualController@ubahstok')->name('glasskual.ubahstok');
  Route::post('/calibration/glasskual/updatestok/{id}','Calibration\GlassKualController@updatestok')->name('glasskual.updatestok');
  Route::get('/calibration/glasskual/viewimg/{id}','Calibration\GlassKualController@viewimg')->name('glasskual.viewimg');
  Route::get('/calibration/glasskual/kartustock/{id}','Calibration\GlassKualController@kartustock')->name('glasskual.kartustock');
  
  //Route untuk Alat Gelas Kuantitatif
  Route::get('/calibration/glasskuan/create','Calibration\GlassKuanController@create')->name('glasskuan.create');
  Route::post('/calibration/glasskuan/store','Calibration\GlassKuanController@store')->name('glasskuan.store');
  Route::get('/calibration/glasskuan/edit/{id}','Calibration\GlassKuanController@edit')->name('glasskuan.edit');
  Route::post('/calibration/glasskuan/update/{id}','Calibration\GlassKuanController@update')->name('glasskuan.update');
  Route::get('/calibration/glasskuan/delete/{id}','Calibration\GlassKuanController@delete')->name('glasskuan.delete');
  Route::get('/calibration/glasskuan/qrcode/{id}','Calibration\GlassKuanController@qrcode')->name('glasskuan.qrcode');
  Route::get('/calibration/glasskuan/stock/{id}','Calibration\GlassKuanController@stock')->name('glasskuan.stock');
  Route::get('/calibration/glasskuan/stockread/{id}','Calibration\GlassKuanController@stockread')->name('glasskuan.stockread');
  Route::post('/calibration/glasskuan/storestock','Calibration\GlassKuanController@storestock')->name('glasskuan.storestock');
  Route::get('/calibration/glasskuan/ubahstok/{id}','Calibration\GlassKuanController@ubahstok')->name('glasskuan.ubahstok');
  Route::post('/calibration/glasskuan/updatestok/{id}','Calibration\GlassKuanController@updatestok')->name('glasskuan.updatestok');
  Route::get('/calibration/glasskuan/viewimg/{id}','Calibration\GlassKuanController@viewimg')->name('glasskuan.viewimg');
  Route::get('/calibration/glasskuan/kartustock/{id}','Calibration\GlassKuanController@kartustock')->name('glasskuan.kartustock');
  

  //Route untuk Laporan Stok Barang
  Route::post('/calibration/napzastock/cetak','Calibration\NapzastockController@cetak')->name('napzastock.cetak');
  
  //Route untuk Laporan Stok Opname
  Route::get('/calibration/napzaopname/create','Calibration\NapzaopnameController@create')->name('napzaopname.create');
  Route::post('/calibration/napzaopname/store','Calibration\NapzaopnameController@store')->name('napzaopname.store');
  Route::get('/calibration/napzaopname/edit/{id}','Calibration\NapzaopnameController@edit')->name('napzaopname.edit');
  Route::post('/calibration/napzaopname/update/{id}','Calibration\NapzaopnameController@update')->name('napzaopname.update');
  Route::get('/calibration/napzaopname/delete/{id}','Calibration\NapzaopnameController@delete')->name('napzaopname.delete');
  Route::get('/calibration/napzaopname/formopname','Calibration\NapzaopnameController@formopname')->name('napzaopname.formopname');
  Route::get('/calibration/napzaopname/cetakopname/{id}','Calibration\NapzaopnameController@cetakopname')->name('napzaopname.cetakopname');
  Route::post('/calibration/napzaopname/cetak','Calibration\NapzaopnameController@cetak')->name('napzaopname.cetak');


//   --------------------------------------MIKRO--------------------------------------------------
//Route untuk Media Mikrobiologi
  Route::post('/calibration/mediamikro/store','Calibration\MediaController@store')->name('media.store');
  Route::get('/calibration/mediamikro/delete/{id}','Calibration\MediaController@delete')->name('media.delete');
  Route::get('/calibration/mediamikro/edit/{id}','Calibration\MediaController@edit')->name('media.edit');
  Route::post('/calibration/mediamikro/update/{id}','Calibration\MediaController@update')->name('media.update');
  Route::get('/calibration/mediamikro/getMedia','Calibration\MediaController@getMedia')->name('media.getMedia');

  //Route untuk Kontrol Media Mikrobiologi
  Route::post('/calibration/kontrolmikro/store','Calibration\KontrolController@store')->name('kontrol.store');
  Route::get('/calibration/kontrolmikro/delete/{id}','Calibration\KontrolController@delete')->name('kontrol.delete');
  Route::get('/calibration/kontrolmikro/edit/{id}','Calibration\KontrolController@edit')->name('kontrol.edit');
  Route::post('/calibration/kontrolmikro/update/{id}','Calibration\KontrolController@update')->name('kontrol.update');
  Route::get('/calibration/kontrolmikro/getKontrol','Calibration\KontrolController@getKontrol')->name('kontrol.getKontrol');

  //Route untuk Daftar Bakteri
  Route::get('/calibration/bakterimikro/create','Calibration\BakteriController@create')->name('bakteri.create');
  Route::post('/calibration/bakterimikro/store','Calibration\BakteriController@store')->name('bakteri.store');
  Route::get('/calibration/bakterimikro/delete/{id}','Calibration\BakteriController@delete')->name('bakteri.delete');
  Route::get('/calibration/bakterimikro/edit/{id}','Calibration\BakteriController@edit')->name('bakteri.edit');
  Route::post('/calibration/bakterimikro/update/{id}','Calibration\BakteriController@update')->name('bakteri.update');
  Route::get('/calibration/bakterimikro/deletemed/{id}','Calibration\BakteriController@deletemed')->name('bakteri.deletemed');
  Route::get('/calibration/bakterimikro/getDaftarMedia','Calibration\BakteriController@getDaftarMedia')->name('bakteri.getDaftarMedia');
  

  //Route untuk Monitoring Mikroba
  Route::get('/calibration/mikroba/create','Calibration\MikrobaController@create')->name('mikroba.create');
  Route::post('/calibration/mikroba/store','Calibration\MikrobaController@store')->name('mikroba.store');
  Route::get('/calibration/mikroba/delete/{id}','Calibration\MikrobaController@delete')->name('mikroba.delete');
  Route::get('/calibration/mikroba/edit/{id}','Calibration\MikrobaController@edit')->name('mikroba.edit');
  Route::post('/calibration/mikroba/update/{id}','Calibration\MikrobaController@update')->name('mikroba.update');
  Route::get('/calibration/mikroba/print/{id}','Calibration\MikrobaController@print')->name('mikroba.print');

  //Route untuk Pengambilan MIkroba
  Route::get('/calibration/getmikro/create','Calibration\GetmikroController@create')->name('getmikro.create');
  Route::post('/calibration/getmikro/store','Calibration\GetmikroController@store')->name('getmikro.store');
  Route::get('/calibration/getmikro/delete/{id}','Calibration\GetmikroController@delete')->name('getmikro.delete');
  Route::get('/calibration/getmikro/edit/{id}','Calibration\GetmikroController@edit')->name('getmikro.edit');
  Route::post('/calibration/getmikro/update/{id}','Calibration\GetmikroController@update')->name('getmikro.update');