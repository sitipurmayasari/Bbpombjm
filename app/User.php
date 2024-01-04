<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [
        'name', 'email', 'password','no_pegawai','username','tgl_lhr','alamat','telp','jabatan_id','status','subdivisi_id',
        'divisi_id','foto','remember_token','aktif','tempat_lhr','nikah','golongan_id','jkel','jabasn_id','seri_karpeg',
        'deskjob','TMT_Capeg','namanogelar','agama'
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function name()
    {
        return $this->hasManyThrough(JadwalMain::class, Inventaris::class);
    }
    public function divisi() 
    {
        return $this->belongsTo(Divisi::class);
    }
    public function subdivisi() 
    {
        return $this->belongsTo(Subdivisi::class);
    }
    public function jabatan() 
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function jabasn() 
    {
        return $this->belongsTo(Jabasn::class);
    }

    public function gol() 
    {
        return $this->belongsTo(Golongan::class,'golongan_id','id');
    }

    public function getFoto() 
    {
        return $this->foto==null ? asset('images/user/userempty.png') : asset('images/pegawai').'/'.$this->id.'/'.$this->foto;
    }

    public function ttd() 
    {
        return $this->belongsTo(Setupttd::class,'id','users_id');
    }
}
