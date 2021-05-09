@extends('layouts.master')

@section('title')
    User
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>@if ($edit) Edit User @else Add User @endif </h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data User</li>
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
<div class="card card-info">
    <div class="card-header">
    <h3 class="card-title">
    @if ($edit)
        Form Edit User
    @else
        Form Add User
    @endif
    </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ $edit ? route('user.update', ['user' => encrypt($user->id)]) : route('user.store') }}" method="POST">
        @if ($edit)
            {{ method_field('PUT') }}
        @endif
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $edit ? $user->name : old('name') }}" disabled>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $edit ? $user->email : old('email') }}" disabled>
                 @if($errors->has('email'))
                    <label id="login-error" class="text-danger">{{ $errors->first('email') }}</label>
                @endif
            </div>
            <div class="form-group">
                <label>Nomor Ponsel</label>
                <input type="number" class="form-control" id="nohp" name="nohp" value="{{ $edit ? $user->biodata->nohp : old('nohp') }}" disabled>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $edit ? $user->biodata->jabatan : old('jabatan') }}" disabled>
            </div>
            {{--  <div class="form-group">
                <label>Unit/Penugasan</label>
                <input type="text" class="form-control" id="unit" name="unit" value="{{ $edit ? $user->biodata->unit : old('unit') }}" disabled>
            </div>  --}}
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $edit ? $user->biodata->alamat : old('alamat') }}" disabled>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ url('/user') }}" class="btn btn-secondary">Kembali</a> |
            <a href="{{ route('user.edit', ['user' => encrypt($user->id)]) }}" class="btn btn-warning">Edit</a>
        </div>
    </form>
</div>

@endsection

@section('js')
    <script src="{{ url('asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
