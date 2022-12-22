<?php
 //Route untuk Surat Izin Pramubakti
 Route::get('/amdk/permit/edit/{id}','Amdk\PermitController@edit')->name('permit.edit');
 Route::post('/amdk/permit/update/{id}','Amdk\PermitController@update')->name('permit.update'); 

//Route untuk Rekap Surat Izin Pramubakti
Route::get('/amdk/rekpermit/create','Amdk\RekpermitController@create')->name('rekpermit.create');
Route::get('/amdk/rekpermit/rekap','Amdk\RekpermitController@rekap')->name('rekpermit.rekap');
Route::post('/amdk/rekpermit/store','Amdk\RekpermitController@store')->name('rekpermit.store');
Route::get('/amdk/rekpermit/edit/{id}','Amdk\RekpermitController@edit')->name('rekpermit.edit');
Route::post('/amdk/rekpermit/update/{id}','Amdk\RekpermitController@update')->name('rekpermit.update');
Route::get('/amdk/rekpermit/laporan','Amdk\RekpermitController@laporan')->name('rekpermit.laporan');
Route::post('/amdk/rekpermit/cetak','Amdk\RekpermitController@cetak')->name('rekpermit.cetak');
Route::get('/amdk/rekpermit/daftar/{users_id}/{bln}/{thn}','Amdk\RekpermitController@daftar')->name('rekpermit.daftar');