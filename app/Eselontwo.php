<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eselontwo extends Model
{
    protected $table = "eselontwo";
    protected $fillable = ['dates','renstrakal_id','years','users_id','kapom_id'
];

    public function renstrakal()
    {
        return $this->belongsTo(Renstrakal::class,'renstrakal_id','id');
    }

    public function pejabat()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function kapom()
    {
        return $this->belongsTo(User::class,'kapom_id','id');
    }


}
