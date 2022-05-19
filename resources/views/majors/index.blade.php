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
                <a href="{{ route('major.create') }}" class="btn btn-outline-primary float-right"><i class="fas fa-plus mr-2"></i> Add Major</a>
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
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($majors as $major)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $major->name }}</td>
                                <td>{{ $major->department->name }}</td>
                                <td class="text-center">
                                    <div class="btn btn-toolbar justify-content-center">
                                        <a href="{{ route('major.edit', $major->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                        <form action="{{ route('major.destroy', $major->id) }}" method="post" onsubmit=" return confirm('Are you sure want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger {{ $major->role == 'admin' ? 'disabled' : '' }}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Name</th>
                            <th>Majors</th>
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