<?php
//Route untuk Input QMS
Route::get('/qms/inputqms/create','Qms\InputQMSController@create')->name('inputqms.create');
Route::post('/qms/inputqms/store','Qms\InputQMSController@store')->name('inputqms.store');
Route::get('/qms/inputqms/edit/{id}','Qms\InputQMSController@edit')->name('inputqms.edit');
Route::post('/qms/inputqms/update/{id}','Qms\InputQMSController@update')->name('inputqms.update');
Route::get('qms/inputqms/delete/{id}','Qms\InputQMSController@delete')->name('inputqms.delete');

//Route untuk Folder QMS
Route::get('/qms/folderqms/create','Qms\FolderQMSController@create')->name('folderqms.create');
Route::post('/qms/folderqms/store','Qms\FolderQMSController@store')->name('folderqms.store');
Route::get('/qms/folderqms/edit/{id}','Qms\FolderQMSController@edit')->name('folderqms.edit');
Route::post('/qms/folderqms/update/{id}','Qms\FolderQMSController@update')->name('folderqms.update');
Route::get('qms/folderqms/delete/{id}','Qms\FolderQMSController@delete')->name('folderqms.delete');

 //Route untuk qms mikro
 Route::get('/qms/mikro/folder/{id}','Qms\MikroController@folder')->name('mikro.folder');
 //Route untuk qms
 Route::get('/qms/makro/folder/{id}','Qms\MakroController@folder')->name('makro.folder');