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