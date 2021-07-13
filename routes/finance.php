<?php

  //Route untuk Kode Kementrian Lembaga
  Route::get('/finance/klcode/create','Finance\KlcodeController@create')->name('klcode.create');
  Route::post('finance/klcode/store','Finance\KlcodeController@store')->name('klcode.store');
  Route::get('finance/klcode/delete/{id}','Finance\KlcodeController@delete')->name('klcode.delete');
  Route::get('finance/klcode/edit/{id}','Finance\KlcodeController@edit')->name('klcode.edit');
  Route::post('finance/klcode/update/{id}','Finance\KlcodeController@update')->name('klcode.update');

  //Route untuk Kode Unit Kementrian Lembaga
  Route::get('/finance/unitcode/create','Finance\UnitcodeController@create')->name('unitcode.create');
  Route::post('finance/unitcode/store','Finance\UnitcodeController@store')->name('unitcode.store');
  Route::get('finance/unitcode/delete/{id}','Finance\UnitcodeController@delete')->name('unitcode.delete');
  Route::get('finance/unitcode/edit/{id}','Finance\UnitcodeController@edit')->name('unitcode.edit');
  Route::post('finance/unitcode/update/{id}','Finance\UnitcodeController@update')->name('unitcode.update');

   //Route untuk Kode Program Lembaga
  Route::get('/finance/programcode/create','Finance\ProgramcodeController@create')->name('programcode.create');
  Route::post('finance/programcode/store','Finance\ProgramcodeController@store')->name('programcode.store');
  Route::get('finance/programcode/delete/{id}','Finance\ProgramcodeController@delete')->name('programcode.delete');
  Route::get('finance/programcode/edit/{id}','Finance\ProgramcodeController@edit')->name('programcode.edit');
  Route::post('finance/programcode/update/{id}','Finance\ProgramcodeController@update')->name('programcode.update');

  //Route untuk Kode kegiatan
  Route::get('/finance/activitycode/create','Finance\ActivitycodeController@create')->name('activitycode.create');
  Route::post('finance/activitycode/store','Finance\ActivitycodeController@store')->name('activitycode.store');
  Route::get('finance/activitycode/delete/{id}','Finance\ActivitycodeController@delete')->name('activitycode.delete');
  Route::get('finance/activitycode/edit/{id}','Finance\ActivitycodeController@edit')->name('activitycode.edit');
  Route::post('finance/activitycode/update/{id}','Finance\ActivitycodeController@update')->name('activitycode.update');

  //Route untuk Kode KRO
  Route::get('/finance/krocode/create','Finance\KrocodeController@create')->name('krocode.create');
  Route::post('finance/krocode/store','Finance\KrocodeController@store')->name('krocode.store');
  Route::get('finance/krocode/delete/{id}','Finance\KrocodeController@delete')->name('krocode.delete');
  Route::get('finance/krocode/edit/{id}','Finance\KrocodeController@edit')->name('krocode.edit');
  Route::post('finance/krocode/update/{id}','Finance\KrocodeController@update')->name('krocode.update');
  

  //Route untuk Kode Rincian KRO
  Route::get('/finance/detailcode/create','Finance\DetailcodeController@create')->name('detailcode.create');
  Route::post('finance/detailcode/store','Finance\DetailcodeController@store')->name('detailcode.store');
  Route::get('finance/detailcode/delete/{id}','Finance\DetailcodeController@delete')->name('detailcode.delete');
  Route::get('finance/detailcode/edit/{id}','Finance\DetailcodeController@edit')->name('detailcode.edit');
  Route::post('finance/detailcode/update/{id}','Finance\DetailcodeController@update')->name('detailcode.update');
  Route::get('/finance/detailcode/getRO','Finance\DetailcodeController@getRO')->name('detailcode.getRO');

  //Route untuk Kode komponen
  Route::get('/finance/komponencode/create','Finance\KomponencodeController@create')->name('komponencode.create');
  Route::post('finance/komponencode/store','Finance\KomponencodeController@store')->name('komponencode.store');
  Route::get('finance/komponencode/delete/{id}','Finance\KomponencodeController@delete')->name('komponencode.delete');
  Route::get('finance/komponencode/edit/{id}','Finance\KomponencodeController@edit')->name('komponencode.edit');
  Route::post('finance/komponencode/update/{id}','Finance\KomponencodeController@update')->name('komponencode.update');
  Route::get('finance/komponencode/getKomponen','Finance\KomponencodeController@getKomponen')->name('komponencode.getKomponen');

  //Route untuk Kode Sub komponen
  Route::get('/finance/subcode/create','Finance\SubcodeController@create')->name('subcode.create');
  Route::post('finance/subcode/store','Finance\SubcodeController@store')->name('subcode.store');
  Route::get('finance/subcode/delete/{id}','Finance\SubcodeController@delete')->name('subcode.delete');
  Route::get('finance/subcode/edit/{id}','Finance\SubcodeController@edit')->name('subcode.edit');
  Route::post('finance/subcode/update/{id}','Finance\SubcodeController@update')->name('subcode.update');
  Route::get('/finance/subcode/getSubkom','Finance\SubcodeController@getSubkom')->name('subcode.getSubkom');

  //Route untuk Kode Akun
  Route::get('/finance/accountcode/create','Finance\AccountcodeController@create')->name('accountcode.create');
  Route::post('finance/accountcode/store','Finance\AccountcodeController@store')->name('accountcode.store');
  Route::get('finance/accountcode/delete/{id}','Finance\AccountcodeController@delete')->name('accountcode.delete');
  Route::get('finance/accountcode/edit/{id}','Finance\AccountcodeController@edit')->name('accountcode.edit');
  Route::post('finance/accountcode/update/{id}','Finance\AccountcodeController@update')->name('accountcode.update');

  //Route untuk Loka
  Route::get('/finance/loka/create','Finance\LokaController@create')->name('loka.create');
  Route::post('finance/loka/store','Finance\LokaController@store')->name('loka.store');
  Route::get('finance/loka/delete/{id}','Finance\LokaController@delete')->name('loka.delete');
  Route::get('finance/loka/edit/{id}','Finance\LokaController@edit')->name('loka.edit');
  Route::post('finance/loka/update/{id}','Finance\LokaController@update')->name('loka.update');

  //Route untuk Pelaksanaan Anggaran
  Route::get('/finance/implementation/create','Finance\ImplementController@create')->name('implementation.create');
  Route::post('finance/implementation/store','Finance\ImplementController@store')->name('implementation.store');
  Route::get('finance/implementation/edit/{id}','Finance\ImplementController@edit')->name('implementation.edit');
  Route::post('finance/implementation/update/{id}','Finance\ImplementController@update')->name('implementation.update');

  //Route untuk Revisi Pelaksanaan Anggaran
  Route::get('/finance/revision/create','Finance\RevisionController@create')->name('revision.create');
  Route::post('finance/revision/store','Finance\RevisionController@store')->name('revision.store');
  Route::get('finance/revision/edit/{id}','Finance\RevisionController@edit')->name('revision.edit');
  Route::post('finance/revision/update/{id}','Finance\RevisionController@update')->name('revision.update');
  Route::get('finance/revision/getKomponen','Finance\RevisionController@getKomponen')->name('revision.getKomponen');
  Route::get('finance/revision/getdasarawal','Finance\RevisionController@getdasarawal')->name('revision.getdasarawal');

  //Route untuk Rekap Anggaran
  Route::post('/finance/rera/cetakrekap','Finance\ReraController@cetakrekap')->name('rera.cetakrekap');

  //Route untuk Realisasi anggaran Anggaran
  Route::get('/finance/realisasi/create','Finance\RealisasiController@create')->name('realisasi.create');
  Route::post('finance/realisasi/store','Finance\RealisasiController@store')->name('realisasi.store');
  Route::get('finance/realisasi/edit/{id}','Finance\RealisasiController@edit')->name('realisasi.edit');
  Route::post('finance/realisasi/update/{id}','Finance\RealisasiController@update')->name('realisasi.update');

  // //Route untuk dinas
  // Route::get('/finance/outstation/create','Finance\OutstationController@create')->name('outstation.create');
  // Route::post('finance/outstation/store','Finance\OutstationController@store')->name('outstation.store');
  // Route::get('finance/outstation/edit/{id}','Finance\OutstationController@edit')->name('outstation.edit');
  // Route::post('finance/outstation/update/{id}','Finance\OutstationController@update')->name('outstation.update');

