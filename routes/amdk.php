<?php
  //Profile

  //Route untuk pegawai
  Route::get('/amdk/pegawai/create','Amdk\PegawaiController@create')->name('pegawai.create');
  Route::post('/amdk/pegawai/store','Amdk\PegawaiController@store')->name('pegawai.store');
  Route::get('/amdk/pegawai/edit/{id}','Amdk\PegawaiController@edit')->name('pegawai.edit');
  Route::post('/amdk/pegawai/update/{id}','Amdk\PegawaiController@update')->name('pegawai.update');
  Route::get('/amdk/pegawai/detail/{id}','Amdk\PegawaiController@detail')->name('pegawai.detail');
  // Route::post('/amdk/pegawai/storesaudara','Amdk\PegawaiController@storesaudara')->name('pegawai.storesaudara');

   //Route untuk outsourcing
   Route::get('/amdk/outsourcing/create','Amdk\OutsourcingController@create')->name('outsourcing.create');
   Route::post('/amdk/outsourcing/store','Amdk\OutsourcingController@store')->name('outsourcing.store');
   Route::get('/amdk/outsourcing/edit/{id}','Amdk\OutsourcingController@edit')->name('outsourcing.edit');
   Route::post('/amdk/outsourcing/update/{id}','Amdk\OutsourcingController@update')->name('outsourcing.update');

  //Route untuk pengumuman
  Route::get('/amdk/pengumuman/create','Amdk\PengumumanController@create')->name('pengumuman.create');
  Route::post('/amdk/pengumuman/store','Amdk\PengumumanController@store')->name('pengumuman.store');
  Route::get('/amdk/pengumuman/edit/{id}','Amdk\PengumumanController@edit')->name('pengumuman.edit');
  Route::post('/amdk/pengumuman/update/{id}','Amdk\PengumumanController@update')->name('pengumuman.update');
  Route::get('/amdk/pengumuman/delete/{id}','Amdk\PengumumanController@delete')->name('pengumuman.delete');

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
  Route::get('/amdk/jurusan/getpend','Amdk\JurusanController@getpend')->name('jurusan.getpend');

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
  Route::get('/amdk/pelatihan/rekappeg','Amdk\PelatihanController@rekappeg')->name('pelatihan.rekappeg');
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
  Route::post('/amdk/rekapdupak/cetak','Amdk\RekDupakController@cetak')->name('rekapdupak.cetak');

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

  //Route untuk Rapel Kredit
  Route::get('/amdk/credit_poin/create','Amdk\CreditPoinController@create')->name('credit_poin.create');
  Route::post('/amdk/credit_poin/store','Amdk\CreditPoinController@store')->name('credit_poin.store');
  Route::get('/amdk/credit_poin/delete/{id}','Amdk\CreditPoinController@delete')->name('credit_poin.delete');
  Route::get('/amdk/credit_poin/edit/{id}','Amdk\CreditPoinController@edit')->name('credit_poin.edit');
  Route::post('/amdk/credit_poin/update/{id}','Amdk\CreditPoinController@update')->name('credit_poin.update');

  //Route untuk absen
  Route::get('/amdk/ttdabsen/create','Amdk\TtdAbsenController@create')->name('ttdabsen.create');
  Route::post('/amdk/ttdabsen/store','Amdk\TtdAbsenController@store')->name('ttdabsen.store');

  //Route agenda
  Route::get('/amdk/agenda/create','Amdk\AgendaController@create')->name('agenda.create');
  Route::post('/amdk/agenda/store','Amdk\AgendaController@store')->name('agenda.store');
  Route::get('/amdk/agenda/delete/{id}','Amdk\AgendaController@delete')->name('agenda.delete');
  Route::get('/amdk/agenda/edit/{id}','Amdk\AgendaController@edit')->name('agenda.edit');
  Route::post('/amdk/agenda/update/{id}','Amdk\AgendaController@update')->name('agenda.update');

  //Route untuk kategori
  Route::post('/amdk/kategori/store','Amdk\KategoriController@store')->name('kategori.store');
  Route::get('/amdk/kategori/edit/{id}','Amdk\KategoriController@edit')->name('kategori.edit');
  Route::post('/amdk/kategori/update/{id}','Amdk\KategoriController@update')->name('kategori.update');

  //Route untuk rekaman personel
  Route::post('/amdk/record/cetak','Amdk\RecordController@cetak')->name('record.cetak');

  //Route untuk Setup Angka Kredit
  Route::get('/amdk/ak/create','Amdk\CreditsController@create')->name('ak.create');
  Route::post('/amdk/ak/store','Amdk\CreditsController@store')->name('ak.store');
  Route::get('/amdk/ak/delete/{id}','Amdk\CreditsController@delete')->name('ak.delete');
  Route::get('/amdk/ak/edit/{id}','Amdk\CreditsController@edit')->name('ak.edit');
  Route::post('/amdk/ak/update/{id}','Amdk\CreditsController@update')->name('ak.update');
  Route::get('/amdk/ak/getSubDivisi','Amdk\CreditsController@getunsur')->name('ak.getunsur');
  Route::get('/amdk/ak/getnilai','Amdk\CreditsController@getnilai')->name('ak.getnilai');

  //Route untuk SKP
  Route::get('/amdk/skp/create','Amdk\SkpController@create')->name('skp.create');
  Route::post('/amdk/skp/store','Amdk\SkpController@store')->name('skp.store');
  Route::get('/amdk/skp/delete/{id}','Amdk\SkpController@delete')->name('skp.delete');
  Route::get('/amdk/skp/edit/{id}','Amdk\SkpController@edit')->name('skp.edit');
  Route::post('/amdk/skp/update/{id}','Amdk\SkpController@update')->name('skp.update');
  Route::get('/amdk/skp/deletedet/{id}','Amdk\SkpController@deletedet')->name('skp.deletedet');
  Route::get('/amdk/skp/print/{id}','Amdk\SkpController@print')->name('skp.print');
  Route::get('/amdk/skp/getdata','Amdk\SkpController@getdata')->name('skp.getdata');

  //Route untuk Kegiatan Perencanaan
  Route::get('/amdk/planning/create','Amdk\PlanningController@create')->name('planning.create');
  Route::post('/amdk/planning/store','Amdk\PlanningController@store')->name('planning.store');
  Route::get('/amdk/planning/delete/{id}','Amdk\PlanningController@delete')->name('planning.delete');
  Route::get('/amdk/planning/edit/{id}','Amdk\PlanningController@edit')->name('planning.edit');
  Route::post('/amdk/planning/update/{id}','Amdk\PlanningController@update')->name('planning.update');
  Route::get('/amdk/planning/deletedet/{id}','Amdk\PlanningController@deletedet')->name('planning.deletedet');
  Route::get('/amdk/planning/print/{id}','Amdk\PlanningController@print')->name('planning.print');
  Route::get('/amdk/planning/print2/{id}','Amdk\PlanningController@print2')->name('planning.print2');

  //Route untuk Kegiatan Pengembangan
  Route::get('/amdk/development/create','Amdk\DevelopmentController@create')->name('development.create');
  Route::post('/amdk/development/store','Amdk\DevelopmentController@store')->name('development.store');
  Route::get('/amdk/development/delete/{id}','Amdk\DevelopmentController@delete')->name('development.delete');
  Route::get('/amdk/development/deletedet/{id}','Amdk\DevelopmentController@deletedet')->name('development.deletedet');
  Route::get('/amdk/development/edit/{id}','Amdk\DevelopmentController@edit')->name('development.edit');
  Route::post('/amdk/development/update/{id}','Amdk\DevelopmentController@update')->name('development.update');
  Route::get('/amdk/development/print/{id}','Amdk\DevelopmentController@print')->name('development.print');

  //Route untuk Kegiatan penunjang
  Route::get('/amdk/support/create','Amdk\SupportController@create')->name('support.create');
  Route::post('/amdk/support/store','Amdk\SupportController@store')->name('support.store');
  Route::get('/amdk/support/delete/{id}','Amdk\SupportController@delete')->name('support.delete');
  Route::get('/amdk/support/deletedet/{id}','Amdk\SupportController@deletedet')->name('support.deletedet');
  Route::get('/amdk/support/edit/{id}','Amdk\SupportController@edit')->name('support.edit');
  Route::post('/amdk/support/update/{id}','Amdk\SupportController@update')->name('support.update');
  Route::get('/amdk/support/print/{id}','Amdk\SupportController@print')->name('support.print');

   //Route untuk Disposisi
  Route::get('/amdk/disposisi/create','Amdk\DisposisiController@create')->name('disposisi.create');
  Route::post('/amdk/disposisi/store','Amdk\DisposisiController@store')->name('disposisi.store');
  Route::get('/amdk/disposisi/delete/{id}','Amdk\DisposisiController@delete')->name('disposisi.delete');
  Route::get('/amdk/disposisi/edit/{id}','Amdk\DisposisiController@edit')->name('disposisi.edit');
  Route::post('/amdk/disposisi/update/{id}','Amdk\DisposisiController@update')->name('disposisi.update');

 //Route untuk Hari libur
 Route::get('/amdk/libur/create','Amdk\LiburController@create')->name('libur.create');
 Route::post('/amdk/libur/store','Amdk\LiburController@store')->name('libur.store');
 Route::get('/amdk/libur/delete/{id}','Amdk\LiburController@delete')->name('libur.delete');
 Route::get('/amdk/libur/edit/{id}','Amdk\LiburController@edit')->name('libur.edit');
 Route::post('/amdk/libur/update/{id}','Amdk\LiburController@update')->name('libur.update');

 //Route untuk absen
 Route::post('/amdk/setabsen/update/{id}','Amdk\SetabsenController@update')->name('setabsen.update');

 //Route untuk Setup TTD
 Route::get('/amdk/setupttd/create','Amdk\SetTTDController@create')->name('setupttd.create');
 Route::post('/amdk/setupttd/store','Amdk\SetTTDController@store')->name('setupttd.store');
 Route::get('/amdk/setupttd/delete/{id}','Amdk\SetTTDController@delete')->name('setupttd.delete');
 Route::get('/amdk/setupttd/edit/{id}','Amdk\SetTTDController@edit')->name('setupttd.edit');
 Route::post('/amdk/setupttd/update/{id}','Amdk\SetTTDController@update')->name('setupttd.update');
