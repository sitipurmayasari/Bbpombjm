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
  Route::post('/calibration/napzaopname/cetak','Calibration\NapzaopnameController@cetak')->name('napzaopname.cetak');
  Route::post('/calibration/napzaopname/cetakopname','Calibration\NapzaopnameController@cetakopname')->name('napzaopname.cetakopname');





//   --------------------------------------NEW MENU--------------------------------------------------