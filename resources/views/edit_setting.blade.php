@extends('layouts.admin',['module'=>'Setting','judul'=>'Edit Data Setting'])
@section('title')
    <title>Tambah PPTK</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">   
            <form action="/cari-pegawai-setting" method="GET">
                <div class="col-md-8">       
                    <label>Cari Pegawai berdasarkan Nama:</label>
                    <div class="input-group no-border">
                        
                        <input type="text" class="form-control " placeholder="Search..." name="cari" value="{{ old('cari') }}" required >
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="now-ui-icons ui-1_zoom-bold"></i>
                        </div>
                        <input class="btn btn-info ml-4" type="submit" value="CARI">
                        </div>
                    </div>
                </div>                     
            </form>         
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th> ID  </th>
                <th> Nama  </th>
                <th> Nip  </th>
                <th>  Pangkat  </th>
                <th>  Pilih Kadis  </th>
                <th>  Pilih Bendahara  </th>
              </thead>
             <tbody>
               @foreach ($pegawai as $row)
                 <tr>
                     <td>{{$row->id}}</td>
                     <td>{{$row->nama}}</td>
                     <td>{{$row->nip }}</td>
                     <td>{{$row->pangkat }}</td>
                     <td class="text-center">
                        <form action="/update-setting-kadis/1" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$row->id}}">
                        <button class="btn btn-success">PILIH</button>
                        </form>
                     </td>
                     <td class="text-center">
                      <form action="/update-setting-bendahara/1" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$row->id}}">
                      <button class="btn btn-success">PILIH</button>
                      </form>
                   </td>
                 </tr>                  
                @endforeach
            </tbody>
            </table>
            <div class="d-flex justify-content-center">
              {{ $pegawai->links() }}
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>   
@endsection