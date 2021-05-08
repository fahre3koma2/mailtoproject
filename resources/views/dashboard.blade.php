@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('contents')
@php
 $menu = 'dashboard';
@endphp

<div class="row">
    <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
        <h3>{{$email}}</h3>

        <p>Jumlah User</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
        <h3>{{$sudah}}<sup style="font-size: 20px"></sup></h3>

        <p>Sudah Verifikasi</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{$belum}}</h3>

        <p>Belum Verifikasi</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
    </div>
    </div>
    <!-- ./col -->
</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ url('theme/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('theme/js/pcoded.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('theme/js/vertical-layout.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ url('theme/js/script.min.js') }}"></script>
@endsection
