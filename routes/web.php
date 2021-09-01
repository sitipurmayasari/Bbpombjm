<?php

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','LoginController@index')->name('login');
Route::post('/login','LoginController@auth')->name('auth');
Route::get('/logout','LoginController@logout')->name('logout');
Route::get('/forgot','ForgotController@index')->name('forgot');
Route::post('/forgot/store','ForgotController@store')->name('forgot.store');
Route::get('/fgt/{id}/forgot','ForgotController@pageChangePassword')->name('forgot.change');
Route::post('/forgot/{id}/update','ForgotController@updatePassword')->name('forgot.update');

Route::get('/import','ImportExcelController@index')->name('import');
Route::post('/import/jabasn','ImportExcelController@jabasn')->name('import.jabasn');
Route::post('/import/users','ImportExcelController@users')->name('import.users');
Route::post('/import/inventaris','ImportExcelController@inventaris')->name('import.inventaris');
Route::post('/import/stok','ImportExcelController@stok')->name('import.stok');
Route::get('/qR/{id}/inventaris','Invent\InventarisController@detail')->name('inventaris.detail');

  Route::group(['middleware' => 'auth'], function(){
  Route::get('/portal','PortalController@index')->name('dashboard');
  Route::get('/profile','ProfileController@index')->name('profile');
  Route::get('/carousel','CarouselController@index')->name('carousel');

  //Route untuk dashboard
  //--------------------------Invent------------------------------------------
  Route::get('/invent/dashboard','Invent\DashboardController@index')->name('dashboard');
  //--------------------------Finance------------------------------------------
  Route::get('/finance/dashboard','Finance\DashboardController@index')->name('dashboard');
  //--------------------------AMDK------------------------------------------
  Route::get('/amdk/dashboard','Amdk\DashboardController@index')->name('dashboard');



  //Route untuk Profile
  Route::post('/profile/update/{id}','ProfileController@update')->name('profile.update');
  Route::get('/profile/deleteanak/{id}','ProfileController@deleteanak')->name('profile.deleteanak');
  Route::get('/profile/deletesaudara/{id}','ProfileController@deletesaudara')->name('profile.deletesaudara');
  Route::get('/profile/deletepen/{id}','ProfileController@deletepen')->name('profile.deletepen');
  Route::get('/profile/deletedok/{id}','ProfileController@deletedok')->name('profile.deletedok');
  Route::get('/profile/deletepengalaman/{id}','ProfileController@deletepengalaman')->name('profile.deletepengalaman');
  Route::get('/profile/deletedokpeg/{id}','ProfileController@deletedokpeg')->name('profile.deletedokpeg');
  //--------------------------Invent------------------------------------------
  require __DIR__.'/invent.php';
  //--------------------------AMDK------------------------------------------
  require __DIR__.'/amdk.php';
  //--------------------------Finance------------------------------------------
  require __DIR__.'/finance.php';

});

Route::group(['middleware' => ['auth','userPermission']], function(){

    //--------------------------Invent------------------------------------------

    //Route untuk inventaris
    Route::get('/invent/inventaris','Invent\InventarisController@index')->name('inventaris');
    //Route untuk disposable inventaris
    Route::get('/invent/disposable','Invent\DisposableController@index')->name('disposable');
    //Route untuk maintenance
    Route::get('/invent/maintenance','Invent\MaintenanceController@index')->name('maintenance');
     //Route untuk Barang keluar
     Route::get('/invent/barangkeluar','Invent\BarangkeluarController@index')->name('barangkeluar');
    //Route untuk aduan
    Route::get('/invent/aduan','Invent\AduanController@index')->name('aduan');
    //Route untuk aduanTIK
    Route::get('/invent/aduantik','Invent\AduanTikController@index')->name('aduantik');
    //Route untuk Pengajuan
    Route::get('/invent/pengajuan','Invent\PengajuanController@index')->name('pengajuan');
    //Route untuk Laporan
    Route::get('/invent/laporan','Invent\LaporanController@index')->name('laporan');
    //Route untuk kendaraan
    Route::get('/invent/vehicle','Invent\VehicleController@index')->name('vehicle');
    //Route untuk lokasi
    Route::get('invent/lokasi','Invent\LokasiController@index')->name('lokasi');
    //Route untuk petugas
    Route::get('/invent/petugas','Invent\PetugasController@index')->name('petugas');


    //--------------------------AMDK------------------------------------------
    //Route untuk pegawai
    Route::get('/amdk/pegawai','Amdk\PegawaiController@index')->name('pegawai');
    //Route untuk pengumuman
    Route::get('/amdk/pengumuman','Amdk\PengumumanController@index')->name('pengumuman');
    //Route untuk keluarga
    Route::get('/amdk/keluarga','Amdk\KeluargaController@index')->name('keluarga');
    //Route untuk dokumen
    Route::get('/amdk/dokumen','Amdk\DokumenController@index')->name('dokumen');
    //Route untuk pengalaman
    Route::get('/amdk/pengalaman','Amdk\PengalamanController@index')->name('pengalaman');
    //Route untuk hak akses
    Route::get('/amdk/akses','Amdk\AksesController@index')->name('akses');
    //Route untuk jurusan
    Route::get('/amdk/jurusan','Amdk\JurusanController@index')->name('jurusan');
    //Route untuk divisi
    Route::get('/amdk/divisi','Amdk\DivisiController@index')->name('divisi');
    //Route untuk jabatan
    Route::get('/amdk/jabatan','Amdk\JabatanController@index')->name('jabatan');
    //Route untuk riwayat pendidikan
     Route::get('/amdk/riwayatpend','Amdk\RiwayatPendController@index')->name('riwayatpend');
    //Route untuk jabasn
    Route::get('/amdk/jabasn','Amdk\JabasnController@index')->name('jabasn');
    //Route untuk tukin
    Route::get('/amdk/tukin','Amdk\TukinController@index')->name('tukin');
    //Route untuk dosir
    Route::get('/amdk/dosir','Amdk\DosirController@index')->name('dosir');
    //Route untuk pelatihan
    Route::get('/amdk/pelatihan','Amdk\PelatihanController@index')->name('pelatihan');
    //Route untuk Rekap
    Route::get('/amdk/rekapdosir','Amdk\DosirController@rekapdosir')->name('rekapdosir');
    Route::get('/amdk/rekappelatihan','Amdk\PelatihanController@rekappelatihan')->name('rekappelatihan');
    Route::get('/amdk/rekapdupak','Amdk\RekDupakController@index')->name('rekapdupak');
    //Route untuk dupak
    Route::get('/amdk/dupak','Amdk\DupakController@index')->name('dupak');
    //Route untuk Angka Kredit
    Route::get('/amdk/dupak/kredit','Amdk\DupakController@kredit')->name('dupak.kredit');
    //Route untuk Rapel Kredit
    Route::get('/amdk/credit_poin','Amdk\CreditPoinController@index')->name('dupak.credit_poin');
    //Route untuk masa arsip
    Route::get('/amdk/archive_time','Amdk\ArchiveTimeController@index')->name('archive_time');
    //Route untuk absen
    Route::get('/amdk/ttdabsen','Amdk\TtdAbsenController@index')->name('ttdabsen');
    
    


    //--------------------------Finance------------------------------------------
    //Route untuk Kode Kementrian Lembaga
    Route::get('/finance/klcode','Finance\KlcodeController@index')->name('klcode');
    //Route untuk Kode Unit Kementrian Lembaga
    Route::get('/finance/unitcode','Finance\UnitcodeController@index')->name('unitcode');
    //Route untuk Kode Program Lembaga
    Route::get('/finance/programcode','Finance\ProgramcodeController@index')->name('programcode');
    //Route untuk Kode kegiatan
    Route::get('/finance/activitycode','Finance\ActivitycodeController@index')->name('activitycode');
    //Route untuk Kode KRO
    Route::get('/finance/krocode','Finance\KrocodeController@index')->name('krocode');
    //Route untuk Kode Rincian KRO
    Route::get('/finance/detailcode','Finance\DetailcodeController@index')->name('detailcode');
    //Route untuk Kode komponen
    Route::get('/finance/komponencode','Finance\KomponencodeController@index')->name('komponencode');
    //Route untuk Kode Sub komponen
    Route::get('/finance/subcode','Finance\SubcodeController@index')->name('subcode');
    //Route untuk Kode Akun
    Route::get('/finance/accountcode','Finance\AccountcodeController@index')->name('accountcode');
    //Route untuk Loka
    Route::get('/finance/loka','Finance\LokaController@index')->name('loka');
    //Route untuk Pelaksanaan Anggaran
    Route::get('/finance/implementation','Finance\ImplementController@index')->name('implementation');
    //Route untuk Revisi Pelaksanaan Anggaran
    Route::get('/finance/revision','Finance\RevisionController@index')->name('revision');
    //Route untuk Rekap Anggaran
    Route::get('/finance/rera','Finance\ReraController@index')->name('rera');
    //Route untuk Realisasi anggaran Anggaran
    Route::get('/finance/realisasi','Finance\RealisasiController@index')->name('realiasi');
    //Route untuk Sasaran Kegiatan
    Route::get('/finance/ikuTarget','Finance\IkuTargetController@index')->name('ikuTarget');
    //Route untuk Indikator Kinerja
    Route::get('/finance/ikuIndicator','Finance\IkuIndicatorController@index')->name('ikuIndicator');
    //Route untuk Daerah Tujuan
    Route::get('/finance/destination','Finance\DestinationController@index')->name('destination');
    //Route untuk PPK
    Route::get('/finance/ppk','Finance\PPKController@index')->name('ppk');
    //Route untuk Maskapai
    Route::get('/finance/plane','Finance\PlaneController@index')->name('plane');
    //Route untuk kode anggaran
    Route::get('/finance/budget','Finance\BudgetController@index')->name('budget');
    //Route untuk surat tugas
    Route::get('/finance/outstation','Finance\OutstationController@index')->name('outstation');


});


