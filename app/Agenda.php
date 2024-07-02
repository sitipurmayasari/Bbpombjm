<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = "agenda";
    protected $fillable = ['titles','detail','date_from','date_to','users_id','agenda_kategori_id','vehiclerent_id'
];

    public function pembuat()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function peminjaman()
    {
        return $this->belongsTo(Vehiclerent::class,'vehiclerent_id','id');
    }
    public function kategori()
    {
        return $this->belongsTo(Agenda_kategori::class,'agenda_kategori_id','id');
    }

}
