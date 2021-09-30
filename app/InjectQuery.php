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
    public function getDestinationMoney($userId,$destinationId,$typee)
    {
        $destination = Destination::where('id',$destinationId)->first();
        $tipe = User::find($userId)->jabatan_id;
        $sup = User::find($userId)->deskjob;

        if ($destination) {
           if ($typee=='LK') {
                if ($tipe==6) { //kabalai
                    return $destination->dailywageLK1;
                }elseif($tipe==11){ //kabag
                    return $destination->dailywageLK2;
                }elseif($tipe==7){ //koor
                    return $destination->dailywageLK3;
                }elseif($tipe==5){ //subkoor
                    return $destination->dailywageLK4;
                }else{ // STAFF
                    return $destination->dailywageLK5;
                }
           } else {
                if ($tipe==6) { //kabalai
                    return $destination->dailywageDK1;
                }elseif($tipe==11){ //kabag
                    return $destination->dailywageDK2;
                }elseif($tipe==7){ //koor
                    return $destination->dailywageDK3;
                }elseif($tipe==5){ //subkoor
                    return $destination->dailywageDK4;
                }else{ // STAFF
                    return $destination->dailywageDK5;
                }
           }
           
        }
        return 0;
       
    }

    public function getDiklatMoney($userId,$destinationId,$typee)
    {
        $destination = Destination::where('id',$destinationId)->first();
        $tipe = User::find($userId)->jabatan_id;
        if ($destination) {
            if ($tipe==6) { //kabalai
                return $destination->diklat1;
            }elseif($tipe==11){ //kabag
                return $destination->diklat2;
            }elseif($tipe==7){ //koor
                return $destination->diklat3;
            }elseif($tipe==5){ //subkoor
                return $destination->diklat4;
            }else{ // STAFF
                return $destination->diklat5;
            }
        }
        return 0;
    }

    public function getHalfdayMoney($userId,$destinationId,$typee)
    {
        $destination = Destination::where('id',$destinationId)->first();
        $tipe = User::find($userId)->jabatan_id;
        if ($destination) {
            if ($tipe==6) { //kabalai
                return $destination->FBFD1;
            }elseif($tipe==11){ //kabag
                return $destination->FBFD2;
            }elseif($tipe==7){ //koor
                return $destination->FBFD3;
            }elseif($tipe==5){ //subkoor
                return $destination->FBFD4;
            }else{ // STAFF
                return $destination->FBFD5;
            }
        }
        return 0;
    }

    public function getFullBoardMoney($userId,$destinationId,$typee)
    {
        $destination = Destination::where('id',$destinationId)->first();
        $tipe = User::find($userId)->jabatan_id;
        if ($destination) {
            if ($tipe==6) { //kabalai
                return $destination->FBDK1;
            }elseif($tipe==11){ //kabag
                return $destination->FBDK2;
            }elseif($tipe==7){ //koor
                return $destination->FBDK3;
            }elseif($tipe==5){ //subkoor
                return $destination->FBDK4;
            }else{ // STAFF
                return $destination->FBDK5;
            }
        }
        return 0;
    }

    public function getEselonMoney($userId,$destinationId,$typee)
    {
        $destination = Destination::where('id',$destinationId)->first();
        $tipe = User::find($userId)->jabatan_id;
        if ($destination) {
            if ($tipe==6) { //kabalai
                return $destination->representatif;
            }else{
                0;
            }
        }
        return 0;
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