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

//import
Route::get('/import','ImportExcelController@index')->name('import');
Route::post('/import/jabasn','ImportExcelController@jabasn')->name('import.jabasn');
Route::post('/import/users','ImportExcelController@users')->name('import.users');
Route::post('/import/inventaris','ImportExcelController@inventaris')->name('import.inventaris');
Route::post('/import/stok','ImportExcelController@stok')->name('import.stok');

//qrcode
Route::get('/qR/{id}/inventaris','Invent\InventarisController@detail')->name('inventaris.detail');
Route::get('/qR/{id}/calibration','Calibration\GlassKualController@detail')->name('calibration.detail');

//-------------------------------------------------------------------------------------------

  Route::group(['middleware' => 'auth'], function(){
  Route::get('/portal','PortalController@index')->name('dashboard');
  Route::get('/profile','ProfileController@index')->name('profile');
  Route::get('/notifications','NotifController@index')->name('notif');
  Route::get('/carousel','CarouselController@index')->name('carousel');


  //Route untuk Kalender
  Route::get('/calendars','CalendarController@index')->name('calendars');
  Route::get('/calendars/lihat/{id}','CalendarController@lihat')->name('calendars.lihat');
  Route::get('/calendars/getData','CalendarController@getData')->name('calendars.getData');


  //Route untuk dashboard
  //--------------------------Invent------------------------------------------
  Route::get('/invent/dashboard','Invent\DashboardController@index')->name('dashboard');

  //--------------------------ANANG GALUH------------------------------------------
  Route::get('/finance/portalAG','Finance\PortalAGController@index')->name('dashboard');

  Route::get('/finance/dashboard','Finance\DashboardController@index')->name('dashboard');
  Route::get('/finance/dashboarddin','Finance\DashboarddinController@index')->name('dashboard');
  Route::get('/finance/dashboardren','Finance\DashboardrenController@index')->name('dashboard');
  Route::get('/finance/dashboardforma','Finance\DashboardformaController@index')->name('dashboard');
  
  //--------------------------AMDK------------------------------------------
  Route::get('/amdk/dashboard','Amdk\DashboardController@index')->name('dashboard');

  //--------------------------Arsiparis------------------------------------------
  Route::get('/arsip/dashboard','Arsip\DashboardController@index')->name('dashboard');

  //--------------------------calibration------------------------------------------
  Route::get('/calibration/dashboard','Calibration\DashboardController@index')->name('dashboard');
  Route::get('/calibration/dashboardnapza','Calibration\DashboardNapzaController@index')->name('dashboard');
  Route::get('/calibration/dashboardtomiku','Calibration\DashboardTomikuController@index')->name('dashboard');

   //--------------------------QMS------------------------------------------
   Route::get('/qms/dashboard','Qms\DashboardController@index')->name('dashboard');


  //Route untuk Profile
  Route::post('/profile/update/{id}','ProfileController@update')->name('profile.update');
  Route::get('/profile/deleteanak/{id}','ProfileController@deleteanak')->name('profile.deleteanak');
  Route::get('/profile/deletesaudara/{id}','ProfileController@deletesaudara')->name('profile.deletesaudara');
  Route::get('/profile/deletepen/{id}','ProfileController@deletepen')->name('profile.deletepen');
  Route::get('/profile/deletedok/{id}','ProfileController@deletedok')->name('profile.deletedok');
  Route::get('/profile/deletepengalaman/{id}','ProfileController@deletepengalaman')->name('profile.deletepengalaman');
  Route::get('/profile/deletedokpeg/{id}','ProfileController@deletedokpeg')->name('profile.deletedokpeg');
  Route::post('/profile/updateFotoProfile','ProfileController@updateFoto')->name('profile.updatefoto');

  //--------------------------Invent------------------------------------------
  require __DIR__.'/invent.php';
  //--------------------------AMDK------------------------------------------
  require __DIR__.'/amdk.php';
  //--------------------------Finance------------------------------------------
  require __DIR__.'/finance.php';
  //--------------------------Arsiparis------------------------------------------
  require __DIR__.'/arsip.php';
  //--------------------------QMS------------------------------------------
  require __DIR__.'/qms.php';
  // //--------------------------calibration------------------------------------------
  require __DIR__.'/calibration.php';

});

Route::group(['middleware' => ['auth','userPermission']], function(){

    //--------------------------Invent------------------------------------------

    //Route untuk inventaris
    Route::get('/invent/inventaris','Invent\InventarisController@index')->name('inventaris');
    //Route untuk BMN LAB
    Route::get('/invent/bmnlab','Invent\BmnLabController@index')->name('bmnlab');
    //Route untuk disposable inventaris
    Route::get('/invent/disposable','Invent\DisposableController@index')->name('disposable');
    //Route untuk persediaan Lab
    Route::get('/invent/labsuply','Invent\LabSuplyController@index')->name('labsuply');
    //Route untuk maintenance
    Route::get('/invent/maintenance','Invent\MaintenanceController@index')->name('maintenance');
    //Route untuk Barang keluar
     Route::get('/invent/barangkeluar','Invent\BarangkeluarController@index')->name('barangkeluar');
    //Route untuk Stok Rusak
    Route::get('/invent/broken','Invent\BrokenController@index')->name('broken');
    //Route untuk BMN Rusak
    Route::get('/invent/brokenBMN','Invent\BrokenBMNController@index')->name('brokenBMN');
    //Route untuk aduan
    Route::get('/invent/aduan','Invent\AduanController@index')->name('aduan');
    Route::get('/invent/aduan/bidang','Invent\AduanController@bidang')->name('aduan.bidang');
    //Route untuk aduanTIK
    Route::get('/invent/aduantik','Invent\AduanTikController@index')->name('aduantik');
    Route::get('/invent/aduantik/bidang','Invent\AduanTikController@bidang')->name('aduantik.bidang');
    //Route untuk Pengajuan Barang Baru
    Route::get('/invent/pengajuan','Invent\PengajuanController@index')->name('pengajuan');
    //Route untuk Permintaan Barang Lab di gudang
     Route::get('/invent/labrequest','Invent\LabRequestController@index')->name('labrequest');
    //Route untuk Permintaan Barang ATK di gudang
    Route::get('/invent/atkrequest','Invent\AtkRequestController@index')->name('atkrequest');
    //Route untuk Persetujuan Permintaan Barang Baru
    Route::get('/invent/persetujuan','Invent\PersetujuanController@index')->name('persetujuan');
    //Route untuk Persetujuan Permintaan Barang Lab di gudang
    Route::get('/invent/labrequestok','Invent\LabRequestOkController@index')->name('labrequestok');
    //Route untuk Persetujuan Permintaan Barang ATK di gudang
    Route::get('/invent/atkrequestok','Invent\AtkRequestOkController@index')->name('atkrequestok');
    //Route untuk kendaraan
    Route::get('/invent/vehicle','Invent\VehicleController@index')->name('vehicle');
    //Route untuk lokasi
    Route::get('invent/lokasi','Invent\LokasiController@index')->name('lokasi');
    //Route untuk petugas
    Route::get('/invent/petugas','Invent\PetugasController@index')->name('petugas');
    //Route untuk Pinjam Mobil
    Route::get('/invent/carrent','Invent\CarrentController@index')->name('carrent');
    //Route untuk setujui peminjaman
    Route::get('/invent/carok','Invent\CarOkController@index')->name('carok');
    //Route untuk Laporan
    Route::get('/invent/laporan','Invent\LaporanController@index')->name('laporan');
    //Route untuk Laporan peminjaman
    Route::get('/invent/lappinjam','Invent\LapPinjamController@index')->name('lappinjam');
    //Route untuk Laporan Pengajuan
    Route::get('/invent/lapajuan','Invent\LapAjuController@index')->name('lapajuan');
    //Route untuk Laporan stok barang
    Route::get('/invent/kartustok','Invent\KartuStokController@index')->name('kartustok');
    //Route untuk sbbfiles
    Route::get('/invent/sbbfiles','Invent\SbbController@index')->name('sbbfiles');
    //Route untuk rekapsbb
    Route::get('/invent/rekapsbb','Invent\RekapSbbController@index')->name('rekapsbb');
    //Route untuk Perencanaan Pengadaan Lab
    Route::get('/invent/planlab','Invent\PlanLabController@index')->name('planlab');
    Route::get('/invent/planlab/daftar','Invent\PlanLabController@daftar')->name('planlab.daftar');

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
    //Route agenda
    Route::get('/amdk/agenda','Amdk\AgendaController@index')->name('agenda');
    //Route untuk jurusan
    Route::get('/amdk/kategori','Amdk\KategoriController@index')->name('kategori');
    //Route untuk rekaman personel
    Route::get('/amdk/record','Amdk\RecordController@index')->name('record');
    //Route untuk Surat Izin Pramubakti
    Route::get('/amdk/permit','Amdk\PermitController@index')->name('permit');
    //Route untuk Surat Izin Pramubakti
    Route::get('/amdk/rekpermit','Amdk\RekpermitController@index')->name('rekpermit');
    //Route untuk Setup Angka Kredit
    Route::get('/amdk/ak','Amdk\CreditsController@index')->name('ak');
    //Route untuk SKP
    Route::get('/amdk/skp','Amdk\SkpController@index')->name('skp');
    //Route untuk Kegiatan Perencanaan
    Route::get('/amdk/planning','Amdk\PlanningController@index')->name('planning');
    //Route untuk Kegiatan Pengembangan
    Route::get('/amdk/development','Amdk\DevelopmentController@index')->name('development');
    //Route untuk Kegiatan penunjang
    Route::get('/amdk/support','Amdk\SupportController@index')->name('support');
    //disposisi
    Route::get('/amdk/disposisi','Amdk\DisposisiController@index')->name('disposisi');
    Route::get('/amdk/rekdisposisi','Amdk\DisposisiController@index')->name('disposisi.rekdisposisi');
    //Route untuk hari libur
    Route::get('/amdk/libur','Amdk\LiburController@index')->name('libur');
    //Route untuk absen
    Route::get('/amdk/setabsen','Amdk\SetabsenController@index')->name('setabsen');
    


    //--------------------------Finance------------------------------------------
    //-----Surat Tugas--------
      //Route untuk pegawai
      Route::get('/amdk/outsourcing','Amdk\OutsourcingController@index')->name('outsourcing');
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
      //Route untuk Kuitansi
      Route::get('/finance/travelexpenses','Finance\TravelexpensesController@index')->name('travelexpenses');
      //Route untuk laporan DL
      Route::get('/finance/outreport','Finance\OutReportController@index')->name('outreport');
      //Route untuk buku ST
      Route::get('/finance/stbook','Finance\STBookController@index')->name('stbook');
      //Route untuk laporan nominatif Surat
      Route::get('/finance/nominatif','Finance\NominatifController@index')->name('nominatif');

    //-----Anggaran--------
   
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
      
   
    //-----e-planning--------

      //Route untuk Sasaran Kegiatan
      Route::get('/finance/ikuTarget','Finance\IkuTargetController@index')->name('ikuTarget');
      //Route untuk Indikator Kinerja
      Route::get('/finance/ikuIndicator','Finance\IkuIndicatorController@index')->name('ikuIndicator');
      //Route untuk petugas
      Route::get('/finance/petugas','Finance\PetugasController@index')->name('petugasmon');
      //Route untuk Tagging
      Route::get('/finance/ikutagging','Finance\IkuTaggingController@index')->name('ikutagging');
      //Route untuk Renstra Nasional
      Route::get('/finance/renstranas','Finance\RenstranasController@index')->name('renstranas');
      //Route untuk Renstra Lokal
      Route::get('/finance/renstrakal','Finance\RenstrakalController@index')->name('renstrakal');
      //Route untuk laporan Renstra
      Route::get('/finance/renstrapot','Finance\RenstraPotController@index')->name('renstrapot');
      //Route untuk Eselon II
      Route::get('/finance/eselontwo','Finance\EselonTwoController@index')->name('eselontwo');

    //-----e-performance--------
     //Route untuk Realisasi RAPK
     Route::get('/finance/realRAPK','Finance\RealRAPKController@index')->name('realRAPK');
     //Route untuk Setup RAPK
     Route::get('/finance/setupRAPK','Finance\SetupRAPKController@index')->name('setupRAPK');
     //Route untuk laporan RAPK
     Route::get('/finance/lapRAPK','Finance\LapRAPKController@index')->name('lapRAPK');


    //--------------------------Arsip------------------------------------------
     //Route untuk Subkelompok Surat
     Route::get('/arsip/mailsubgroup','Arsip\MailSubGroupController@index')->name('mailsubgroup');
     //Route untuk Klasifikasi Surat
     Route::get('/arsip/mailclasification','Arsip\MailClasificationController@index')->name('mailclasification');
     //Route untuk Arsip
     Route::get('/arsip/archives','Arsip\ArchivesController@index')->name('archives');
     //Route untuk Bentuk NAskah
     Route::get('/arsip/archivesbid','Arsip\ArchivesbidController@index')->name('archivesbid');
     //Route untuk rekap Arsip
     Route::get('/arsip/archivesrek','Arsip\ArchivesrekController@index')->name('archivesrek');
     //Route untuk daftar Arsip
     Route::get('/arsip/archiveslist','Arsip\ArchiveslistController@index')->name('archiveslist');
     //Route untuk Laporan Arsip
     Route::get('/arsip/reportarchive','Arsip\ReportarchiveController@index')->name('reportarchive');


     //--------------------------QMS------------------------------------------
     //Route untuk input qms
     Route::get('/qms/inputqms','Qms\InputQMSController@index')->name('inputqms');
     //Route untuk qms mikro
     Route::get('/qms/mikro','Qms\MikroController@index')->name('mikro');
     //Route untuk qms
     Route::get('/qms/makro','Qms\MakroController@index')->name('makro');
     //Route untuk folder QMS
     Route::get('/qms/folderqms','Qms\FolderQMSController@index')->name('folderqms');


    //-------------------------------------------Pengujian-------------------------------------------------
    //----NAPPZA----
    //Route untuk Alat Gelas Kualitatif
    Route::get('/calibration/glasskual','Calibration\GlassKualController@index')->name('glasskual');
    Route::get('/calibration/glasskual/read','Calibration\GlassKualController@read')->name('glasskual.read');
    //Route untuk input Alat Gelas Kuantitatif
    Route::get('/calibration/glasskuan','Calibration\GlassKuanController@index')->name('glasskuan');
    Route::get('/calibration/glasskuan/read','Calibration\GlassKuanController@read')->name('glasskuan.read');
    //Route untuk Laporan Stok Barang
    Route::get('/calibration/napzastock','Calibration\NapzastockController@index')->name('napzastock');
    //Route untuk Laporan Stok Opname
    Route::get('/calibration/napzaopname','Calibration\NapzaopnameController@index')->name('napzaopname');
    

    //----MIKRO----
    //Route untuk Media Mikrobiologi
    Route::get('/calibration/mediamikro','Calibration\MediaController@index')->name('media');
    //Route untuk kontrol Media Mikro
    Route::get('/calibration/kontrolmikro','Calibration\KontrolController@index')->name('kontrol');
    //Route untuk Daftar Bakteri
    Route::get('/calibration/bakterimikro','Calibration\BakteriController@index')->name('bakteri');

    //Route untuk Daftar Bakteri
    Route::get('/calibration/mikroba','Calibration\MikrobaController@index')->name('mikroba');

});


