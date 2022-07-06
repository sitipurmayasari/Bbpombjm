<?php
//Route untuk Subkelompok Surat
Route::get('/qms/mailsubgroup/create','Qms\MailSubGroupController@create')->name('mailsubgroup.create');
Route::post('/qms/mailsubgroup/store','Qms\MailSubGroupController@store')->name('mailsubgroup.store');
Route::get('/qms/mailsubgroup/edit/{id}','Qms\MailSubGroupController@edit')->name('mailsubgroup.edit');
Route::post('/qms/mailsubgroup/update/{id}','Qms\MailSubGroupController@update')->name('mailsubgroup.update');

