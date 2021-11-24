<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outstation extends Model
{
    protected $table = "outstation";
    protected $fillable = ['divisi_id','st_date','number','purpose','budget_id','ppk_id','pok_detail_id',
                            'subcode_id','accountcode_id','city_from','type','transport','activitycode_id','external','file'
                        ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class,'divisi_id','id');
    }
    public function budget()
    {
        return $this->belongsTo(Budget::class,'budget_id','id');
    }
    public function pok()
    {
        return $this->belongsTo(Pok_detail::class,'pok_detail_id','id');
    }
    public function act()
    {
        return $this->belongsTo(Activitycode::class,'activitycode_id','id');
    }
    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }
    public function akun()
    {
        return $this->belongsTo(Accountcode::class,'accountcode_id','id');
    }
    public function outst_destiny()
    {
        return $this->hasMany(Outst_destiny::class,'outstation_id','id');
    }

    public function ppk()
    {
        return $this->belongsTo(PPK::class,'ppk_id','id');
    }

    public function cityfrom()
    {
        return $this->belongsTo(Destination::class,'city_from','id');
    }

    public function citysatu()
    {
        return $this->belongsTo(Destination::class,'city_1','id');
    }
    public function citydua()
    {
        return $this->belongsTo(Destination::class,'city_2','id');
    }

    public function petugas()
    {
        return $this->hasMany(Outst_employee::class,'outstation_id','id');
    }

    public function getFIleST() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/ST').'/'.$this->id.'/'.$this->file;
    }

}
