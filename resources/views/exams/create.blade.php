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
                <div class="card mb-2">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('exam.store', $course->id) }}" method="post">  
                            @csrf
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
                                            <input type="text" class="form-control datetimepicker-input @error('start_datetime') is-invalid @enderror" data-target="#start_datetime" placeholder="Input Start Datetime..." name="start_datetime"/>
                                            <div class="input-group-append" data-target="#start_datetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('start_datetime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="end_date">End Date</label>
                                        <div class="input-group date" id="end_datetime" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input @error('end_datetime') is-invalid @enderror" data-target="#end_datetime" placeholder="Input End Datetime..." name="end_datetime"/>
                                            <div class="input-group-append" data-target="#end_datetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('end_datetime')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <table id="categories" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="90%">
                                            <div class="form-group mb-2">
                                                <label for="category-1">Category</label>
                                                <input type="text" name="category[]" class="form-control rounded-0 @error('category[]') is-invalid @enderror" id="category-1" placeholder="Input Category..." value="{{ old('category[]') }}">
                                                @error('category[]')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </td>
                                        <td width="10%" class="text-center mb-0">
                                            <label for="" class="mb-0"><br>    
                                            <button type="button" class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary float-right mt-2" type="submit"><i class="fas fa-save mr-2"></i> Save</button>
                                    <button type="button" class="btn btn-default float-right mt-2 mr-2" id="add-category"><i class="fas fa-plus mr-1"></i> Add More Category</button>
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

@push('script')
<!-- Select2 -->
<script src="{{ asset('template/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
//Date and time picker
$('#start_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });
$('#end_datetime').datetimepicker({ icons: { time: 'far fa-clock' } });

let i = 1
$('#add-category').on('click', function(e){
    e.preventDefault()
    ++i
    let row = `
    <tr>
        <td width="90%">
            <div class="form-group mb-2">
                <label for="category-${i}">Category</label>
                <input type="text" name="category[]" class="form-control rounded-0 @error('category[]') is-invalid @enderror" id="category-${i}" placeholder="Input Category..." value="{{ old('category[]') }}">
                @error('category[]')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </td>
        <td width="10%" class="text-center mb-0">
            <label for="" class="mb-0"><br>    
            <button type="button" class="btn btn-block btn-danger float-right remove-input-field"><i class="fas fa-trash"></i></button>
        </td>
    </tr>
    `
    $('#categories').append(row)

})
$(document).on('click', '.remove-input-field', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush

