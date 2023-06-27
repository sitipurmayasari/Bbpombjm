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
Route::get('/arsip/mailclasification/getData','Arsip\MailClasificationController@getData')->name('mailclasification.getData');

//Route untuk Arsip
Route::get('/arsip/archives/bidang/{id}','Arsip\ArchivesController@bidang')->name('archives.bidang');
Route::get('/arsip/archives/create/{id}','Arsip\ArchivesController@create')->name('archives.create');
Route::post('/arsip/archives/store/{id}','Arsip\ArchivesController@store')->name('archives.store');
Route::get('/arsip/archives/delete/{id}','Arsip\ArchivesController@delete')->name('archives.delete');
Route::get('/arsip/archives/edit/{div}/{id}','Arsip\ArchivesController@edit')->name('archives.edit');
Route::post('/arsip/archives/update/{div}/{id}','Arsip\ArchivesController@update')->name('archives.update');
Route::get('/arsip/archives/deletelist/{id}','Arsip\ArchivesController@deletelist')->name('archives.deletelist');

//Route untuk Bentuk NAskah
Route::get('/arsip/archivesbid/create','Arsip\ArchivesbidController@create')->name('archivesbid.create');
Route::post('/arsip/archivesbid/store','Arsip\ArchivesbidController@store')->name('archivesbid.store');
Route::get('/arsip/archivesbid/edit/{id}','Arsip\ArchivesbidController@edit')->name('archivesbid.edit');
Route::post('/arsip/archivesbid/update/{id}','Arsip\ArchivesbidController@update')->name('archivesbid.update');

//Route untuk rekap Arsip
Route::get('/arsip/archivesrek/create','Arsip\ArchivesrekController@create')->name('archivesrek.create');
Route::post('/arsip/archivesrek/store','Arsip\ArchivesrekController@store')->name('archivesrek.store');
Route::get('/arsip/archivesrek/delete/{id}','Arsip\ArchivesrekController@delete')->name('archivesrek.delete');
Route::get('/arsip/archivesrek/edit/{id}','Arsip\ArchivesrekController@edit')->name('archivesrek.edit');
Route::post('/arsip/archivesrek/update/{id}','Arsip\ArchivesrekController@update')->name('archivesrek.update');
Route::get('/arsip/archivesrek/deleteper/{id}','Arsip\ArchivesrekController@deleteper')->name('archivesrek.deleteper');
Route::get('/arsip/archivesrek/deletelist/{id}','Arsip\ArchivesrekController@deletelist')->name('archivesrek.deletelist');

//Route untuk Laporan Arsip
Route::post('/arsip/reportarchive/cetak','Arsip\ReportarchiveController@cetak')->name('reportarchive.cetak');

//Route setup web terkait
Route::get('/arsip/terkait/create','Arsip\TerkaitController@create')->name('terkait.create');
Route::post('/arsip/terkait/store','Arsip\TerkaitController@store')->name('terkait.store');
Route::get('/arsip/terkait/delete/{id}','Arsip\TerkaitController@delete')->name('terkait.delete');
Route::get('/arsip/terkait/edit/{id}','Arsip\TerkaitController@edit')->name('terkait.edit');
Route::post('/arsip/terkait/update/{id}','Arsip\TerkaitController@update')->name('terkait.update');