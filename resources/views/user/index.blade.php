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
                    <li class="breadcrumb-item active">Datatable</li>
                </ol>
            </div>
            <h4 class="page-title">List User</h4>
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
                <a href="{{ url('/user/create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Tambah User</a>
                <h4 class="mt-0 header-title">Default Datatable</h4>
                <br/>
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pegawai</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th width="20%">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($users as $value)
                    <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->biodata->no_pegawai}}</td>
                            <td>{{ $value->name}}</td>
                            {{--  <td>{{ $value->biodata->unit }}</td>  --}}
                            <td>{{ $value->biodata->jabatan }}</td>
                            <td>{{ $value->email }}</td>
                            <td>
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
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('js')
<!-- DataTables -->
    <script src="{{ url('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ url('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ url('assets/pages/datatables.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable();
        } );
    </script>

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
