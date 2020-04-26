@extends('layouts.admin',['module'=>'Pegawai','judul'=>'Tambah Data Pegawai'])
@section('title')
    <title>Tambah Pegawai</title>
@endsection
@section('content')

<form action="{{$url}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
<div class="col-md-6 ml-3">
    <div class="box box-primary">        
        <!-- /.box-header -->
        <!-- form start -->        
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Pegawai</label>
            <input name="nama" class="form-control" placeholder="Masukkan Nama" value="{{ old('nama',$pegawai->nama ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">NIP</label>
                <input name="nip" class="form-control"  placeholder="Masukkan nip" value="{{ old('nip',$pegawai->nip ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jabatan</label>
                <input name="jabatan" class="form-control"  placeholder="Masukkan jabatab" value="{{ old('jabatan',$pegawai->jabatan ?? '') }}" required>
            </div>
             <div class="form-group">
                <label for="exampleInputEmail1">Pangakat</label>
                <input name="pangkat" class="form-control"  placeholder="Masukkan pangkat" value="{{ old('pangkat',$pegawai->pangkat ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Golongan</label>
                <input name="golongan" class="form-control"  placeholder="Masukkan golongan" value="{{ old('golongan',$pegawai->golongan ?? '') }}" required>
            </div>                                 
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">{{$tombol}}</button>
        </div>
    </div>
</div>
</form>
@endsection