<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiclerent extends Model
{
    protected $table = "vehiclerent";
    protected $fillable = ['code','users_id','car_id','date_from','date_to','driver_id','destination','file','status',
                            'type','drivers','total','keterangan','pengemudi'
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id','id');
    }

    public function supir()
    {
        return $this->belongsTo(User::class,'driver_id','id');
    }

    public function getFile() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pinjem').'/'.$this->id.'/'.$this->file;
    }

}
