@extends('layouts.admin',['module'=>'PPTK','judul'=>'Petugas Pelaksana Teknis Kegiatan'])
@section('title')
    <title>PPTK</title>
@endsection
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <a href="/create-pptk" type="submit" class="btn btn-primary">Tambah data PPTK</a>
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
                <th> ID  </th>
                <th> Nama  </th>
                <th> Nip  </th>
                <th> Jabatan </th>
                <th>  Pangkat  </th>
                <th class="text-center">  DELETE  </th>
              </thead>
             <tbody>
               @foreach ($pptk as $item)
                  @foreach ($pegawai as $row)
                    @if ($row->id == $item->id_karyawan)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->nip }}</td>
                            <td>{{$row->jabatan }}</td>
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
                                <form action="/delete-pptk/data" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                <p>Anda benar-benar ingin menghapus data ini ? Data yang sudah dihapus tidak dapat dikembalikan</p>
                                <input type="text" name="datadelete" id="id" value="">
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
          </div>
        </div>
      </div>
    </div> 
  </div>  
</div>
@endsection