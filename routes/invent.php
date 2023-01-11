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

  //Route untuk BMN LAB
  Route::get('/invent/bmnlab/create','Invent\BmnLabController@create')->name('bmnlab.create');
  Route::post('/invent/bmnlab/store','Invent\BmnLabController@store')->name('bmnlab.store');
  Route::get('/invent/bmnlab/edit/{id}','Invent\BmnLabController@edit')->name('bmnlab.edit');
  Route::post('/invent/bmnlab/update/{id}','Invent\BmnLabController@update')->name('bmnlab.update');
  Route::get('/invent/bmnlab/delete/{id}','Invent\BmnLabController@delete')->name('bmnlab.delete');
  Route::get('/invent/bmnlab/jadwal/{id}','Invent\BmnLabController@jadwal')->name('bmnlab.jadwal');
  Route::post('/invent/bmnlab/storejadwal','Invent\BmnLabController@storejadwal')->name('bmnlab.storejadwal');
  Route::get('/invent/bmnlab/getBarang','Invent\BmnLabController@getBarang')->name('bmnlab.getbarang');

  //Route untuk disposable inventaris
  Route::get('/invent/disposable/create','Invent\DisposableController@create')->name('disposable.create');
  Route::post('/invent/disposable/store','Invent\DisposableController@store')->name('disposable.store');
  Route::get('/invent/disposable/edit/{id}','Invent\DisposableController@edit')->name('disposable.edit');
  Route::post('/invent/disposable/update/{id}','Invent\DisposableController@update')->name('disposable.update');
  Route::get('/invent/disposable/delete/{id}','Invent\DisposableController@delete')->name('disposable.delete');
  Route::get('/invent/disposable/qrcode/{id}','Invent\DisposableController@qrcode')->name('disposable.qrcode');
  Route::get('/invent/disposable/stock/{id}','Invent\DisposableController@stock')->name('disposable.stock');
  Route::post('/invent/disposable/storestock','Invent\DisposableController@storestock')->name('disposable.storestock');
  Route::get('/invent/disposable/ubahstok/{id}','Invent\DisposableController@ubahstok')->name('disposable.ubahstok');
  Route::post('/invent/disposable/updatestok/{id}','Invent\DisposableController@updatestok')->name('disposable.updatestok');

  //Route untuk persediaan Lab
  Route::get('/invent/labsuply/create','Invent\LabSuplyController@create')->name('labsuply.create');
  Route::post('/invent/labsuply/store','Invent\LabSuplyController@store')->name('labsuply.store');
  Route::get('/invent/labsuply/edit/{id}','Invent\LabSuplyController@edit')->name('labsuply.edit');
  Route::post('/invent/labsuply/update/{id}','Invent\LabSuplyController@update')->name('labsuply.update');
  Route::get('/invent/labsuply/delete/{id}','Invent\LabSuplyController@delete')->name('labsuply.delete');
  Route::get('/invent/labsuply/qrcode/{id}','Invent\LabSuplyController@qrcode')->name('labsuply.qrcode');
  Route::get('/invent/labsuply/stock/{id}','Invent\LabSuplyController@stock')->name('labsuply.stock');
  Route::post('/invent/labsuply/storestock','Invent\LabSuplyController@storestock')->name('labsuply.storestock');
  Route::get('/invent/labsuply/ubahstok/{id}','Invent\LabSuplyController@ubahstok')->name('labsuply.ubahstok');
  Route::post('/invent/labsuply/updatestok/{id}','Invent\LabSuplyController@updatestok')->name('labsuply.updatestok');
  Route::get('/invent/labsuply/deletestock/{id}','Invent\LabSuplyController@deletestock')->name('labsuply.deletestock');
  

  //Route untuk maintenance
  Route::post('/invent/maintenance/store','Invent\MaintenanceController@store')->name('maintenance.store');
  Route::get('/invent/maintenance/create','Invent\MaintenanceController@create')->name('maintenance.create');
  Route::get('/invent/maintenance/edit/{id}','Invent\MaintenanceController@edit')->name('maintenance.edit');
  Route::post('/invent/maintenance/update/{id}','Invent\MaintenanceController@update')->name('maintenance.update');
  Route::get('/invent/maintenance/delete/{id}','Invent\MaintenanceController@delete')->name('maintenance.delete');
  Route::get('/invent/maintenance/getKelompok','Invent\MaintenanceController@getKelompok')->name('maintenance.getKelompok');
  Route::get('/invent/maintenance/getBarang','Invent\MaintenanceController@getBarang')->name('maintenance.getbarang');
  Route::get('/invent/maintenance/cetak/{id}','Invent\MaintenanceController@cetak')->name('maintenance.cetak');
  
  //Route untuk aduan
  Route::get('/invent/aduan/create','Invent\AduanController@create')->name('aduan.create');
  Route::post('/invent/aduan/store','Invent\AduanController@store')->name('aduan.store');
  Route::post('/invent/aduan/update/{id}','Invent\AduanController@update')->name('aduan.update');
  Route::get('/invent/aduan/print/{id}','Invent\AduanController@print')->name('aduan.print');
  Route::get('/invent/aduan/detail/{id}','Invent\AduanController@detail')->name('aduan.detail');
  Route::get('/invent/aduan/edit/{id}','Invent\AduanController@edit')->name('aduan.edit');
  Route::post('/invent/aduan/perbaharui/{id}','Invent\AduanController@perbaharui')->name('aduan.perbaharui');
  Route::get('/invent/aduan/delete/{id}','Invent\AduanController@delete')->name('aduan.delete');
  Route::get('/invent/aduan/deletedet/{id}','Invent\AduanController@deletedet')->name('aduan.deletedet');

  //Route untuk aduan TIK
  Route::get('/invent/aduantik/create','Invent\AduanTikController@create')->name('aduantik.create');
  Route::get('/invent/aduantik/create2','Invent\AduanTikController@create2')->name('aduantik.create2');
  Route::get('/invent/aduantik/getbidangadu','Invent\AduanTikController@getbidangadu')->name('aduantik.getbidangadu');
  Route::get('/invent/aduantik/getbidangadu','Invent\AduanTikController@getbidangadu')->name('aduantik.getbidangadu');
  Route::get('/invent/aduantik/getbarang','Invent\AduanTikController@getbarang')->name('aduantik.getbarang');
  Route::post('/invent/aduantik/store','Invent\AduanTikController@store')->name('aduantik.store');
  Route::get('/invent/aduantik/edit/{id}','Invent\AduanTikController@edit')->name('aduantik.edit');
  Route::post('/invent/aduantik/update/{id}','Invent\AduanTikController@update')->name('aduantik.update');
  Route::post('/invent/aduantik/perbaharui/{id}','Invent\AduanTikController@perbaharui')->name('aduantik.perbaharui');
  Route::get('/invent/aduantik/print/{id}','Invent\AduanTikController@print')->name('aduantik.print');
  Route::get('/invent/aduantik/printhasil/{id}','Invent\AduanTikController@printhasil')->name('aduantik.printhasil');
  Route::get('/invent/aduantik/detail/{id}','Invent\AduanTikController@detail')->name('aduantik.detail');
  Route::get('/invent/aduantik/delete/{id}','Invent\AduanTikController@delete')->name('aduantik.delete');
  Route::get('/invent/aduantik/detail2/{id}','Invent\AduanTikController@detail2')->name('aduantik.detail2');
  Route::post('/invent/aduantik/update2/{id}','Invent\AduanTikController@update2')->name('aduantik.update2');
  Route::post('/invent/aduantik/perbaharui2/{id}','Invent\AduanTikController@perbaharui2')->name('aduantik.perbaharui2');
  Route::get('/invent/aduantik/delete2/{id}','Invent\AduanTikController@delete2')->name('aduantik.delete2');
  Route::get('/invent/aduantik/print2/{id}','Invent\AduanTikController@print2')->name('aduantik.print2');
  Route::get('/invent/aduantik/printhasil2/{id}','Invent\AduanTikController@printhasil2')->name('aduantik.printhasil2');
  Route::get('/invent/aduantik/edit2/{id}','Invent\AduanTikController@edit2')->name('aduantik.edit2');
  
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
  Route::get('/invent/labrequest/ubah/{id}','Invent\LabRequestController@ubah')->name('labrequest.ubah');
  Route::post('/invent/labrequest/update/{id}','Invent\LabRequestController@update')->name('labrequest.update');
  Route::get('/invent/labrequest/getExp','Invent\LabRequestController@getExp')->name('labrequest.getExp');
  Route::post('/invent/labrequest/updatestat/{id}','Invent\LabRequestController@updatestat')->name('labrequest.updatestat');

  //Route untuk Permintaan Barang ATK di gudang
  Route::get('/invent/atkrequest/create','Invent\AtkRequestController@create')->name('atkrequest.create');
  Route::post('/invent/atkrequest/store','Invent\AtkRequestController@store')->name('atkrequest.store');
  Route::get('/invent/atkrequest/print/{id}','Invent\AtkRequestController@print')->name('atkrequest.print');
  Route::get('/invent/atkrequest/ubah/{id}','Invent\AtkRequestController@ubah')->name('atkrequest.ubah');
  Route::post('/invent/atkrequest/update/{id}','Invent\AtkRequestController@update')->name('atkrequest.update');
  Route::post('/invent/atkrequest/updatestat/{id}','Invent\AtkRequestController@updatestat')->name('atkrequest.updatestat');
  Route::get('/invent/atkrequest/getBarang','Invent\AtkRequestController@getBarang')->name('atkrequest.getbarang');
  Route::get('/invent/atkrequest/getKelompok','Invent\AtkRequestController@getKelompok')->name('atkrequest.getKelompok');
  
   //Route untuk Barang Keluar
   Route::get('/invent/barangkeluar/create','Invent\BarangkeluarController@create')->name('barangkeluar.create');
   Route::post('/invent/barangkeluar/store','Invent\BarangkeluarController@store')->name('barangkeluar.store');
   Route::get('/invent/barangkeluar/print/{id}','Invent\BarangkeluarController@print')->name('barangkeluar.print');
   Route::get('/invent/barangkeluar/getBarang','Invent\BarangkeluarController@getBarang')->name('barangkeluar.getbarang');
   Route::get('/invent/barangkeluar/edit/{id}','Invent\BarangkeluarController@edit')->name('barangkeluar.edit');
   Route::post('/invent/barangkeluar/update/{id}','Invent\BarangkeluarController@update')->name('barangkeluar.update');

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
  Route::get('invent/vehicle/editjadwal/{id}','Invent\VehicleController@editjadwal')->name('vehicle.editjadwal');
  Route::post('invent/vehicle/updatejadwal/{id}','Invent\VehicleController@updatejadwal')->name('vehicle.updatejadwal');
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

  //Route untuk Barang Rusak
  Route::get('/invent/broken/create','Invent\BrokenController@create')->name('broken.create');
  Route::post('/invent/broken/store','Invent\BrokenController@store')->name('broken.store');
  Route::get('/invent/broken/print/{id}','Invent\BrokenController@print')->name('broken.print');
  Route::get('/invent/broken/getBarang','Invent\BrokenController@getBarang')->name('broken.getbarang');
  Route::get('/invent/broken/edit/{id}','Invent\BrokenController@edit')->name('broken.edit');
  Route::post('/invent/broken/update/{id}','Invent\BrokenController@update')->name('broken.update');
    

   //Route untuk sbbfiles
   Route::get('/invent/sbbfiles/create','Invent\SbbController@create')->name('sbbfiles.create');
   Route::post('/invent/sbbfiles/store','Invent\SbbController@store')->name('sbbfiles.store');
   Route::get('/invent/sbbfiles/delete/{id}','Invent\SbbController@delete')->name('sbbfiles.delete');
   Route::get('/invent/sbbfiles/edit/{id}','Invent\SbbController@edit')->name('sbbfiles.edit');
   Route::post('/invent/sbbfiles/update/{id}','Invent\SbbController@update')->name('sbbfiles.update');

   //Route untuk rekapsbb
   Route::get('/invent/rekapsbb/create','Invent\RekapSbbController@create')->name('rekapsbb.create');
   Route::post('/invent/rekapsbb/store','Invent\RekapSbbController@store')->name('rekapsbb.store');
   Route::get('/invent/rekapsbb/delete/{id}','Invent\RekapSbbController@delete')->name('rekapsbb.delete');
   Route::get('/invent/rekapsbb/edit/{id}','Invent\RekapSbbController@edit')->name('rekapsbb.edit');
   Route::post('/invent/rekapsbb/update/{id}','Invent\RekapSbbController@update')->name('rekapsbb.update');

   //Route untuk BMN Rusak
  Route::get('/invent/brokenBMN/create','Invent\BrokenBMNController@create')->name('brokenBMN.create');
  Route::post('/invent/brokenBMN/store','Invent\BrokenBMNController@store')->name('brokenBMN.store');
  Route::get('/invent/brokenBMN/print/{id}','Invent\BrokenBMNController@print')->name('brokenBMN.print');
  Route::get('/invent/brokenBMN/edit/{id}','Invent\BrokenBMNController@edit')->name('brokenBMN.edit');
  Route::post('/invent/brokenBMN/update/{id}','Invent\BrokenBMNController@update')->name('brokenBMN.update');
  Route::get('/invent/brokenBMN/delete/{id}','Invent\BrokenBMNController@delete')->name('brokenBMN.delete');
  Route::get('/invent/brokenBMN/deletelist/{id}','Invent\BrokenBMNController@deletelist')->name('brokenBMN.deletelist');

  //Route untuk Perencanaan Pengadaan Lab
  Route::get('/invent/planlab/create','Invent\PlanLabController@create')->name('planlab.create');
  Route::post('/invent/planlab/store','Invent\PlanLabController@store')->name('planlab.store');
  Route::get('/invent/planlab/print/{id}','Invent\PlanLabController@print')->name('planlab.print');
  Route::get('/invent/planlab/print2/{id}','Invent\PlanLabController@print2')->name('planlab.print2');
  Route::get('/invent/planlab/edit/{id}','Invent\PlanLabController@edit')->name('planlab.edit');
  Route::post('/invent/planlab/update/{id}','Invent\PlanLabController@update')->name('planlab.update');
  Route::get('/invent/planlab/delete/{id}','Invent\PlanLabController@delete')->name('planlab.delete');

  //Route untuk  pERALATAN TIK
  Route::get('/invent/itasset/create','Invent\ITAssetController@create')->name('itasset.create');
  Route::post('/invent/itasset/store','Invent\ITAssetController@store')->name('itasset.store');
  Route::get('/invent/itasset/edit/{id}','Invent\ITAssetController@edit')->name('itasset.edit');
  Route::post('/invent/itasset/update/{id}','Invent\ITAssetController@update')->name('itasset.update');
  Route::get('/invent/itasset/delete/{id}','Invent\ITAssetController@delete')->name('itasset.delete');
  Route::get('/invent/itasset/getbarangtik','Invent\ITAssetController@getbarangtik')->name('itasset.getbarangtik');