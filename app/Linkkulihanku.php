<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linkkulihanku extends Model
{
    protected $table = "linkkulihanku";
    protected $fillable = ['name','link', 'aktif'];

    
}