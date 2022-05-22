@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-0">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
                <p class="m-0">{{ $course->name }} <br> {{ $course->day }} ({{ $course->hour }} WITA) | {{ $course->user->name }}</p>
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
                    <form action="{{ route('course-setting.store.add-student', $course->id) }}" method="post">
                        @csrf
                        <table width="100%" id="table-student">
                            <tbody id="row-student">
                                <tr data-id="1">
                                    <td width="90%">
                                        <div class="form-group mb-2">
                                            <label for="user_id-1">Student</label>
                                            <select class=" @error('user_id[]') is-invalid @enderror select2" id="user_id-1" name="user_id[]" data-id="1" style="width: 100%;">
                                                <option selected disabled>Choose Student...</option>
                                                @foreach($students as $student)
                                                    <option value="{{ $student->id }}" {{ old('student') == $student->id ? 'selected' : '' }}>{{ $student->id_number }} | {{ Str::title($student->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id[]')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </td>
                                    <td width="10%" class="text-center">
                                        <label for="" class="mb-0"><br>    
                                        <button type="button" class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <button class="btn btn-primary float-right mt-2"><i class="fas fa-save mr-2"></i> Save</button>
                                <button type="button" class="btn btn-default float-right mt-2 mr-2" id="add-student"><i class="fas fa-plus"></i> Add More Student</button>
                            </div>
                        </div>
                    </form>
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
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template/admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('template/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('script')
<!-- Select2 -->
<script src="{{ asset('template/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
let i = 1

function select2(){
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
}

select2()

$('#add-student').on('click', function(e){
        e.preventDefault()
        let tableRow = document.getElementById('table-student').getElementsByTagName('tr')
        
        i = i + 1
        let row  = `
        <tr data-id="${i}">
            <td width="90%">
                <div class="form-group mb-2">
                    <label for="user_id-${i}">Student</label>
                    <select class=" @error('user_id') is-invalid @enderror select2" id="user_id-${i}" name="user_id[]" data-id="${i}" style="width: 100%;">
                        <option selected disabled>Choose Student...</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student') == $student->id ? 'selected' : '' }}>{{ $student->id_number }} | {{ Str::title($student->name) }}</option>
                        @endforeach
                    </select>
                    @error('user_id[]')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </td>
            <td width="10%" class="text-center">
                <label for="" class="mb-0"><br>    
                <button class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        `

        $('#row-student').append(row)
        select2()
})

$(document).on('click', '.remove-input-field', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush
