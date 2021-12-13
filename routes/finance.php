<?php

  //Route untuk Kode Kementrian Lembaga
  Route::get('/finance/klcode/create','Finance\KlcodeController@create')->name('klcode.create');
  Route::post('finance/klcode/store','Finance\KlcodeController@store')->name('klcode.store');
  Route::get('finance/klcode/delete/{id}','Finance\KlcodeController@delete')->name('klcode.delete');
  Route::get('finance/klcode/edit/{id}','Finance\KlcodeController@edit')->name('klcode.edit');
  Route::post('finance/klcode/update/{id}','Finance\KlcodeController@update')->name('klcode.update');

  //Route untuk Kode Unit Kementrian Lembaga
  Route::get('/finance/unitcode/create','Finance\UnitcodeController@create')->name('unitcode.create');
  Route::post('finance/unitcode/store','Finance\UnitcodeController@store')->name('unitcode.store');
  Route::get('finance/unitcode/delete/{id}','Finance\UnitcodeController@delete')->name('unitcode.delete');
  Route::get('finance/unitcode/edit/{id}','Finance\UnitcodeController@edit')->name('unitcode.edit');
  Route::post('finance/unitcode/update/{id}','Finance\UnitcodeController@update')->name('unitcode.update');

   //Route untuk Kode Program Lembaga
  Route::get('/finance/programcode/create','Finance\ProgramcodeController@create')->name('programcode.create');
  Route::post('finance/programcode/store','Finance\ProgramcodeController@store')->name('programcode.store');
  Route::get('finance/programcode/delete/{id}','Finance\ProgramcodeController@delete')->name('programcode.delete');
  Route::get('finance/programcode/edit/{id}','Finance\ProgramcodeController@edit')->name('programcode.edit');
  Route::post('finance/programcode/update/{id}','Finance\ProgramcodeController@update')->name('programcode.update');

  //Route untuk Kode kegiatan
  Route::get('/finance/activitycode/create','Finance\ActivitycodeController@create')->name('activitycode.create');
  Route::post('finance/activitycode/store','Finance\ActivitycodeController@store')->name('activitycode.store');
  Route::get('finance/activitycode/delete/{id}','Finance\ActivitycodeController@delete')->name('activitycode.delete');
  Route::get('finance/activitycode/edit/{id}','Finance\ActivitycodeController@edit')->name('activitycode.edit');
  Route::post('finance/activitycode/update/{id}','Finance\ActivitycodeController@update')->name('activitycode.update');
  Route::get('/finance/activitycode/getprogLengkap','Finance\ActivitycodeController@getprogLengkap')->name('activitycode.getprogLengkap');

  //Route untuk Kode KRO
  Route::get('/finance/krocode/create','Finance\KrocodeController@create')->name('krocode.create');
  Route::post('finance/krocode/store','Finance\KrocodeController@store')->name('krocode.store');
  Route::get('finance/krocode/delete/{id}','Finance\KrocodeController@delete')->name('krocode.delete');
  Route::get('finance/krocode/edit/{id}','Finance\KrocodeController@edit')->name('krocode.edit');
  Route::post('finance/krocode/update/{id}','Finance\KrocodeController@update')->name('krocode.update');
  

  //Route untuk Kode Rincian KRO
  Route::get('/finance/detailcode/create','Finance\DetailcodeController@create')->name('detailcode.create');
  Route::post('finance/detailcode/store','Finance\DetailcodeController@store')->name('detailcode.store');
  Route::get('finance/detailcode/delete/{id}','Finance\DetailcodeController@delete')->name('detailcode.delete');
  Route::get('finance/detailcode/edit/{id}','Finance\DetailcodeController@edit')->name('detailcode.edit');
  Route::post('finance/detailcode/update/{id}','Finance\DetailcodeController@update')->name('detailcode.update');
  Route::get('/finance/detailcode/getRO','Finance\DetailcodeController@getRO')->name('detailcode.getRO');

  //Route untuk Kode komponen
  Route::get('/finance/komponencode/create','Finance\KomponencodeController@create')->name('komponencode.create');
  Route::post('finance/komponencode/store','Finance\KomponencodeController@store')->name('komponencode.store');
  Route::get('finance/komponencode/delete/{id}','Finance\KomponencodeController@delete')->name('komponencode.delete');
  Route::get('finance/komponencode/edit/{id}','Finance\KomponencodeController@edit')->name('komponencode.edit');
  Route::post('finance/komponencode/update/{id}','Finance\KomponencodeController@update')->name('komponencode.update');
  Route::get('finance/komponencode/getKomponen','Finance\KomponencodeController@getKomponen')->name('komponencode.getKomponen');


  //Route untuk Kode Sub komponen
  Route::get('/finance/subcode/create','Finance\SubcodeController@create')->name('subcode.create');
  Route::post('finance/subcode/store','Finance\SubcodeController@store')->name('subcode.store');
  Route::get('finance/subcode/delete/{id}','Finance\SubcodeController@delete')->name('subcode.delete');
  Route::get('finance/subcode/edit/{id}','Finance\SubcodeController@edit')->name('subcode.edit');
  Route::post('finance/subcode/update/{id}','Finance\SubcodeController@update')->name('subcode.update');
  Route::get('/finance/subcode/getKomLengkap','Finance\SubcodeController@getKomLengkap')->name('subcode.getKomLengkap');
  Route::get('/finance/subcode/getSubkom','Finance\SubcodeController@getSubkom')->name('subcode.getSubkom');

  //Route untuk Kode Akun
  Route::get('/finance/accountcode/create','Finance\AccountcodeController@create')->name('accountcode.create');
  Route::post('finance/accountcode/store','Finance\AccountcodeController@store')->name('accountcode.store');
  Route::get('finance/accountcode/delete/{id}','Finance\AccountcodeController@delete')->name('accountcode.delete');
  Route::get('finance/accountcode/edit/{id}','Finance\AccountcodeController@edit')->name('accountcode.edit');
  Route::post('finance/accountcode/update/{id}','Finance\AccountcodeController@update')->name('accountcode.update');

  //Route untuk Loka
  Route::get('/finance/loka/create','Finance\LokaController@create')->name('loka.create');
  Route::post('finance/loka/store','Finance\LokaController@store')->name('loka.store');
  Route::get('finance/loka/delete/{id}','Finance\LokaController@delete')->name('loka.delete');
  Route::get('finance/loka/edit/{id}','Finance\LokaController@edit')->name('loka.edit');
  Route::post('finance/loka/update/{id}','Finance\LokaController@update')->name('loka.update');

  //Route untuk Pelaksanaan Anggaran
  Route::get('/finance/implementation/create','Finance\ImplementController@create')->name('implementation.create');
  Route::post('finance/implementation/store','Finance\ImplementController@store')->name('implementation.store');
  Route::get('finance/implementation/edit/{id}','Finance\ImplementController@edit')->name('implementation.edit');
  Route::post('finance/implementation/update/{id}','Finance\ImplementController@update')->name('implementation.update');

  //Route untuk Revisi Pelaksanaan Anggaran
  Route::get('/finance/revision/create','Finance\RevisionController@create')->name('revision.create');
  Route::post('/finance/revision/impor','Finance\RevisionController@impor')->name('revision.impor');
  Route::post('/finance/revision/store','Finance\RevisionController@store')->name('revision.store');
  Route::get('finance/revision/view/{id}','Finance\RevisionController@view')->name('revision.view');
  Route::get('finance/revision/getPokDetail','Finance\RevisionController@getPokDetail')->name('revision.getPokDetail');

  //Route untuk Rekap Anggaran
  Route::post('/finance/rera/cetakrekap','Finance\ReraController@cetakrekap')->name('rera.cetakrekap');

  //Route untuk Realisasi anggaran Anggaran
  Route::get('/finance/realisasi/create','Finance\RealisasiController@create')->name('realisasi.create');
  Route::get('finance/realisasi/getAsal','Finance\RealisasiController@getAsal')->name('realisasi.getAsal');
  Route::get('finance/realisasi/getKomponen','Finance\RealisasiController@getKomponen')->name('realisasi.getKomponen');
  Route::get('finance/realisasi/getAkunId','Finance\RealisasiController@getAkunId')->name('realisasi.getAkunId');
  Route::get('finance/realisasi/getLokasi','Finance\RealisasiController@getLokasi')->name('realisasi.getLokasi');
  Route::get('finance/realisasi/getNilai','Finance\RealisasiController@getNilai')->name('realisasi.getNilai');
  Route::post('finance/realisasi/store','Finance\RealisasiController@store')->name('realisasi.store');
  Route::get('finance/realisasi/edit/{id}','Finance\RealisasiController@edit')->name('realisasi.edit');
  Route::post('finance/realisasi/update/{id}','Finance\RealisasiController@update')->name('realisasi.update');

   //Route untuk Sasaran Kegiatan
   Route::get('/finance/ikuTarget/create','Finance\IkuTargetController@create')->name('ikuTarget.create');
   Route::post('finance/ikuTarget/store','Finance\IkuTargetController@store')->name('ikuTarget.store');
   Route::get('finance/ikuTarget/delete/{id}','Finance\IkuTargetController@delete')->name('ikuTarget.delete');
   Route::get('finance/ikuTarget/edit/{id}','Finance\IkuTargetController@edit')->name('ikuTarget.edit');
   Route::post('finance/ikuTarget/update/{id}','Finance\IkuTargetController@update')->name('ikuTarget.update');


   //Route untuk Indikator Kinerja
   Route::get('/finance/ikuIndicator/create','Finance\IkuIndicatorController@create')->name('ikuIndicator.create');
   Route::post('finance/ikuIndicator/store','Finance\IkuIndicatorController@store')->name('ikuIndicator.store');
   Route::get('finance/ikuIndicator/delete/{id}','Finance\IkuIndicatorController@delete')->name('ikuIndicator.delete');
   Route::get('finance/ikuIndicator/edit/{id}','Finance\IkuIndicatorController@edit')->name('ikuIndicator.edit');
   Route::post('finance/ikuIndicator/update/{id}','Finance\IkuIndicatorController@update')->name('ikuIndicator.update');

  //Route untuk Daerah Tujuan
  Route::get('/finance/destination/create','Finance\DestinationController@create')->name('destination.create');
  Route::post('finance/destination/store','Finance\DestinationController@store')->name('destination.store');
  Route::get('finance/destination/delete/{id}','Finance\DestinationController@delete')->name('destination.delete');
  Route::get('finance/destination/edit/{id}','Finance\DestinationController@edit')->name('destination.edit');
  Route::post('finance/destination/update/{id}','Finance\DestinationController@update')->name('destination.update');
  
  //Route untuk PPK
  Route::post('finance/ppk/store','Finance\PPKController@store')->name('ppk.store');
  Route::get('finance/ppk/delete/{id}','Finance\PPKController@delete')->name('ppk.delete');
  Route::get('finance/ppk/edit/{id}','Finance\PPKController@edit')->name('ppk.edit');
  Route::post('finance/ppk/update/{id}','Finance\PPKController@update')->name('ppk.update');

  //Route untuk Maskapai
  Route::get('/finance/plane/create','Finance\PlaneController@create')->name('plane.create');
  Route::post('finance/plane/store','Finance\PlaneController@store')->name('plane.store');
  Route::get('finance/plane/delete/{id}','Finance\PlaneController@delete')->name('plane.delete');
  Route::get('finance/plane/edit/{id}','Finance\PlaneController@edit')->name('plane.edit');
  Route::post('finance/plane/update/{id}','Finance\PlaneController@update')->name('plane.update');

  //Route untuk surat tugas
  Route::get('/finance/outstation/create','Finance\OutstationController@create')->name('outstation.create');
  Route::get('finance/outstation/getnomorst','Finance\OutstationController@getnomorst')->name('outstation.getnomorst');
  Route::get('finance/outstation/getnomorsppd','Finance\OutstationController@getnomorsppd')->name('outstation.getnomorsppd');
  Route::post('finance/outstation/store','Finance\OutstationController@store')->name('outstation.store');
  Route::get('finance/outstation/edit/{id}','Finance\OutstationController@edit')->name('outstation.edit');
  Route::post('finance/outstation/update/{id}','Finance\OutstationController@update')->name('outstation.update');
  Route::get('finance/outstation/printST/{id}','Finance\OutstationController@printST')->name('outstation.printST');
  Route::get('finance/outstation/printSppd/{id}','Finance\OutstationController@printSppd')->name('outstation.printSppd');
  Route::get('finance/outstation/delete/{id}','Finance\OutstationController@delete')->name('outstation.delete');
  

//Route untuk kode anggaran
  Route::get('/finance/budget/create','Finance\BudgetController@create')->name('budget.create');
  Route::post('finance/budget/store','Finance\BudgetController@store')->name('budget.store');
  Route::get('finance/budget/edit/{id}','Finance\BudgetController@edit')->name('budget.edit');
  Route::post('finance/budget/update/{id}','Finance\BudgetController@update')->name('budget.update');

  //Route untuk Kuitansi
  Route::get('finance/travelexpenses/getMaksud','Finance\TravelexpensesController@getMaksud')->name('travelexpenses.getMaksud');
  Route::get('/finance/travelexpenses/create','Finance\TravelexpensesController@create')->name('travelexpenses.create');
  Route::post('finance/travelexpenses/store','Finance\TravelexpensesController@store')->name('travelexpenses.store');
  Route::get('finance/travelexpenses/edit/{id}','Finance\TravelexpensesController@edit')->name('travelexpenses.edit');
  Route::post('finance/travelexpenses/update/{id}','Finance\TravelexpensesController@update')->name('travelexpenses.update');
  Route::get('finance/travelexpenses/receipt/{id}','Finance\TravelexpensesController@receipt')->name('travelexpenses.receipt');
  Route::get('finance/travelexpenses/riil/{id}','Finance\TravelexpensesController@riil')->name('travelexpenses.riil');
  Route::get('finance/travelexpenses/super/{id}','Finance\TravelexpensesController@super')->name('travelexpenses.super');
  Route::get('finance/travelexpenses/getIsian','Finance\TravelexpensesController@getIsian')->name('travelexpenses.getIsian');

  //Route untuk petugas
  Route::post('/finance/petugas/store','Finance\PetugasController@store')->name('petugasmon.store');
  Route::get('/finance/petugas/delete/{id}','Finance\PetugasController@delete')->name('petugasmon.delete');
  Route::get('/finance/petugas/edit/{id}','Finance\PetugasController@edit')->name('petugasmon.edit');
  Route::post('/finance/petugas/update/{id}','Finance\PetugasController@update')->name('petugasmon.update');

  //Route untuk laporan DL
  Route::post('/finance/outreport/cetak','Finance\OutReportController@cetak')->name('outreport.cetak');

  //Route untuk Tagging
  Route::get('/finance/ikutagging/create','Finance\IkuTaggingController@create')->name('ikutagging.create');
  Route::post('finance/ikutagging/impor','Finance\IkuTaggingController@impor')->name('ikutagging.impor');
  Route::get('/finance/ikutagging/taging/{id}','Finance\IkuTaggingController@taging')->name('ikutagging.taging');
  Route::post('finance/ikutagging/store','Finance\IkuTaggingController@store')->name('ikutagging.store');
  Route::post('finance/ikutagging/update/{id}','Finance\IkuTaggingController@update')->name('ikutagging.update');
  Route::get('/finance/addagging/{pagu_id}/{id}','Finance\IkuTaggingController@add')->name('ikutagging.add');
  Route::get('/finance/editagging/{pagu_id}/{id}','Finance\IkuTaggingController@ubah')->name('ikutagging.ubah');
  Route::get('finance/ikutagging/cetak/{id}','Finance\IkuTaggingController@cetak')->name('ikutagging.cetak');
  Route::get('finance/ikutagging/excel/{id}','Finance\IkuTaggingController@excel')->name('ikutagging.excel');
  Route::get('finance/ikutagging/getdatalama','Finance\IkuTaggingController@getdatalama')->name('ikutagging.getdatalama');

   //Route untuk renstranas
  Route::get('/finance/renstranas/create','Finance\RenstranasController@create')->name('renstranas.create');
  Route::post('finance/renstranas/generate','Finance\RenstranasController@generate')->name('renstranas.generate');
  Route::get('/finance/renstranas/entrynas/{id}','Finance\RenstranasController@entrynas')->name('renstranas.entrynas');
  Route::post('finance/renstranas/store','Finance\RenstranasController@store')->name('renstranas.store');
  Route::get('finance/renstranas/edit/{id}','Finance\RenstranasController@edit')->name('renstranas.edit');
  Route::post('finance/renstranas/update/{id}','Finance\RenstranasController@update')->name('renstranas.update');
  Route::get('finance/renstranas/editmeta/{id}','Finance\RenstranasController@editmeta')->name('renstranas.editmeta');
  Route::post('finance/renstranas/updatemeta/{id}','Finance\RenstranasController@updatemeta')->name('renstranas.updatemeta');
  Route::get('finance/renstranas/delete/{id}','Finance\RenstranasController@delete')->name('renstranas.delete');


  //Route untuk renstrakal
  Route::get('/finance/renstrakal/create','Finance\RenstrakalController@create')->name('renstrakal.create');
  Route::post('finance/renstrakal/generate','Finance\RenstrakalController@generate')->name('renstrakal.generate');
  Route::get('/finance/renstrakal/entrynas/{id}','Finance\RenstrakalController@entrynas')->name('renstrakal.entrynas');
  Route::post('finance/renstrakal/store','Finance\RenstrakalController@store')->name('renstrakal.store');
  Route::get('finance/renstrakal/edit/{id}','Finance\RenstrakalController@edit')->name('renstrakal.edit');
  Route::post('finance/renstrakal/update/{id}','Finance\RenstrakalController@update')->name('renstrakal.update');
  Route::get('finance/renstrakal/editmeta/{id}','Finance\RenstrakalController@editmeta')->name('renstrakal.editmeta');
  Route::post('finance/renstrakal/updatemeta/{id}','Finance\RenstrakalController@updatemeta')->name('renstrakal.updatemeta');
  Route::get('finance/renstrakal/delete/{id}','Finance\RenstrakalController@delete')->name('renstrakal.delete');


   //Route untuk laporan Renstra
   Route::post('/finance/renstrapot/cetak','Finance\RenstraPotController@cetak')->name('renstrapot.cetak');

    //Route untuk Eselon II
    Route::get('/finance/eselontwo/create','Finance\EselonTwoController@create')->name('eselontwo.create');
    Route::post('finance/eselontwo/generate','Finance\EselonTwoController@generate')->name('eselontwo.generate');
    Route::get('/finance/eselontwo/entrydata/{id}','Finance\EselonTwoController@entrydata')->name('eselontwo.entrydata');
    Route::post('finance/eselontwo/store','Finance\EselonTwoController@store')->name('eselontwo.store');
    Route::get('finance/eselontwo/edit/{id}','Finance\EselonTwoController@edit')->name('eselontwo.edit');
    Route::post('finance/eselontwo/update/{id}','Finance\EselonTwoController@update')->name('eselontwo.update');
    Route::get('finance/eselontwo/agree/{id}','Finance\EselonTwoController@agree')->name('eselontwo.agree');
    Route::get('finance/eselontwo/detail/{id}','Finance\EselonTwoController@detail')->name('eselontwo.detail');
    Route::get('finance/eselontwo/editmeta/{id}','Finance\EselonTwoController@editmeta')->name('eselontwo.editmeta');
    Route::post('finance/eselontwo/updatemeta/{id}','Finance\EselonTwoController@updatemeta')->name('eselontwo.updatemeta');



     //Route untuk Realisasi RAPK
    Route::get('/finance/realRAPK/create','Finance\RealRAPKController@create')->name('realRAPK.create');
    Route::post('finance/realRAPK/generate','Finance\RealRAPKController@generate')->name('realRAPK.generate');
    Route::get('/finance/realRAPK/entrydata/{id}','Finance\RealRAPKController@entrydata')->name('realRAPK.entrydata');
    Route::post('finance/realRAPK/store','Finance\RealRAPKController@store')->name('realRAPK.store');
    Route::get('finance/realRAPK/edit/{id}','Finance\RealRAPKController@edit')->name('realRAPK.edit');
    Route::post('finance/realRAPK/update/{id}','Finance\RealRAPKController@update')->name('realRAPK.update');
    Route::get('finance/realRAPK/editmeta/{id}','Finance\RealRAPKController@editmeta')->name('realRAPK.editmeta');
    Route::post('finance/realRAPK/updatemeta/{id}','Finance\RealRAPKController@updatemeta')->name('realRAPK.updatemeta');

    //Route untuk Setup RAPK
    Route::post('/finance/setupRAPK/update','Finance\SetupRAPKController@update')->name('renstrapot.update');

    //Route untuk laporan RAPK
    Route::post('/finance/lapRAPK/cetak','Finance\LapRAPKController@cetak')->name('lapRAPK.cetak');

    //Route untuk buku ST
    Route::get('/finance/stbook/create','Finance\STBookController@create')->name('stbook.create');
    Route::post('finance/stbook/store','Finance\STBookController@store')->name('stbook.store');
    Route::get('finance/stbook/edit/{id}','Finance\STBookController@edit')->name('stbook.edit');
    Route::post('finance/stbook/update/{id}','Finance\STBookController@update')->name('stbook.update');
    Route::post('finance/stbook/delete/{id}','Finance\STBookController@update')->name('stbook.delete');
    Route::get('finance/stbook/getnost','Finance\STBookController@getnost')->name('stbook.getnost');
    Route::get('finance/stbook/getnosppd','Finance\STBookController@getnosppd')->name('stbook.getnosppd');
    Route::get('finance/stbook/getnosppdnext','Finance\STBookController@getnosppdnext')->name('stbook.getnosppdnext');

  
