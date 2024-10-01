<?php

namespace App\Http\Controllers\Amdk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $subdivisi = Subdivisi::all();
        $jabatan = Jabatan::where('jabatan_id','!=','10');
        $divisi = Divisi::all();
        $data = User::orderBy('name','asc')
                ->where('id','!=','1')
                ->where('jabatan_id','!=','10')
                ->when($request->keyword, function ($query) use ($request) {
                $query->where('no_pegawai','LIKE','%'.$request->keyword.'%')
                        ->orWhere('name', 'LIKE','%'.$request->keyword.'%')
                        ->where('jabatan_id','!=','10');
                })
                ->paginate('10');

        return view('amdk/pegawai.index',compact('data','jabatan','divisi','subdivisi'));
    }
    public function detail(Request $request,$id)
    {
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

        $riwayatpend = RiwayatPend::orderBy('id','desc')
                ->paginate('10');

        return view('amdk/pegawai.detail',compact('data','ortu','anak','mertua','istri','saudara','pend','jenjang','riwayatpend',
        'jenis','gol','jabasn'));
    }

    public function create()
    {
        $gol = Golongan::all();
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $user = User::all();
        $subdivisi = Subdivisi::all();
        $jabasn = Jabasn::all();

        return view('amdk/pegawai.create',compact('user','jabatan','divisi','subdivisi','gol','jabasn'));
    }

   
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_pegawai' => 'required|unique:users',
            'email' => 'required|unique:users',
            'tgl_lhr' => 'required',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'status' => 'required',
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048'
        ]);
        
        $request->merge([
            'password' =>  bcrypt("Bpombjm2024"),
            'remember_token' => Str::random(60)
        ]);

        $user=User::create($request->all());

        if($request->hasFile('foto')){ // Kalau file ada
            $request->file('foto')
                        ->move('images/pegawai/'.$user->id,$request
                        ->file('foto')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $user->foto = $request->file('foto')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $user->save(); // save ke database
        }

        
        return redirect('/amdk/pegawai')->with('sukses','Data Tersimpan');
    }

    public function storepangol(Request $request)
    {
        Golongan::create($request->all());
        return redirect('/amdk/outsourcing/create')->with('sukses','Golongan Berhasil Ditambahkan');
    }

    public function storejafung(Request $request)
    {
        Jabasn::create($request->all());
        return redirect('/amdk/outsourcing/create')->with('sukses','JaFung Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = User::where('id',$id)->first();
        $gol = Golongan::all();
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        $subdivisi = Subdivisi::all();
        $jabasn = Jabasn::all();
        return view('amdk/pegawai.edit',compact('data','divisi','jabatan','subdivisi','gol','jabasn'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'no_pegawai' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'file_foto' => 'mimes:jpg,png,jpeg|max:2048'
        ]);


        

        if($request->password_new!=""){
            $request->merge([
                'password' =>  bcrypt($request->password_new),
                'remember_token' => Str::random(60)
            ]);                
        }

        $user = User::find($id);
        $user->update($request->all());
        if($request->hasFile('foto2')){ // Kalau file ada
            $request->file('foto2')
                        ->move('images/pegawai/'.$user->id,$request
                        ->file('foto2')
                        ->getClientOriginalName()); // pindah file user manual k inventaris folder id file
            $user->foto = $request->file('foto2')->getClientOriginalName(); // update isi kolum file user dengan origin gambar
            $user->save(); // save ke database
        }
        return redirect('/amdk/pegawai')->with('sukses','Data Diperbaharui');
    }

   
    public function destroy($id)
    {
        //
    }

     //JSON get data barang 200 is success api
     public function getPeg(Request $request)
     {
         $id = $request->barang_id;
         $data = User::where('id',$id)->first();
         return response()->json([ 'success' => true,'data' => $data],200);
     }
}
