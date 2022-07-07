<?php
//Route untuk Input QMS
Route::get('/qms/inputqms/create','Qms\InputQMSController@create')->name('inputqms.create');
Route::post('/qms/inputqms/store','Qms\InputQMSController@store')->name('inputqms.store');
Route::get('/qms/inputqms/edit/{id}','Qms\InputQMSController@edit')->name('inputqms.edit');
Route::post('/qms/inputqms/update/{id}','Qms\InputQMSController@update')->name('inputqms.update');
Route::get('qms/inputqms/delete/{id}','Qms\InputQMSController@delete')->name('inputqms.delete');

