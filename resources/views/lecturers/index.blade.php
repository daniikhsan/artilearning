@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-md-6">
                <a href="{{ route('lecturer.create') }}" class="btn btn-outline-primary float-right"><i class="fas fa-plus mr-2"></i> Add Lecturer</a>
            </div>
        </div><!-- /.row -->
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible mb-0 mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('error'))
            <div class="alert alert-warning alert-dismissible mb-0 mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                {{ Session::get('error') }}
            </div>
        @endif
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="15px">No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Major</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lecturers as $lecturer)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $lecturer->name }}</td>
                                <td class="text-center">{{ $lecturer->email }}</td>
                                <td class="text-center">{{ $lecturer->major->name }}</td>
                                <td class="text-center">{{ Str::title($lecturer->role) }}</td>
                                <td class="text-center">
                                    <div class="btn btn-toolbar justify-content-center">
                                        <button class="btn btn-sm btn-default mr-2" data-toggle="modal" data-target="#modal-default-{{ $lecturer->id }}"><i class="fa fa-eye"></i></button>
                                        <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                        <form action="{{ route('lecturer.destroy', $lecturer->id) }}" method="post" onsubmit=" return confirm('Are you sure want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger {{ $lecturer->role == 'admin' ? 'disabled' : '' }}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- User Show -->
                            <div class="modal fade" id="modal-default-{{$lecturer->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ $lecturer->name }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{ url($lecturer->avatar) }}" alt="{{ $lecturer->name }}" width="100" class="mb-3">
                                            </div>
                                            <div class="col-9">
                                                <small class="m-0">Name</small>
                                                <p class="mb-2">{{ $lecturer->name }}</p>
                                                <small class="m-0">Email</small>
                                                <p class="mb-2"><i>{{ $lecturer->email }}</i></p>
                                                <small class="m-0">Role</small>
                                                <p class="mb-2"><i>{{ Str::title($lecturer->role) }}</i></p>
                                                <small class="m-0">Major/Department</small>
                                                <p class="mb-2"><i>{{ $lecturer->major->name }}/{{ $lecturer->major->department->name }}</i></p>
                                                <small class="m-0">Gender</small>
                                                <p class="mb-2"><i>{{ $lecturer->gender }}</i></p>
                                                <small class="m-0">Address</small>
                                                <p class="mb-2"><i>{{ $lecturer->address }}</i></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <div>
                                            <a href="{{ route('lecturer.edit', $lecturer->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-pen"></i> Edit</a>
                                            <form action="{{ route('lecturer.destroy', $lecturer->id) }}" method="post" onsubmit=" return confirm('Are you sure want to delete this item?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger {{ $lecturer->role == 'admin' ? 'disabled' : '' }}"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- ./User Show -->
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Major</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- /.content -->


@endsection

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@push('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('template/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function () {
        $('#table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush