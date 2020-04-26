@extends('layouts.admin',['module'=>'Pegawai','judul'=>'Data Pegawai'])
@section('title')
    <title>Pegawai</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <a href="/create-pegawai" type="submit" class="btn btn-primary">Tambah data Pegawai</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                {{ session('success') }}
            </div>
        @endif
      <div class="card">
        <div class="card-header">   
            <form action="/cari-pegawai" method="GET">
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
                <th> Jabatan </th>
                <th>  Pangkat  </th>
                <th>  Edit  </th>
                <th class="text-center">  DELETE  </th>
              </thead>
             <tbody>
               @foreach ($pegawai as $row)
                 <tr>
                     <td>{{$row->id}}</td>
                     <td>{{$row->nama}}</td>
                     <td>{{$row->nip }}</td>
                     <td>{{$row->jabatan }}</td>
                     <td>{{$row->pangkat }}</td>
                     <td>
                        <a href="/edit-pegawai/{{$row->id}}" class="btn btn-success">EDIT</a>
                     </td>
                     <td class="text-center">
                      <button class="btn btn-danger" data-toggle="modal" data-id="{{ $row->id }}" data-target="#delete"><i class="fas fa-trash"></i> </button>
                    </td>
                 </tr>
                  <!-- Modal HTML -->
                  <div id="delete" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-confirm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Apakah anda yakin ?</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form action="/delete-pegawai/data" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                          <p>Anda benar-benar ingin menghapus data ini ? Data yang sudah dihapus tidak dapat dikembalikan</p>
                          <input type="hidden" name="datadelete" id="id" value="">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                              <button type="submit"  class="btn btn-danger">DELETE</button>
                          </form>   
                        </div>
                      </div>
                    </div>
                  </div>
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