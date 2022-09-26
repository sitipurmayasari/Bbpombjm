<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetBakteri extends Model
{
    protected $table = "getbakteri";
    protected $fillable = ['users_id','bakteri_id','dates'
];

    public function peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function baku()
    {
        return $this->belongsTo(Bakteri::class,'bakteri_id','id');
    }


}
