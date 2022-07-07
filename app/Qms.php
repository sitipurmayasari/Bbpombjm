<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qms extends Model
{
    protected $table = "qms";
    protected $fillable = ['names','type','file'
];

    public function getFIleQms() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/qms').'/'.$this->names.'/qms/'.$this->file;
    }


}
