@extends('layouts.admin',['module'=>'SPPD','judul'=>'Surat Perintah Perjalanan Dinas'])
@section('title')
    <title>SPPD</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <a href="/create-sppd" type="submit" class="btn btn-primary">Generate SPPD</a>
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
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>ID</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Pergi</th>
                <th>Acara</th>
                <th>Tujuan</th>
                <th>Edit</th>
                <th class="text-center">  DELETE  </th>
              </thead>
             <tbody>
               @foreach ($sppd as $row)
                 <tr>
                     <td>{{$row->id}}</td>
                     <td>{{$row->tgl_surat}}</td>
                     <td>{{$row->tgl_pergi }}</td>
                     <td>{{$row->acara }}</td>
                     <td>{{$row->tujuan }}</td>
                     <td>
                        <a href="/edit-sppd/{{$row->id}}" class="btn btn-success">EDIT</a>
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
                          <form action="/delete-sppd/data" method="post">
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
              {{ $sppd->links() }}
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>   
 
@endsection