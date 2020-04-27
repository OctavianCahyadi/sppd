@extends('layouts.admin',['module'=>'Setting','judul'=>'Pengaturan Surat'])
@section('title')
    <title>Setting</title>
@endsection
@section('content')
    <div class="container">
        <div class="card">
        <div class="col-md-6 ml-3">
            <div class="row mt-1 mb-1">
                <h5><b>Kepala Dinas</b></h5><br>                
            </div>
            <div class="row mt-1 mb-1">
                @foreach ($setting as $item)
                    @foreach ($pegawai as $row)
                        @if ($row->id == $item->id_kadis)
                            @php
                               $namakadis=$row->nama;
                               $nip=$row->nip 
                            @endphp
                        @endif                    
                    @endforeach
                @endforeach
            <h3>Nama: {{$namakadis}}</h3>
            <h5>NIP: {{$nip}}</h5>
            </div>
            <div class="row mt-1 mb-1">
                <h5><b>Bendahara</b></h5><br>
            </div>
            <div class="row mt-1 mb-1">
                @foreach ($setting as $item)
                    @foreach ($pegawai as $row)
                        @if ($row->id == $item->id_bendahara)
                            @php
                                $namaB=$row->nama;
                                $nipB=$row->nip 
                            @endphp
                        @endif                    
                    @endforeach
                @endforeach
            <h3>Nama: {{$namaB}}</h3>
            <h5>NIP: {{$nipB}}</h5>
            </div>
            <div class="row mt-1 mb-1">
                <h5><b>Mata Anggaran</b></h5><br>
            </div>
            <div class="row mt-1 mb-1">
                <h3>{{$item->mata_anggaran}}</h3>
            </div>
            <div class="row mt-1 mb-1">
                <h5><b>Tahun Anggaran</b></h5><br>
            </div>
            <div class="row mt-1 mb-1">
                <h3>{{$item->tahun_anggaran}}</h3>
            </div>
            <div class="row mt-1 mb-1">
                <a href="/edit-setting/{{$item->id}}" class="btn btn-success">EDIT Kadis / Bendahara</a>
            </div>
            <div class="row mt-1 mb-1">
                <a href="/edit-setting-anggaran/{{$item->id}}" class="btn btn-success">EDIT Anggaran</a>
            </div>
        </div>
    </div>
    </div>
@endsection