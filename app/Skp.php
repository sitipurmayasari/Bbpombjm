<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    protected $table = "skp";
    protected $fillable = ['users_id','dates','jabasn_id','pejabat_id'
                        ];

    public function peg()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function jab()
    {
        return $this->belongsTo(Jabasn::class,'jabasn_id','id');
    }

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class,'pejabat_id','id');
    }

    public function detail()
    {
        return $this->hasMany(Skp_detail::class,'skp_id','id');
    }

}
