@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
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
@php 
use App\Models\QuestionCategory;
@endphp
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
                            <th>Majors</th>
                            <th>Score</th>
                            <th width="15px">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_exams as $user_exam)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $user_exam->user->name }}</td>
                            <td class="text-center">{{ $user_exam->user->major->name }}</td>
                            <td class="text-center">
                                @foreach($user_exam->grades as $user_grade)
                                    @if($user_grade->user_exam_id == $user_exam->id)
                                        {{ $user_grade->score }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-default mr-2" data-toggle="modal" data-target="#modal-default-{{ $user_exam->id }}"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        <!-- User Show -->
                        <div class="modal fade" id="modal-default-{{$user_exam->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ $user_exam->user->name }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <small class="m-0">Start Time</small>
                                            <p class="mb-2">{{ date('D, d M Y H:i:s' ,strtotime($user_exam->start_datetime)) }} WITA</p>
                                            <small class="m-0">End Time</small>
                                            <p class="mb-2">{{ date('D, d M Y H:i:s' ,strtotime($user_exam->end_datetime)) }} WITA</p>
                                            <small class="m-0">Total Score</small>
                                            <p class="mb-2">@foreach($user_exam->grades as $user_grade)
                                                @if($user_grade->user_exam_id == $user_exam->id)
                                                    {{ $user_grade->score }}
                                                @endif
                                            @endforeach</p>
                                            @foreach($user_exam->grades as $user_grade)
                                                @if($user_grade->user_exam_id == $user_exam->id)
                                                   @foreach($user_grade->grade_details as $grade_detail)
                                                    <small class="m-0">
                                                        @php $question_category = QuestionCategory::find($grade_detail->category_id); @endphp
                                                        {{ $question_category->name }}
                                                    </small>
                                                    <p class="mb-2">{{ $grade_detail->score }}</p>
                                                   @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
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
                            <th>Majors</th>
                            <th>Score</th>
                            <th>Detail</th>
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