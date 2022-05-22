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
            <form action="{{ route('course-setting.store.add-student', $course->id) }}" method="post">  
                <div class="card mb-2">
                <!-- /.card-header -->
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="Input Name..." value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="start_date">Start Date</label>
                                    <div class="input-group date" id="start_datetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#start_datetime" placeholder="Input Start Datetime..."/>
                                        <div class="input-group-append" data-target="#start_datetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="end_date">End Date</label>
                                    <div class="input-group date" id="end_datetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#end_datetime" placeholder="Input End Datetime..."/>
                                        <div class="input-group-append" data-target="#end_datetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <table width="100%" id="table-question">
                            <tbody id="row-question">
                                <tr data-id="1">
                                    <td width="90%">
                                        <div class="form-group mb-2">
                                            <label for="question-1">Question</label>
                                            <textarea class="form-control rounded-0 @error('question[]') is-invalid @enderror" name="question[]" id="question-1" cols="30" rows="2" placeholder="Input Question..."></textarea>
                                            @error('question[]')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label for="opt-a-1">Option A</label>
                                                <input type="text" name="option_a[]" class="form-control rounded-0 @error('option_a[]') is-invalid @enderror" id="opt-a-1" placeholder="Answer for Option A..." value="{{ old('option_a[]') }}">
                                                @error('option_a[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="opt-b-1">Option B</label>
                                                <input type="text" name="option_b[]" class="form-control rounded-0 @error('option_b[]') is-invalid @enderror" id="opt-b-1" placeholder="Answer for Option B..." value="{{ old('option_b[]') }}">
                                                @error('option_b[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="opt-c-1">Option C</label>
                                                <input type="text" name="option_c[]" class="form-control rounded-0 @error('option_c[]') is-invalid @enderror" id="opt-c-1" placeholder="Answer for Option C..." value="{{ old('option_c[]') }}">
                                                @error('option_c[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="opt-d-1">Option D</label>
                                                <input type="text" name="option_d[]" class="form-control rounded-0 @error('option_d[]') is-invalid @enderror" id="opt-d-1" placeholder="Answer for Option D..." value="{{ old('option_d[]') }}">
                                                @error('option_d[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="opt-d-1">Option D</label>
                                                <input type="text" name="option_d[]" class="form-control rounded-0 @error('option_d[]') is-invalid @enderror" id="opt-d-1" placeholder="Answer for Option D..." value="{{ old('option_d[]') }}">
                                                @error('option_d[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
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
                                <button type="button" class="btn btn-default float-right mt-2 mr-2" id="add-question"><i class="fas fa-plus"></i> Add More question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
//Date and time picker
$('#start_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });
$('#end_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });

let i = 1
function select2(){
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
}

select2()

$('#add-question').on('click', function(e){
        e.preventDefault()
        let tableRow = document.getElementById('table-question').getElementsByTagName('tr')
        
        i = i + 1
        let row  = `
        <tr data-id="${i}">
            <td width="90%">
                <div class="form-group mb-2">
                    <label for="user_id-${i}">question</label>
                    <select class=" @error('user_id') is-invalid @enderror select2" id="user_id-${i}" name="user_id[]" data-id="${i}" style="width: 100%;">
                        <option selected disabled>Choose question...</option>
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

        $('#row-question').append(row)
        select2()
})

$(document).on('click', '.remove-input-field', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush
