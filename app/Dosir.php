<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosir extends Model
{
    protected $table = "dosir";
    protected $fillable = ['users_id','nama','file'
];

    public function pegawai()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function getFIledosir() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/pegawai').'/'.$this->users_id.'/dosir/'.$this->file;
    }


}
