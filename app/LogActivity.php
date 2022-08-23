<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = "log_activities";
    protected $fillable = ['subject', 'ip', 'agent', 'users_id'];
}
