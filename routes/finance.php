<?php

  //Route untuk kendaraan
  Route::get('/invent/vehicle/create','Invent\VehicleController@create')->name('vehicle.create');
  Route::post('invent/vehicle/store','Invent\VehicleController@store')->name('vehicle.store');
  Route::get('invent/vehicle/delete/{id}','Invent\VehicleController@delete')->name('vehicle.delete');
  Route::get('invent/vehicle/edit/{id}','Invent\VehicleController@edit')->name('vehicle.edit');
  Route::post('invent/vehicle/update/{id}','Invent\VehicleController@update')->name('vehicle.update');
