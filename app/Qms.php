<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qms extends Model
{
    protected $table = "qms";
    protected $fillable = ['names','type','file','folder_id'
];

    public function folder()
    {
        return $this->belongsTo(Folder::class,'folder_id','id');
    }

    public function getFIleQms() 
    {
        return $this->file==null ? 'Tidak Ada File' : asset('images/qms').'/'.$this->names.'/qms/'.$this->file;
    }


}
