<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Divisi;
use App\Jabatan;
use App\User;
use App\Subdivisi;
use App\Golongan;
use Illuminate\Support\Str;
use App\Anak;
use App\Orangtua;
use App\Mertua;
use App\Saudara;
use App\Pasangan;
use App\Jurusan;
use App\Pendidikan;
use App\RiwayatPend;
use App\Jendok;
use App\Jabasn;
use App\Tukin;
use App\Dupak;
use App\Credit_poin;
use App\Pengalaman;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $data = User::find($id);
        $pend = Jurusan::all();
        $jenjang = Pendidikan::all();
        $jenis = Jendok::all();
        $gol = Golongan::all();
        $jabasn = Jabasn::all();
        $ortu = Orangtua::where('users_id',$id)->first();

        $mertua = Mertua::
                where('users_id',$id)
                ->first();

        $anak = Anak::orderBy('tgl_lhr_anak','asc')
                ->select('anak.*','pendidikan.jenjang', 'jurusan.jurusan','anak.id as itu')
                ->leftJoin('pendidikan','anak.pendidikan_id_anak','=','pendidikan.id')
                ->leftJoin('jurusan','anak.jurusan_id_anak','=','jurusan.id')
                ->where('anak.users_id',$id)
                ->get();

        $istri = Pasangan::
                select('pasangan.*', 'jurusan.jurusan')
                ->leftJoin('jurusan','pasangan.jurusan_id_psg','=','jurusan.id')
                ->where('pasangan.users_id',$id)
                ->first();

        $saudara = Saudara::orderBy('tgl_lhr_saudara','asc')
                ->where('users_id',$id)
                ->get();

        $pengalaman = Pengalaman::orderBy('tgl_mulai','asc')
                ->where('users_id',$id)
                ->get();

        $riwayatpend = RiwayatPend::orderBy('id','asc')
                                    ->paginate('10');

        $tukin = Tukin::orderBy('tukin_detail.id','asc')
                ->select('tukin.nomor','tukin.bulan', 'tukin.tahun','tukin_detail.terima', 'tukin_detail.potonganRp')
                ->leftJoin('tukin_detail','tukin_detail.tukin_id','=','tukin.id')
                ->where('tukin_detail.terima','!=', 0)
                ->where('tukin_detail.users_id',$id)
                ->paginate('10');
        $dupak = credit_poin::orderBy('sampai','asc')
                        ->selectRaw('*, MONTH(sampai) AS bulan')
                        ->where('users_id',$id)
                        ->get();

        $thndupak= credit_poin::selectRaw('YEAR(dari) AS tahun')
                        ->where('users_id',$id)
                        ->groupByRaw('tahun')
                        ->orderBy('tahun','asc')
                        ->get();

        
        return view('profile.index',compact('data','ortu','anak','mertua','istri','saudara','pend','jenjang','riwayatpend',
        'jenis','gol','jabasn','tukin','dupak','thndupak','pengalaman'));
    }
   
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|unique:users,email,'.$user->id,
            'telp' => 'required',
        ]);

        $user->update([
            'email'=>$request->email,
            'telp'=>$request->telp,
            'alamat'=>$request->alamat
        ]);

        if ($request->password_new!=null) {
            $this->validate($request, [
                'password_new' => 'required',
                'oldpass' => 'required',
                'repassword' => 'required_with:password|same:password_new|min:8'
            ]);
            $hashPassword = $user->password;
            if (Hash::check($request->oldpass, $hashPassword)) {
                $user->update([  'password' => bcrypt($request->password_new)]);
            }else{
                return redirect('/profile')->with('gagal','Password Lama Salah');
            }
        }
        return redirect('/profile')->with('sukses','Profil berhasil diperbaharui');

    
    }


    public function deleteanak($id)
    {
        $data = Anak::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');

    }

    public function deletesaudara($id)
    {
        $data = Saudara::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');

    }

    public function deletepen($id)
    {
        $data = RiwayatPend::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');
    }

    public function deletedok($id)
    {
        $data = Dokumen::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');
    }

    public function deletepengalaman($id)
    {
        $data = Pengalaman::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');
    }

    public function deletedokpeg($id)
    {
        $data = Dokpeg::find($id);
        $data->delete();
        return redirect('/profile')->with('sukses','Data Diperbaharui');
    }

    public function updateFoto(Request $request)
    {
        $this->validate($request,[
            'foto_new' => 'required|mimes:jpg,png,jpeg|max:2048'
        ]);
        if($request->hasFile('foto_new')){
            $request->file('foto_new')
                        ->move('images/pegawai/'.auth()->user()->id,$request
                        ->file('foto_new')
                        ->getClientOriginalName());
            $filename = $request->file('foto_new')->getClientOriginalName();
            $user = User::find(auth()->user()->id);
            $user->update([
                'foto' => $filename
            ]);
        }
        return redirect('/profile')->with('sukses','Data Diperbaharui');
    }


}
