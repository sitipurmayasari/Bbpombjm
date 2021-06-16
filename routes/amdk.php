<?php

  //Route untuk pegawai
  Route::get('/amdk/pegawai/create','Amdk\PegawaiController@create')->name('pegawai.create');
  Route::post('/amdk/pegawai/store','Amdk\PegawaiController@store')->name('pegawai.store');
  Route::get('/amdk/pegawai/edit/{id}','Amdk\PegawaiController@edit')->name('pegawai.edit');
  Route::post('/amdk/pegawai/update/{id}','Amdk\PegawaiController@update')->name('pegawai.update');
  Route::get('/amdk/pegawai/detail/{id}','Amdk\PegawaiController@detail')->name('pegawai.detail');
  // Route::post('/amdk/pegawai/storesaudara','Amdk\PegawaiController@storesaudara')->name('pegawai.storesaudara');

  //Route untuk pengumuman
  Route::get('/amdk/pengumuman/create','Amdk\PengumumanController@create')->name('pengumuman.create');
  Route::post('/amdk/pengumuman/store','Amdk\PengumumanController@store')->name('pengumuman.store');
  Route::get('/amdk/pengumuman/edit/{id}','Amdk\PengumumanController@edit')->name('pengumuman.edit');
  Route::post('/amdk/pengumuman/update/{id}','Amdk\PengumumanController@update')->name('pengumuman.update');

  //Route untuk keluarga
  Route::get('/amdk/keluarga/getKeluarga','Amdk\KeluargaController@getKeluarga')->name('keluarga.getKeluarga');
  Route::post('/amdk/keluarga/storeortu','Amdk\KeluargaController@storeortu')->name('keluarga.storeortu');
  Route::post('/amdk/keluarga/storemertua','Amdk\KeluargaController@storemertua')->name('keluarga.storemertua');
  Route::post('/amdk/keluarga/storeanak','Amdk\KeluargaController@storeanak')->name('keluarga.storeanak');
  Route::post('/amdk/keluarga/storesaudara','Amdk\KeluargaController@storesaudara')->name('keluarga.storesaudara');
  Route::post('/amdk/keluarga/storeistri','Amdk\KeluargaController@storeistri')->name('keluarga.storeistri');
  Route::get('/amdk/keluarga/deleteanak/{id}','Amdk\KeluargaController@deleteanak')->name('keluarga.deleteanak');
  Route::get('/amdk/keluarga/deletesaudara/{id}','Amdk\KeluargaController@deletesaudara')->name('keluarga.deletesaudara');
  Route::get('/amdk/keluarga/dataperanak','Amdk\KeluargaController@dataperanak')->name('keluarga.dataperanak');
  Route::get('/amdk/keluarga/datapersaudara','Amdk\KeluargaController@datapersaudara')->name('keluarga.datapersaudara');
  Route::post('/amdk/keluarga/updateanak/{id}','Amdk\KeluargaController@updateanak')->name('keluarga.updateanak');
  Route::post('/amdk/keluarga/updatesaudara/{id}','Amdk\KeluargaController@updatesaudara')->name('keluarga.updatesaudara');

  //Route untuk dokumen
  Route::get('/amdk/dokumen/getData','Amdk\DokumenController@getData')->name('dokumen.getData');
  Route::post('/amdk/dokumen/store','Amdk\DokumenController@store')->name('dokumen.store');
  Route::get('/amdk/dokumen/datadok','Amdk\DokumenController@datadok')->name('dokumen.datadok');
  Route::get('/amdk/dokumen/delete/{id}','Amdk\DokumenController@delete')->name('dokumen.delete');
  Route::post('/amdk/dokumen/update/{id}','Amdk\DokumenController@update')->name('dokumen.update');

  //Route untuk dokpeg
  Route::get('/amdk/dokpeg/getData','Amdk\DokpegController@getData')->name('dokpeg.getData');
  Route::post('/amdk/dokpeg/store','Amdk\DokpegController@store')->name('dokpeg.store');
  Route::get('/amdk/dokpeg/datadokpeg','Amdk\DokpegController@datadokpeg')->name('dokpeg.datadokpeg');
  Route::get('/amdk/dokpeg/delete/{id}','Amdk\DokpegController@delete')->name('dokpeg.delete');
  Route::post('/amdk/dokpeg/update/{id}','Amdk\DokpegController@update')->name('dokpeg.update');
  

  //Route untuk pengalaman
  Route::get('/amdk/pengalaman/getData','Amdk\PengalamanController@getData')->name('pengalaman.getData');
  Route::post('/amdk/pengalaman/store','Amdk\PengalamanController@store')->name('pengalaman.store');
  Route::get('/amdk/pengalaman/dataker','Amdk\PengalamanController@dataker')->name('pengalaman.dataker');
  Route::get('/amdk/pengalaman/delete/{id}','Amdk\PengalamanController@delete')->name('pengalaman.delete');
  Route::post('/amdk/pengalaman/update/{id}','Amdk\PengalamanController@update')->name('pengalaman.update');

  //Route untuk hak akses
  Route::get('/amdk/getMenu','Amdk\AksesController@getMenuUser')->name('akses.getMenu');
  Route::post('/amdk/akses/store','Amdk\AksesController@store')->name('akses.store');
  Route::post('/amdk/akses/update/{id}','Amdk\AksesController@update')->name('akses.update');

  //Route untuk jurusan
  Route::post('/amdk/jurusan/store','Amdk\JurusanController@store')->name('jurusan.store');
  Route::get('/amdk/jurusan/delete/{id}','Amdk\JurusanController@delete')->name('jurusan.delete');
  Route::get('/amdk/jurusan/edit/{id}','Amdk\JurusanController@edit')->name('jurusan.edit');
  Route::post('/amdk/jurusan/update/{id}','Amdk\JurusanController@update')->name('jurusan.update');

  //Route untuk riwayat pendidikan
  Route::get('/amdk/riwayatpend/getData','Amdk\RiwayatPendController@getData')->name('riwayatpend.getData');
  Route::post('/amdk/riwayatpend/store','Amdk\RiwayatPendController@store')->name('riwayatpend.store');
  Route::get('/amdk/riwayatpend/datapen','Amdk\RiwayatPendController@datapen')->name('riwayatpend.datapen');
  Route::get('/amdk/riwayatpend/delete/{id}','Amdk\RiwayatPendController@delete')->name('riwayatpend.delete');
  Route::post('/amdk/riwayatpend/update/{id}','Amdk\RiwayatPendController@update')->name('riwayatpend.update');

  //Route untuk divisi
  Route::get('/amdk/divisi/create','Amdk\DivisiController@create')->name('divisi.create');
  Route::post('/amdk/divisi/store','Amdk\DivisiController@store')->name('divisi.store');
  Route::get('/amdk/divisi/edit/{id}','Amdk\DivisiController@edit')->name('divisi.edit');
  Route::post('/amdk/divisi/update/{id}','Amdk\DivisiController@update')->name('divisi.update');
  Route::get('/amdk/divisi/delete/{id}','Amdk\DivisiController@delete')->name('divisi.delete');
  Route::get('/amdk/divisi/getSubDivisi','Amdk\DivisiController@getSubDivisi')->name('divisi.getDivisi');

  //Route untuk jabatan
  Route::get('/amdk/jabatan/create','Amdk\JabatanController@create')->name('jabatan.create');
  Route::post('/amdk/jabatan/store','Amdk\JabatanController@store')->name('jabatan.store');
  Route::get('/amdk/jabatan/delete/{id}','Amdk\JabatanController@delete')->name('jabatan.delete');
  Route::get('/amdk/jabatan/edit/{id}','Amdk\JabatanController@edit')->name('jabatan.edit');
  Route::post('/amdk/jabatan/update/{id}','Amdk\JabatanController@update')->name('jabatan.update');

  //Route untuk jabasn
  Route::get('/amdk/jabasn/create','Amdk\JabasnController@create')->name('jabasn.create');
  Route::post('/amdk/jabasn/store','Amdk\JabasnController@store')->name('jabasn.store');
  Route::get('/amdk/jabasn/delete/{id}','Amdk\JabasnController@delete')->name('jabasn.delete');
  Route::get('/amdk/jabasn/edit/{id}','Amdk\JabasnController@edit')->name('jabasn.edit');
  Route::post('/amdk/jabasn/update/{id}','Amdk\JabasnController@update')->name('jabasn.update');


   //Route untuk tukin
   Route::get('/amdk/tukin/create','Amdk\TukinController@create')->name('tukin.create');
   Route::get('/amdk/tukin/getAsn','Amdk\TukinController@getAsn')->name('tukin.getAsn');
   Route::post('/amdk/tukin/store','Amdk\TukinController@store')->name('tukin.store');
   Route::get('/amdk/tukin/delete/{id}','Amdk\TukinController@delete')->name('tukin.delete');
   Route::get('/amdk/tukin/edit/{id}','Amdk\TukinController@edit')->name('tukin.edit');
   Route::post('/amdk/tukin/update/{id}','Amdk\TukinController@update')->name('tukin.update');
   Route::get('/amdk/tukin/print/{id}','Amdk\TukinController@print')->name('tukin.print');
   Route::post('/amdk/tukin/impor','Amdk\TukinController@impor')->name('tukin.impor');

   //Route untuk dosir
  Route::get('/amdk/dosir/create','Amdk\DosirController@create')->name('dosir.create');
  Route::post('/amdk/dosir/store','Amdk\DosirController@store')->name('dosir.store');
  Route::get('/amdk/dosir/delete/{id}','Amdk\DosirController@delete')->name('dosir.delete');
  Route::get('/amdk/dosir/edit/{id}','Amdk\DosirController@edit')->name('dosir.edit');
  Route::post('/amdk/dosir/update/{id}','Amdk\DosirController@update')->name('dosir.update');

  //Route untuk pelatihan
  Route::get('/amdk/pelatihan/create','Amdk\PelatihanController@create')->name('pelatihan.create');
  Route::get('/amdk/pelatihan/createadmin','Amdk\PelatihanController@createadmin')->name('pelatihan.createadmin');
  Route::post('/amdk/pelatihan/store','Amdk\PelatihanController@store')->name('pelatihan.store');
  Route::get('/amdk/pelatihan/delete/{id}','Amdk\PelatihanController@delete')->name('pelatihan.delete');
  Route::get('/amdk/pelatihan/edit/{id}','Amdk\PelatihanController@edit')->name('pelatihan.edit');
  Route::get('/amdk/pelatihan/editadmin/{id}','Amdk\PelatihanController@editadmin')->name('pelatihan.editadmin');
  Route::post('/amdk/pelatihan/update/{id}','Amdk\PelatihanController@update')->name('pelatihan.update');
  Route::get('/amdk/pelatihan/rekap','Amdk\PelatihanController@rekap')->name('pelatihan.rekap');
  Route::post('/amdk/pelatihan/cetak','Amdk\PelatihanController@cetak')->name('pelatihan.cetak');


  //Route untuk dupak
  Route::get('/amdk/dupak','Amdk\DupakController@index')->name('dupak');
  Route::get('/amdk/dupak/create','Amdk\DupakController@create')->name('dupak.create');
  Route::get('/amdk/dupak/getDataPeg','Amdk\DupakController@getDataPeg')->name('dupak.getDataPeg');
  Route::post('/amdk/dupak/store','Amdk\DupakController@store')->name('dupak.store');
  Route::get('/amdk/dupak/delete/{id}','Amdk\DupakController@delete')->name('dupak.delete');
  Route::get('/amdk/dupak/edit/{id}','Amdk\DupakController@edit')->name('dupak.edit');
  Route::post('/amdk/dupak/update/{id}','Amdk\DupakController@update')->name('dupak.update');
  Route::get('/amdk/dupak/print/{id}','Amdk\DupakController@print')->name('dupak.print');

  //Route untuk masa arsip
  Route::get('/amdk/archive_time/create','Amdk\ArchiveTimeController@create')->name('archive_time.create');
  Route::post('/amdk/archive_time/store','Amdk\ArchiveTimeController@store')->name('archive_time.store');
  Route::get('/amdk/archive_time/delete/{id}','Amdk\ArchiveTimeController@delete')->name('archive_time.delete');
  Route::get('/amdk/archive_time/edit/{id}','Amdk\ArchiveTimeController@edit')->name('archive_time.edit');
  Route::post('/amdk/archive_time/update/{id}','Amdk\ArchiveTimeController@update')->name('archive_time.update');

  //Route untuk dinas
  Route::get('/amdk/outstation/create','Amdk\OutstationController@create')->name('outstation.create');
  Route::post('/amdk/outstation/store','Amdk\OutstationController@store')->name('outstation.store');
  Route::get('/amdk/outstation/delete/{id}','Amdk\OutstationController@delete')->name('outstation.delete');
  Route::get('/amdk/outstation/edit/{id}','Amdk\OutstationController@edit')->name('outstation.edit');
  Route::post('/amdk/outstation/update/{id}','Amdk\OutstationController@update')->name('outstation.update');

  