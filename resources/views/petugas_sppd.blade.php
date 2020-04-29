@extends('layouts.admin',['module'=>'SPPD','judul'=>'Petugas SPPD'])
@section('title')
    <title>Petugas SPPD</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                {{ session('success') }}
            </div>
        @endif
      <div class="card">
        <div class="card-header">   
            <form action="/tambah-pegawai-sppd" method="GET">
                <div class="col-md-10">       
                    <label>Pilih Pegawai</label>
                    <div class="input-group no-border">
                      <select name="id_pegawai" class="form-control select2bs4" style="width: 70%;" required>
                          <option selected>Pilih Pegawai..</option>
                          @foreach ($pegawai as $option)
                             <option value="{{$option->id}}">{{$option->nama}}</option>
                          @endforeach
                      </select>
                      <input type="hidden" value="{{$id}}" name="id_sppd">
                      <input class="btn btn-info ml-4" type="submit" value="Tambah">
                      <a href="/sppd" class="btn btn-success ml-5" style="color:white;">Selesai </a>
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
                <th>  Hapus  </th>
              </thead>
             <tbody>
               @foreach ($tugas as $item)
               @foreach ($pegawai as $row)
               @if ($item->id_pegawai == $row->id)
                 <tr>
                     <td>{{$item->id}}</td>
                     <td>{{$row->nama}}</td>
                     <td>{{$row->nip }}</td>
                     <td>{{$row->pangkat }}</td>
                     <td class="text-center">
                      <button class="btn btn-danger" data-toggle="modal" data-id="{{ $item->id }}" data-target="#delete"><i class="fas fa-trash"></i> </button>
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
                        <form action="/delete-petugas-sppd/data" method="post">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <p>Anda benar-benar ingin menghapus data ini ? Data yang sudah dihapus tidak dapat dikembalikan</p>
                        <input type="hidden" name="datadelete" id="id" value="">
                        <input type="hidden" name="id_sppd" value="{{$id}}">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-danger">DELETE</button>
                        </form>   
                      </div>
                    </div>
                  </div>
                </div> 
                 @endif           
                @endforeach    
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