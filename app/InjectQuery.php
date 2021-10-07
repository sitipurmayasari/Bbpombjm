<?php

namespace App;
use App\User;
use App\Destination;
use App\PengajuanDetail;
use App\AduanDetail;
use Illuminate\Support\Facades\DB;

class InjectQuery
{

//---------------------------KUITANSI---------------------------------------------------------------------------
    

//------------------------------LAPORAN BARANG------------------------------------------------------------------------
    public function getDaftarBrgAduan($aduanId)
    {
        $daftaraduan = AduanDetail::SelectRaw('aduan_detail.* , inventaris.nama_barang, inventaris.merk')
                                    ->LeftJoin('inventaris', 'inventaris.id','=','aduan_detail.inventaris_id')
                                    ->where('aduan_id',$aduanId)->get();
            return $daftaraduan;
       
    }

    public function getDaftarBrgAjuan($ajuanId)
    {
        $daftarajuan = PengajuanDetail::where('pengajuan_id',$ajuanId)->get();
            return $daftarajuan;
    }
   
}