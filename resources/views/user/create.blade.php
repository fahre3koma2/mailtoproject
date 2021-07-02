@extends('layouts.master')

@section('title')
    User
@endsection

@section('header')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
            <h4 class="page-title">Tambah User</h4>
        </div>
    </div>
</div>
@endsection

@section('contents')
@php
 $menu = 'dashboard';
@endphp

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if ($edit)
                    <h4 class="mt-0 header-title">Form Edit User</h4>
                @else
                    <h4 class="mt-0 header-title">Form Add User</h4>
                @endif

                <form action="{{ $edit ? route('user.update', ['user' => encrypt($user->id)]) : route('user.store') }}" method="POST">
                @if ($edit)
                    {{ method_field('PUT') }}
                @endif
                @csrf

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">No Pegawai</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="no_pegawai" name="no_pegawai" value="{{ $edit ? $user->biodata->no_pegawai : old('no_pegawai') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="name" name="name" value="{{ $edit ? $user->name : old('name') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $edit ? $user->email : old('email') }}" required>
                        @if($errors->has('email'))
                            <label id="login-error" class="text-danger">{{ $errors->first('email') }}</label>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="nohp" name="nohp" value="{{ $edit ? $user->biodata->nohp : old('nohp') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $edit ? $user->biodata->jabatan : old('jabatan') }}">
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        <a href="{{ url('/user') }}" class="btn btn-secondary waves-effect m-l-5">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('js')

@endsection
