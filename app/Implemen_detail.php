<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Implemen_detail extends Model
{
    protected $table = "implemen_detail";
    protected $fillable = ['implementation_id','accountcode_id','loka_id','volume','price','total','sd'
];

    public function implemen()
    {
        return $this->belongsTo(Implementation::class,'implementation_id','id');
    }

    public function akun()
    {
        return $this->belongsTo(Accountcode::class,'accountcode_id','id');
    }

    public function loka()
    {
        return $this->belongsTo(Loka::class,'loka_id','id');
    }

}
