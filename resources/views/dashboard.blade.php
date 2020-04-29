@extends('layouts.admin',['module'=>'Dashboard','judul'=>'Dashboard'])
@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
<div class="container align-item-center">
    <div class="row align-center">
        <div class="col-md-12 text-center">
            <img src="../image/logo.png"alt="Logo Dinpar Bantul" class="img" style="opacity: .8; width: 5%">
            <h3> Dinas Pariwisata Kabupaten Bantul</h3>
            <h1> Selamat Datang di Sistem Generator SPPD</h1>
        </div>
    </div>
    <div class="row justify-content-center">        
        <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$pegawaicount}} Pegawai</h3>
                <p>Data Pegawai Dinas Pariwisata Kabupaten Bantul</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
            <a href="/pegawai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
            <h3>{{$sppdcount}} SPPD</h3>
            
            <p>Surat Perintah Perjalanan Dinas Kabupaten Bantul</p>
            </div>
            <div class="icon">
            <i class="ion ion-person-add"></i>
            </div>
            <a href="/sppd" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->      

    </div>
</div>
@endsection