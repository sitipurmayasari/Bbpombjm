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
  Route::get('/invent/inventaris/qrcode/{id}','Invent\InventarisController@qrcode')->name('inventaris.qrcode');

  //Route untuk disposable inventaris
  Route::get('/invent/disposable/create','Invent\DisposableController@create')->name('disposable.create');
  Route::post('/invent/disposable/store','Invent\DisposableController@store')->name('disposable.store');
  Route::get('/invent/disposable/edit/{id}','Invent\DisposableController@edit')->name('disposable.edit');
  Route::post('/invent/disposable/update/{id}','Invent\DisposableController@update')->name('disposable.update');
  Route::get('/invent/disposable/delete/{id}','Invent\DisposableController@delete')->name('disposable.delete');
  Route::get('/invent/disposable/qrcode/{id}','Invent\DisposableController@qrcode')->name('disposable.qrcode');
  Route::get('/invent/disposable/stock/{id}','Invent\DisposableController@stock')->name('disposable.stock');
  Route::post('/invent/disposable/storestock','Invent\DisposableController@storestock')->name('disposable.storestock');

  //Route untuk persediaan Lab
  Route::get('/invent/labsuply/create','Invent\LabSuplyController@create')->name('labsuply.create');
  Route::post('/invent/labsuply/store','Invent\LabSuplyController@store')->name('labsuply.store');
  Route::get('/invent/labsuply/edit/{id}','Invent\LabSuplyController@edit')->name('labsuply.edit');
  Route::post('/invent/labsuply/update/{id}','Invent\LabSuplyController@update')->name('labsuply.update');
  Route::get('/invent/labsuply/delete/{id}','Invent\LabSuplyController@delete')->name('labsuply.delete');
  Route::get('/invent/labsuply/qrcode/{id}','Invent\LabSuplyController@qrcode')->name('labsuply.qrcode');
  Route::get('/invent/labsuply/stock/{id}','Invent\LabSuplyController@stock')->name('labsuply.stock');
  Route::post('/invent/labsuply/storestock','Invent\LabSuplyController@storestock')->name('labsuply.storestock');
  

  //Route untuk maintenance
  Route::post('/invent/maintenance/store','Invent\MaintenanceController@store')->name('maintenance.store');
  Route::get('/invent/maintenance/create','Invent\MaintenanceController@create')->name('maintenance.create');
  Route::get('/invent/maintenance/edit/{id}','Invent\MaintenanceController@edit')->name('maintenance.edit');
  Route::post('/invent/maintenance/update/{id}','Invent\MaintenanceController@update')->name('maintenance.update');
  Route::get('/invent/maintenance/delete/{id}','Invent\MaintenanceController@delete')->name('maintenance.delete');

  //Route untuk aduan
  Route::post('/invent/aduan/store','Invent\AduanController@store')->name('aduan.store');
  Route::post('/invent/aduan/update/{id}','Invent\AduanController@update')->name('aduan.update');
  Route::get('/invent/aduan/print/{id}','Invent\AduanController@print')->name('aduan.print');
  Route::get('/invent/aduan/detail/{id}','Invent\AduanController@detail')->name('aduan.detail');

  //Route untuk aduan TIK
  Route::post('/invent/aduantik/store','Invent\AduanTikController@store')->name('aduantik.store');
  Route::post('/invent/aduantik/update/{id}','Invent\AduanTikController@update')->name('aduantik.update');
  Route::get('/invent/aduantik/print/{id}','Invent\AduanTikController@print')->name('aduantik.print');
  Route::get('/invent/aduantik/detail/{id}','Invent\AduanTikController@detail')->name('aduantik.detail');
  Route::get('/invent/aduantik/printhasil/{id}','Invent\AduanTikController@printhasil')->name('aduantik.printhasil');

  //Route untuk pengajuan barang baru
  Route::get('/invent/pengajuan/create','Invent\PengajuanController@create')->name('pengajuan.create');
  Route::post('/invent/pengajuan/store','Invent\PengajuanController@store')->name('pengajuan.store');
  Route::get('/invent/pengajuan/print/{id}','Invent\PengajuanController@print')->name('pengajuan.print');

  //Route untuk persetujuan barang baru
  Route::get('/invent/persetujuan/edit/{id}','Invent\PersetujuanController@edit')->name('persetujuan.edit');
  Route::post('/invent/persetujuan/update/{id}','Invent\PersetujuanController@update')->name('persetujuan.update');
  Route::get('/invent/persetujuan/print/{id}','Invent\PersetujuanController@print')->name('persetujuan.print');

  //Route untuk Permintaan Barang Lab di gudang
  Route::get('/invent/labrequest/create','Invent\LabRequestController@create')->name('labrequest.create');
  Route::post('/invent/labrequest/store','Invent\LabRequestController@store')->name('labrequest.store');
  Route::get('/invent/labrequest/print/{id}','Invent\LabRequestController@print')->name('labrequest.print');
  Route::get('/invent/labrequest/getBarang','Invent\LabRequestController@getBarang')->name('labrequest.getbarang');
  Route::get('/invent/labrequest/getKelompok','Invent\LabRequestController@getKelompok')->name('labrequest.getKelompok');

  //Route untuk Permintaan Barang ATK di gudang
  Route::get('/invent/atkrequest/create','Invent\AtkRequestController@create')->name('atkrequest.create');
  Route::post('/invent/atkrequest/store','Invent\AtkRequestController@store')->name('atkrequest.store');
  Route::get('/invent/atkrequest/print/{id}','Invent\AtkRequestController@print')->name('atkrequest.print');
  Route::get('/invent/atkrequest/getBarang','Invent\AtkRequestController@getBarang')->name('atkrequest.getbarang');
  Route::get('/invent/atkrequest/getKelompok','Invent\AtkRequestController@getKelompok')->name('atkrequest.getKelompok');
  
   //Route untuk Barang Keluar
   Route::get('/invent/barangkeluar/create','Invent\BarangkeluarController@create')->name('barangkeluar.create');
   Route::post('/invent/barangkeluar/store','Invent\BarangkeluarController@store')->name('barangkeluar.store');
   Route::get('/invent/barangkeluar/print/{id}','Invent\BarangkeluarController@print')->name('barangkeluar.print');
   Route::get('/invent/barangkeluar/getBarang','Invent\BarangkeluarController@getBarang')->name('barangkeluar.getbarang');

  //Route untuk Laporan
  Route::post('/invent/laporan/cetak','Invent\LaporanController@cetak')->name('laporan.cetak');
  Route::post('/invent/lappinjam/cetak','Invent\LapPinjamController@cetak')->name('lappinjam.cetak');
  Route::post('/invent/lapajuan/cetak','Invent\LapAjuController@cetak')->name('lapajuan.cetak');

  //Route untuk kendaraan
  Route::get('/invent/vehicle/create','Invent\VehicleController@create')->name('vehicle.create');
  Route::post('invent/vehicle/store','Invent\VehicleController@store')->name('vehicle.store');
  Route::get('invent/vehicle/delete/{id}','Invent\VehicleController@delete')->name('vehicle.delete');
  Route::get('invent/vehicle/edit/{id}','Invent\VehicleController@edit')->name('vehicle.edit');
  Route::post('invent/vehicle/update/{id}','Invent\VehicleController@update')->name('vehicle.update');
  Route::get('/invent/vehicle/jadwal/{id}','Invent\VehicleController@jadwal')->name('vehicle.jadwal');
  Route::post('/invent/vehicle/storejadwal','Invent\VehicleController@storejadwal')->name('vehicle.storejadwal');
  Route::get('invent/vehicle/deletejadwal/{id}','Invent\VehicleController@deletejadwal')->name('vehicle.deletejadwal');
  Route::get('/invent/vehicle/matriks','Invent\VehicleController@matriks')->name('vehicle.matriks');

  //Route untuk Pinjam Mobil
  Route::get('/invent/carrent/create','Invent\CarrentController@create')->name('carrent.create');
  Route::post('invent/carrent/store','Invent\CarrentController@store')->name('carrent.store');
  Route::get('invent/carrent/delete/{id}','Invent\CarrentController@delete')->name('carrent.delete');
  Route::get('/invent/carrent/ubah/{id}','Invent\CarrentController@ubah')->name('carrent.ubah');
  Route::get('/invent/carrent/edit/{id}','Invent\CarrentController@edit')->name('carrent.edit'); // ---->cetak sih aslinya

  //Route untuk setujui peminjaman
  Route::get('invent/carok/yes/{id}','Invent\CarOkController@yes')->name('carok.yes');
  Route::get('invent/carok/edit/{id}','Invent\CarOkController@edit')->name('carok.edit');
  Route::post('invent/carok/update/{id}','Invent\CarOkController@update')->name('carok.update');
  Route::post('invent/carok/revisi/{id}','Invent\CarOkController@revisi')->name('carok.revisi');

  //Route untuk Laporan stok barang
  Route::post('/invent/kartustok/cetak','Invent\KartuStokController@cetak')->name('kartustok.cetak');

  //Route untuk Persetujuan Permintaan Barang Lab di gudang
  Route::get('invent/labrequestok/yes/{id}','Invent\LabRequestOkController@yes')->name('labrequestok.yes');
  Route::get('invent/labrequestok/print/{id}','Invent\LabRequestOkController@print')->name('labrequestok.print');
  Route::post('invent/labrequestok/update/{id}','Invent\LabRequestOkController@update')->name('labrequestok.update');
  
  //Route untuk Persetujuan Permintaan Barang ATK di gudang
  Route::get('invent/atkrequestok/yes/{id}','Invent\AtkRequestOkController@yes')->name('atkrequestok.yes');
  Route::get('invent/atkrequestok/print/{id}','Invent\AtkRequestOkController@print')->name('atkrequestok.print');
  Route::post('invent/atkrequestok/update/{id}','Invent\AtkRequestOkController@update')->name('atkrequestok.update');
    
