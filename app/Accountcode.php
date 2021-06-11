<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountcode extends Model
{
    protected $table = "accountcode";
    protected $fillable = ['code','name'];


}
