@extends('layouts.master')

@section('title')
    User
@endsection

@section('header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>List User</h1>
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
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Data User</h3>
    <a href="{{ url('/user/create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah User</a>
    </div>

    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Unit</th>
        <th>Jabatan</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach ($users as $value)
        <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->biodata->unit }}</td>
                <td>{{ $value->biodata->jabatan }}</td>
                <td>{{ $value->email }}</td>
                <td>
                    @if($value->biodata->status == 'done')
                        <span class="right badge badge-success">Sudah Verifikasi</span>
                    @else
                        <span class="right badge badge-warning">Belum Verifikasi</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('kirim', ['id' => encrypt($value->id)]) }}" class="btn btn-sm btn-info"><i class="fa fa-paper-plane"></i> Kirim Email</a> |
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Aksi</button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="{{ route('user.show', ['user' => encrypt($value->id)]) }}">Detail</a>
                            <a class="dropdown-item" href="{{ route('user.edit', ['user' => encrypt($value->id)]) }}">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                        </button>
                    </div> --}}
                    <a class="btn btn-sm btn-primary" href="{{ route('user.show', ['user' => encrypt($value->id)]) }}"><i class="fa fa-list"></i> Detail</a> |
                    <a class="btn btn-sm btn-warning" href="{{ route('user.edit', ['user' => encrypt($value->id)]) }}"><i class="fa fa-edit"></i> Edit</a> |
                    <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $value->id }}" data-file="{{$value->id}}"><i class="fa fa-trash"></i> Hapus</button>
                    {{ Form::open(['url'=>route('user.destroy', [Crypt::encrypt($value->id)]), 'method'=>'delete', 'id' => $value->id, 'style' => 'display: none;']) }}
                    {{ csrf_field() }}
                    {{ Form::close() }}

                </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection

@section('js')
<!-- DataTables -->
    <script src="{{ url('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ url('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $("body").on("click", ".delete", function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Anda akan menghapus data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.value) {
                    Swal.close();
                    $("#"+id).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Dibatalkan', 'Data batal dihapus', 'error');
                }
            });
        });
    </script>
@endsection
