@extends('layouts.app')
@section('breadcrumb')
    <li><i class="ace-icon fa fa-table home-icon"></i>  <a href="/invent/persetujuan">DPB Baru</a></li>
    <li>No {{$ajuan->no_ajuan}}</li>

@endsection
@section('content')
<form Class="form-horizontal validate-form" role="form" 
method="post" action="/invent/persetujuan/update/{{$ajuan->id}}">
{{ csrf_field() }}
<div class="panel panel-default table-responsive hidden-xs">
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">No. Pengajuan</td>
            <td class="col-xs-2 text-center">Tanggal</td>
            <td class="col-xs-2 text-center">Pelapor</td>
            <td class="col-xs-2 text-center">Status</td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{$ajuan->no_ajuan}}</td>
            <td class="text-center lead" style="border-top: none;">{{$ajuan->tgl_ajuan}}</td>
            <td class="text-center lead" style="border-top: none;">{{$ajuan->lapor->no_pegawai." ".$ajuan->lapor->name}}</td>
            <td>
                @if ($ajuan->status==0)
                    <select name="aduan_status"  class="form-control">
                        <option value="0" {{$ajuan->status==0 ? 'selected' : ''}}>Menunggu</option>
                        <option value="1" {{$ajuan->status==1 ? 'selected' : ''}}>Selesai</option>
                    </select>                        
                @else
                    <input type="hidden" name="aduan_status" value="{{$ajuan->status}}">
                @endif
            </td>
        </tr>
    </table>
</div>

<div class="clearfix"></div>

<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <td style="text-align: center;">No</td>
            <td style="text-align: center;">Nama Barang</td>
            {{-- <td style="text-align: center;">Spesifikasi</td> --}}
            <td style="text-align: center;">Jumlah</td>
            <td style="text-align: center;">keperluan</td>
            <td style="text-align: center;">Status</td>
        </tr>
    </thead>
    <tbody>
        @php
            $no= 1;
        @endphp
        @foreach ($detail as $item)
            <tr>
                <td style="text-align: center;">{{$no++}}
                    <input type="hidden" name="detail_id[]" value="{{$item->id}}">
                </td>
                <td>{{$item->nama_barang}}</td>
                {{-- <td>{{$item->spek}}</td> --}}
                <td style="text-align: center;">{{$item->jumlah}} {{$item->satuan->satuan}}</td>
                <td>{{$item->keperluan}}</td>
                <td>
                    @if ($item->status==0)
                        <select name="status[]"  class="form-control">
                            <option value="0" {{$item->status==0 ? 'selected' : ''}}>Menunggu</option>
                            <option value="1" {{$item->status==1 ? 'selected' : ''}}>Diterima</option>
                            <option value="2" {{$item->status==2 ? 'selected' : ''}}>Ditolak</option>
                        </select>                        
                    @else
                        <input type="hidden" name="status[]" value="{{$item->status}}">
                        @if ($item->status==1)
                            Diterima
                        @else 
                            Ditolak
                        @endif
                    @endif
                   
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    <div class="form-actions right">
        @if ($ajuan->status==0)
        <button class="btn btn-success btn-sm " type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>UPDATE
        </button>
        @endif
       
    </div>
</form>
  
@endsection
