@extends('layouts.admin',['module'=>'Setting','judul'=>'Edit Data Setting Anggaran'])
@section('title')
    <title>Edit Setting</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
      <form action="/update-setting-anggaran/{{$setting->id}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          
      <div class="col-md-6 ml-3">
          <div class="box box-primary">        
              <!-- /.box-header -->
              <!-- form start -->        
              <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Mata Anggaran</label>
                  <input name="mata" class="form-control" placeholder="Masukkan Mata Anggaran" value="{{ old('mata',$setting->mata_anggaran ?? '') }}" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tahun Anggaran</label>
                      <input name="tahun" class="form-control"  placeholder="Masukkan Tahun Anggaran" value="{{ old('tahun',$setting->tahun_anggaran ?? '') }}" required>
                  </div>
                  
              <div class="box-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </div>
      </div>
      </form>
    </div>
  </div> 
</div>   
@endsection