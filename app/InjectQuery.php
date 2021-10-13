<?php

namespace App;
use App\User;
use App\Destination;
use App\PengajuanDetail;
use App\AduanDetail;
use App\Travelexpenses;
use App\Travelexpenses1;
use Illuminate\Support\Facades\DB;

class InjectQuery
{

//---------------------------KUITANSI---------------------------------------------------------------------------
    public function getDetail($id){
        $nilai = Travelexpenses1::Where('outst_employee_id',$id)->first();
        return $nilai;
    }

    public function getTr($id){
        $daily = Travelexpenses::Where('outst_employee_id',$id)->first();
        return $daily;
    }

    public function getPesawat($id){
        $daily = Travelexpenses::Where('outst_employee_id',$id)->first();
        return $daily;
    }

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