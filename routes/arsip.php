<?php
//Route untuk Subkelompok Surat
Route::get('/arsip/mailsubgroup/create','Arsip\MailSubGroupController@create')->name('mailsubgroup.create');
Route::post('/arsip/mailsubgroup/store','Arsip\MailSubGroupController@store')->name('mailsubgroup.store');
Route::get('/arsip/mailsubgroup/edit/{id}','Arsip\MailSubGroupController@edit')->name('mailsubgroup.edit');
Route::post('/arsip/mailsubgroup/update/{id}','Arsip\MailSubGroupController@update')->name('mailsubgroup.update');

//Route untuk Klasifikasi Surat
Route::get('/arsip/mailclasification/create','Arsip\MailClasificationController@create')->name('mailclasification.create');
Route::post('/arsip/mailclasification/store','Arsip\MailClasificationController@store')->name('mailclasification.store');
Route::get('/arsip/mailclasification/edit/{id}','Arsip\MailClasificationController@edit')->name('mailclasification.edit');
Route::post('/arsip/mailclasification/update/{id}','Arsip\MailClasificationController@update')->name('mailclasification.update');
Route::post('/arsip/mailclasification/delete/{id}','Arsip\MailClasificationController@delete')->name('mailclasification.delete');

//Route untuk Arsip
Route::get('/arsip/archives/bidang/{id}','Arsip\ArchivesController@bidang')->name('archives.bidang');
Route::get('/arsip/archives/create/{id}','Arsip\ArchivesController@create')->name('archives.create');
Route::post('/arsip/archives/store/{id}','Arsip\ArchivesController@store')->name('archives.store');
Route::get('/arsip/archives/delete/{id}','Arsip\ArchivesController@delete')->name('archives.delete');
Route::get('/arsip/archives/edit/{div}/{id}','Arsip\ArchivesController@edit')->name('archives.edit');
Route::post('/arsip/archives/update/{div}/{id}','Arsip\ArchivesController@update')->name('archives.update');

//Route untuk Arsip bidang
Route::post('/arsip/archivesbid/store','Arsip\ArchivesbidController@store')->name('archivesbid.store');
Route::get('/arsip/archivesbid/delete/{id}','Arsip\ArchivesbidController@delete')->name('archivesbid.delete');
Route::get('/arsip/archivesbid/edit/{id}','Arsip\ArchivesbidController@edit')->name('archivesbid.edit');
Route::post('/arsip/archivesbid/update/{id}','Arsip\ArchivesbidController@update')->name('archivesbid.update');

//Route untuk rekap Arsip
Route::get('/arsip/archivesrek/create','Arsip\ArchivesrekController@create')->name('archivesrek.create');
Route::post('/arsip/archivesrek/store','Arsip\ArchivesrekController@store')->name('archivesrek.store');
Route::get('/arsip/archivesrek/delete/{id}','Arsip\ArchivesrekController@delete')->name('archivesrek.delete');
Route::get('/arsip/archivesrek/edit/{id}','Arsip\ArchivesrekController@edit')->name('archivesrek.edit');
Route::post('/arsip/archivesrek/update/{id}','Arsip\ArchivesrekController@update')->name('archivesrek.update');
Route::get('/arsip/archivesrek/deleteper/{id}','Arsip\ArchivesrekController@deleteper')->name('archivesrek.deleteper');