<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Implemen_detail extends Model
{
    protected $table = "implementation";
    protected $fillable = ['implementation_id','subcode_id','accountcode_id','detail','volume','price','total','sd'
];

    public function implemen()
    {
        return $this->belongsTo(Implementation::class,'implementation_id','id');
    }

    public function sub()
    {
        return $this->belongsTo(Subcode::class,'subcode_id','id');
    }

    public function akun()
    {
        return $this->belongsTo(Accountcode::class,'accountcode_id','id');
    }

}
