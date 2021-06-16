<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive_time extends Model
{
    protected $table = "archive_time";
    protected $fillable = ['nama','masa_aktif','masa_pasif'];


}
