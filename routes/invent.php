<?php
//Route untuk lokasi
  Route::post('invent/lokasi/store','Invent\LokasiController@store')->name('lokasi.store');
  Route::get('invent/lokasi/delete/{id}','Invent\LokasiController@delete')->name('lokasi.delete');
  Route::get('invent/lokasi/edit/{id}','Invent\LokasiController@edit')->name('lokasi.edit');
  Route::post('invent/lokasi/update/{id}','Invent\LokasiController@update')->name('lokasi.update');

   //Route untuk petugas
   Route::post('/invent/petugas/store','Invent\PetugasController@store')->name('petugas.store');
   Route::get('/invent/petugas/delete/{id}','Invent\PetugasController@delete')->name('petugas.delete');
   Route::get('/invent/petugas/edit/{id}','Invent\PetugasController@edit')->name('petugas.edit');
   Route::post('/invent/petugas/update/{id}','Invent\PetugasController@update')->name('petugas.update');

  //Route untuk inventaris
  Route::get('/invent/inventaris/create','Invent\InventarisController@create')->name('inventaris.create');
  Route::post('/invent/inventaris/store','Invent\InventarisController@store')->name('inventaris.store');
  Route::get('/invent/inventaris/edit/{id}','Invent\InventarisController@edit')->name('inventaris.edit');
  Route::post('/invent/inventaris/update/{id}','Invent\InventarisController@update')->name('inventaris.update');
  Route::get('/invent/inventaris/delete/{id}','Invent\InventarisController@delete')->name('inventaris.delete');
  Route::get('/invent/inventaris/jadwal/{id}','Invent\InventarisController@jadwal')->name('inventaris.jadwal');
  Route::post('/invent/inventaris/storejadwal','Invent\InventarisController@storejadwal')->name('inventaris.storejadwal');
  Route::get('/invent/inventaris/getBarang','Invent\InventarisController@getBarang')->name('inventaris.getbarang');

  //Route untuk maintenance
  Route::post('/invent/maintenance/store','Invent\MaintenanceController@store')->name('maintenance.store');
  Route::get('/invent/maintenance/create','Invent\MaintenanceController@create')->name('maintenance.create');
  Route::get('/invent/maintenance/edit/{id}','Invent\MaintenanceController@edit')->name('maintenance.edit');
  Route::post('/invent/maintenance/update/{id}','Invent\MaintenanceController@update')->name('maintenance.update');
  Route::get('/invent/maintenance/delete/{id}','Invent\MaintenanceController@delete')->name('maintenance.delete');

  //Route untuk aduan
  Route::get('/invent/aduan/create','Invent\AduanController@create')->name('aduan.create');
  Route::get('/invent/aduan/create2','Invent\AduanController@create')->name('aduan.create');
  Route::post('/invent/aduan/store','Invent\AduanController@store')->name('aduan.store');
  Route::post('/invent/aduan/update/{id}','Invent\AduanController@update')->name('aduan.update');
  Route::get('/invent/aduan/print/{id}','Invent\AduanController@print')->name('aduan.print');
  Route::get('/invent/aduan/detail/{id}','Invent\AduanController@detail')->name('aduan.detail');

  //Route untuk pengajuan
  Route::get('/invent/pengajuan/create','Invent\PengajuanController@create')->name('pengajuan.create');
  Route::post('/invent/pengajuan/store','Invent\PengajuanController@store')->name('pengajuan.store');
  Route::get('/invent/pengajuan/edit/{id}','Invent\PengajuanController@edit')->name('pengajuan.edit');
  Route::post('/invent/pengajuan/update/{id}','Invent\PengajuanController@update')->name('pengajuan.update');
  Route::get('/invent/pengajuan/print/{id}','Invent\PengajuanController@print')->name('pengajuan.print');
  Route::get('/invent/pengajuan/detail/{id}','Invent\PengajuanController@detail')->name('pengajuan.detail');

   //Route untuk Barang Keluar
   Route::get('/invent/barangkeluar/create','Invent\BarangkeluarController@create')->name('barangkeluar.create');
   Route::post('/invent/barangkeluar/store','Invent\BarangkeluarController@store')->name('barangkeluar.store');
  //  Route::get('/invent/barangkeluar/edit/{id}','Invent\BarangkeluarController@edit')->name('barangkeluar.edit');
  //  Route::post('/invent/barangkeluar/update/{id}','Invent\BarangkeluarController@update')->name('barangkeluar.update');
   Route::get('/invent/barangkeluar/print/{id}','Invent\BarangkeluarController@print')->name('barangkeluar.print');

  //Route untuk Laporan
  Route::post('/invent/laporan/cetak','Invent\LaporanController@cetak')->name('laporan.cetak');
