@extends('layouts.admin',['module'=>'SPPD','judul'=>'Generate SPPD'])
@section('title')
    <title>Generate SPPD</title>
@endsection
@section('content')

<form action="{{$url}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="bootstrap-iso">
<div class="container">
    <div class="row">
        <div class="col-md-5 ml-3">
            <div class="box box-primary">        
                <!-- /.box-header -->
                <!-- form start -->        
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Surat</label>
                    <input name="no_surat" class="form-control" placeholder="Masukkan Nomor Surat" value="{{ old('no_surat',$sppd->no_surat ?? '') }}">
                    </div>
                    <div class="form-group"> <!-- Date input -->
                        <label class="exampleInputEmail1" >Tanggal Surat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input autocomplete="off" name="tgl_surat" class="form-control" type="text" id="datepicker" placeholder="Masukkan Tanggal surat" value="{{ old('tgl_surat',$sppd->tgl_surat ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Berangkat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input autocomplete="off" name="tgl_pergi" class="form-control" type="text" id="datepicker2" placeholder="Masukkan Tanggal berangkat" value="{{ old('tgl_pergi',$sppd->tgl_pergi ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Kembali</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input autocomplete="off" name="tgl_kembali" class="form-control" type="text" id="datepicker3"  placeholder="Masukkan Tanggal Kembali" value="{{ old('tgl_kembali',$sppd->tgl_kembali ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Acara</label>
                        <input name="acara" class="form-control"  placeholder="Masukkan acara" value="{{ old('acara',$sppd->acara ?? '') }}" required>
                    </div>    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tujuan</label>
                        <input name="tujuan" class="form-control"  placeholder="Masukkan tujuan" value="{{ old('tujuan',$sppd->tujuan ?? '') }}" required>
                    </div>      
                    <div class="form-group">
                        <label for="exampleInputEmail1">Angkutan</label>
                        <select name="angkutan" class="form-control" style="width: 100%;" required>
                            <option value="Dinas"selected>Dinas</option>
                            <option value="Umum" >Umum</option>
                         </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tempat Berangkat</label>
                        <input name="tempat_berangkat" class="form-control"  placeholder="Masukkan tempat berangkat" value="{{ old('tempat_berangkat',$sppd->tempat_berangkat ?? 'Bantul') }}" required>
                    </div>                             
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-5 ml-3">
            <div class="box box-primary">        
                <!-- /.box-header -->
                <!-- form start -->        
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dasar SPPD</label>
                    <input name="dasar" class="form-control" placeholder="Masukkan dasar sppd" value="{{ old('dasar',$sppd->dasar ?? '') }}" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lama Perjalanan</label>
                    <input name="lama" class="form-control" placeholder="Masukkan lama perjalanan" value="{{ old('lama',$sppd->lama ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">PPTK</label>
                        <select name="pptk" class="form-control select2bs4" style="width: 100%;" required>
                          @foreach ($pptk as $item)
                            @foreach ($pegawai as $option)
                                @if ($item->id_karyawan == $option->id)
                                    <option value="{{$option->id}}">{{$option->nama}}</option>
                                @endif                                
                            @endforeach
                          @endforeach  
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Daerah</label>
                        <select name="daerah" class="form-control" style="width: 100%;" required>
                           <option value="1" selected>Dalam Kabupaten</option>
                           <option value="2">Luar Kabupaten</option>
                        </select>
                   </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Anggaran</label>
                        <select name="anggaran" class="form-control" style="width: 100%;" required>
                            <option value="1" selected>Non DAK</option>
                            <option value="2">DAK</option>
                         </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Petugas Lapangan</label>
                        <input name="nama_petugas" class="form-control"  placeholder="Masukkan nama petugas" value="{{ old('nama_petugas',$sppd->nama_petugas ?? '') }}" >
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nip Petugas Lapangan</label>
                        <input name="nip_petugas" class="form-control"  placeholder="Masukkan nip petugas" value="{{ old('nip_petugas',$sppd->nip_petugas ?? '') }}" >
                    </div>        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jabatan Petugas Lapangan</label>
                        <input name="jabatan_petugas" class="form-control"  placeholder="Masukkan jabatan petugas" value="{{ old('jabatan_petugas',$sppd->jabatan_petugas ?? '') }}" >
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-10">
        <div class="box-footer mb-4 text-center">
            <button type="submit" class="btn btn-primary">{{$tombol}}</button>
         </div>
        </div>
    </div>
</div>
</div>
</form>
@endsection