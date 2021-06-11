@extends('layouts.app')
@section('breadcrumb')
    <li><i class="ace-icon fa fa-table home-icon"></i>  <a href="/invent/aduantik">Aduan</a></li>
    <li>No {{$aduan->no_aduan}}</li>

@endsection
@section('content')
<form Class="form-horizontal validate-form" role="form" 
method="post" action="/invent/aduantik/update/{{$aduan->id}}">
{{ csrf_field() }}
<div class="panel panel-default table-responsive hidden-xs">
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">No. Aduan</td>
            <td class="col-xs-2 text-center">Tanggal</td>
            <td class="col-xs-2 text-center">Pelapor</td>
            <td class="col-xs-2 text-center">Status</td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{$aduan->no_aduan}}</td>
            <td class="text-center lead" style="border-top: none;">{{$aduan->tanggal}}</td>
            <td class="text-center lead" style="border-top: none;">{{$aduan->lapor->no_pegawai}} <br> {{$aduan->lapor->name}}</td>
            <td>
                @if ($aduan->aduan_status==0)
                    <select name="aduan_status"  class="form-control">
                        <option value="0" {{$aduan->aduan_status==0 ? 'selected' : ''}}>Belum diperiksa</option>
                        <option value="1" {{$aduan->aduan_status==1 ? 'selected' : ''}}>Sudah diperiksa</option>
                    </select>                        
                @else
                    <input type="hidden" name="aduan_status" value="{{$aduan->aduan_status}}">Sudah diperiksa
                @endif
            </td>
        </tr>
    </table>
</div>

<div class="clearfix"></div>

<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Kode Barang</td>
            <td>Nama Barang</td>
            <td>Merk Barang</td>
            <td>Keterangan</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        @php
            $no= 1;
        @endphp
        @foreach ($detail as $item)
            <tr>
                <td>{{$no++}}
                    <input type="hidden" name="detail_id[]" value="{{$item->id}}">
                </td>
                <td>{{$item->barang->kode_barang}}</td>
                <td>{{$item->barang->nama_barang}}</td>
                <td>{{$item->barang->merk}}</td>
                <td>{{$item->keterangan}}</td>
                <td>
                    @if ($item->status==0)
                        <select name="status[]"  class="form-control">
                            <option value="0" {{$item->status==0 ? 'selected' : ''}}>Belum diperbaiki</option>
                            <option value="1" {{$item->status==1 ? 'selected' : ''}}>Sudah diperbaiki</option>
                            <option value="2" {{$item->status==2 ? 'selected' : ''}}>Tidak Dapat diperbaiki</option>
                        </select>                        
                    @else
                        <input type="hidden" name="status[]" value="{{$item->status}}">
                        @if ($item->status==1)
                            Sudah diperbaiki
                        @else 
                            Tidak Dapat diperbaiki
                        @endif
                    @endif
                   
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    <div class="form-actions right">
        @if ($aduan->aduan_status==0)
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
        @endif
       
    </div>
</form>
  
@endsection
