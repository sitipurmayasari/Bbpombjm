<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = "user_permission";
    protected $fillable = ["menu_id","user_id"];
}
