<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = "pengumuman";
    protected $fillable = ['judul','isi','dari','sampai','users_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    
}