<?php

namespace App;
use Illuminate\Support\Facades\DB;
use App\Destination;
use App\Outst_employee;
use App\Expenses;
use App\ExpensesUh;
use App\ExpensesTrans;
use App\ExpensesInap;
use App\ExpensesPlane;


class InjectNew
{

//---------------------------BIAYA PERJADIN (2023)---------------------------------------------------------------------------
    public function GetDataPeg($id){
        $data = Outst_employee::LeftJoin('users','users.id','outst_employee.users_id')
                            ->LeftJoin('outstation','outstation.id','outst_employee.outstation_id')
                            ->where('outst_employee.id',$id)
                            ->first();

        return $data;
    }

    public function GetUH($kota1){
        $data = Destination::where('id',$kota1)
                            ->first();
        return $data;
    }

    public function totalHarga($id){
        $nilaiUH = ExpensesUh::Where('outst_employee_id',$id)->first();
        $nilaiTR = ExpensesTrans::SelectRaw('sum(taxisum) AS jumtax')
                                ->Where('outst_employee_id',$id)
                                ->first();
        $nilaiIN = ExpensesInap::SelectRaw('SUM(hotelsum) jumhotel')
                                ->Where('outst_employee_id',$id)
                                ->where('hotelkkp','!=','Y')
                                ->first();
        $nilaiPL = ExpensesPlane::SelectRaw('SUM(ticketfee) jumtiket')
                                ->Where('outst_employee_id',$id)
                                ->where('planekkp','!=','Y')
                                ->first();

        //-----------UANG HARIAN-----------
        $lokal      = $nilaiUH->tlokalsum !='0' ? $nilaiUH->tlokalsum : '0';
        $uhar1      = $nilaiUH->uhar1sum !='0' ? $nilaiUH->uhar1sum : '0';
        $uhar2      = $nilaiUH->uhar2sum !='0' ? $nilaiUH->uhar2sum : '0';
        $uhar3      = $nilaiUH->uhar3sum !='0' ? $nilaiUH->uhar3sum : '0';
        $diklat     = $nilaiUH->diklatsum !='0' ? $nilaiUH->diklatsum : '0';
        $fullboard  = $nilaiUH->fullboardsum !='0' ? $nilaiUH->fullboardsum : '0';
        $fullday    = $nilaiUH->fulldaysum !='0' ? $nilaiUH->fulldaysum : '0';
        $repre      = $nilaiUH->repssum !='0' ? $nilaiUH->repssum : '0';

        $harian = $lokal+$uhar1+$uhar2+$uhar3+$diklat+$fullboard+$fullday+$repre;

        //-----------MEETING-----------
        $meethalf   = $nilaiUH->halfsum !='0' ? $nilaiUH->halfsum : '0';
        $meetfull   = $nilaiUH->fullsum !='0' ? $nilaiUH->fullsum : '0';
        $meetfb     = $nilaiUH->fbsum !='0' ? $nilaiUH->fbsum : '0';

        $meeting = $meethalf+$meetfull+$meetfb;

        //-----------TRANSPORT-----------
        if ($nilaiTR->jumtax != 0 ) {
            $transport = $nilaiTR->jumtax;
        } else {
            $transport = 0;
        }

        //-----------PENGINAPAN-----------
        $penginapan  = $nilaiIN->jumhotel !='0' ? $nilaiIN->jumhotel : '0';

        //-----------PESAWAT-----------
        $pesawat  = $nilaiPL->jumtiket !='0' ? $nilaiPL->jumtiket : '0';

        // ----------TOTAL-----------------

        $jumlah = $harian+$meeting+$transport+$penginapan+$pesawat;

        return $jumlah;
    }

    public function BiayaPesawat($id){
        $data = ExpensesPlane::Where('outst_employee_id',$id)
                            ->where('planekkp','!=','Y')
                            ->get();
        return $data;
    }

    public function BiayaUHAR($id){
        $data = ExpensesUh::Where('outst_employee_id',$id)
                            ->first();
        return $data;
    }

    public function BiayaTr($id){
        $data = ExpensesTrans::Where('outst_employee_id',$id)
                            ->get();
        return $data;
    }

    public function BiayaInn($id){
        $data = ExpensesInap::Where('outst_employee_id',$id)
                            ->where('hotelkkp','!=','Y')
                            ->get();
        return $data;
    }

    public function SumTR($id){
        $nilaiPL = ExpensesPlane::SelectRaw('SUM(ticketfee) jumtiket')
                                ->Where('outst_employee_id',$id)
                                ->where('planekkp','!=','Y')
                                ->first();
        $nilaiTR = ExpensesTrans::SelectRaw('sum(taxisum) AS jumtax')
                                ->Where('outst_employee_id',$id)
                                ->first();

        //-----------TRANSPORT-----------
        if ($nilaiTR->jumtax != 0 ) {
            $transport = $nilaiTR->jumtax;
        } else {
            $transport = 0;
        }

         //-----------PESAWAT-----------
         $pesawat  = $nilaiPL->jumtiket !='0' ? $nilaiPL->jumtiket : '0';

          // ----------TOTAL-----------------

        $jumlah =$transport+$pesawat;

        return $jumlah;

    }

    public function SumUH($id){
       
        $nilaiUH = ExpensesUh::Where('outst_employee_id',$id)->first();
        //-----------UANG HARIAN-----------
        $lokal      = $nilaiUH->tlokalsum !='0' ? $nilaiUH->tlokalsum : '0';
        $uhar1      = $nilaiUH->uhar1sum !='0' ? $nilaiUH->uhar1sum : '0';
        $uhar2      = $nilaiUH->uhar2sum !='0' ? $nilaiUH->uhar2sum : '0';
        $uhar3      = $nilaiUH->uhar3sum !='0' ? $nilaiUH->uhar3sum : '0';
        $diklat     = $nilaiUH->diklatsum !='0' ? $nilaiUH->diklatsum : '0';
        $fullboard  = $nilaiUH->fullboardsum !='0' ? $nilaiUH->fullboardsum : '0';
        $fullday    = $nilaiUH->fulldaysum !='0' ? $nilaiUH->fulldaysum : '0';

        $jumlah = $lokal+$uhar1+$uhar2+$uhar3+$diklat+$fullboard+$fullday;

        return $jumlah;

    }

    public function SumMeet($id){
       
        $nilaiUH = ExpensesUh::Where('outst_employee_id',$id)->first();
        //-----------UANG HARIAN-----------
        $meethalf   = $nilaiUH->halfsum !='0' ? $nilaiUH->halfsum : '0';
        $meetfull   = $nilaiUH->fullsum !='0' ? $nilaiUH->fullsum : '0';
        $meetfb     = $nilaiUH->fbsum !='0' ? $nilaiUH->fbsum : '0';

        $jumlah = $meethalf+$meetfull+$meetfb;

        return $jumlah;

    }

    public function SumInn($id){
        $nilaiIN = ExpensesInap::SelectRaw('SUM(hotelsum) jumhotel')
                                ->Where('outst_employee_id',$id)
                                ->where('hotelkkp','!=','Y')
                                ->first();

        //-----------PENGINAPAN-----------
        $penginapan  = $nilaiIN->jumhotel !='0' ? $nilaiIN->jumhotel : '0';

          // ----------TOTAL-----------------

        $jumlah =$penginapan;

        return $jumlah;

    }

    //SEMUA (KUITANSI + KKP)
    public function AllPesawat($id){
        $data = ExpensesPlane::Where('outst_employee_id',$id)
                            ->get();
        return $data;
    }

    public function AllHotel($id){
        $data = ExpensesInap::Where('outst_employee_id',$id)
                            ->get();
        return $data;
    }

    // KKP
    public function KKPPesawat($id){
        $data = ExpensesPlane::Where('outst_employee_id',$id)
                            ->where('planekkp','!=','N')
                            ->get();
        return $data;
    }

    public function KKPHotel($id){
        $data = ExpensesInap::Where('outst_employee_id',$id)
                            ->where('hotelkkp','!=','N')
                            ->get();
        return $data;
    }

//RIIL
    public function RiilHotel($id){
        $data = ExpensesInap::Where('outst_employee_id',$id)
                            ->where('rillhotel','!=','N')
                            ->get();
        return $data;
    }

    public function RiilTransport($id){
        $data = ExpensesTrans::Where('outst_employee_id',$id)
                            ->where('rilltaxi','!=','N')
                            ->get();
        return $data;
    }
    
}