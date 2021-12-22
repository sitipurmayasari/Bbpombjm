<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travelexpenses extends Model
{
    protected $table = "travelexpenses";
    protected $fillable = ['expenses_id','outst_employee_id',
                            'diklat','hitdiklat','jumdiklat','totdiklat',
                            'fullboard','hitfullb','jumfullb','totfullb',
                            'fullday','hithalf','jumhalf','tothalf',
                            'representatif','hitrep','jumrep','totrep',
                            'dayshalf','feehalf','totdayshalf',
                            'daysfull','feefull','totdaysfull',
                            'file'
];

    public function peg()
    {
        return $this->belongsTo(Outst_employee::class,'outst_employee_id','id');
    }

    public function getFIleReceipt() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/kuitansi').'/'.$this->id.'/'.$this->file;
    }


}
