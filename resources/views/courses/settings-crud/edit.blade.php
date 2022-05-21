@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-0">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
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
                    <form action="{{ route('course-setting.update', $course->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="Input Name..." value="{{ old('name', $course->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="user_id">Lecturer</label>
                            <select class=" @error('user_id') is-invalid @enderror select2" id="user_id" name="user_id" style="width: 100%;">
                                <option selected disabled>Choose Lecturer...</option>
                                @foreach($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id }}" {{ old('lecturer', $course->user_id) == $lecturer->id ? 'selected' : '' }}>{{ Str::title($lecturer->name) }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                <label for="day">Day</label>
                                <select class="custom-select rounded-0 @error('day') is-invalid @enderror" id="day" name="day">
                                    <option selected disabled>Choose Day...</option>
                                    <option value="Monday" {{ old('day', $course->day) == 'Monday' ? 'selected' : '' }}>Monday</option>
                                    <option value="Tuesday" {{ old('day', $course->day) == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                    <option value="Wednesday" {{ old('day', $course->day) == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                    <option value="Thursday" {{ old('day', $course->day) == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                    <option value="Friday" {{ old('day', $course->day) == 'Friday' ? 'selected' : '' }}>Friday</option>
                                    <option value="Saturday" {{ old('day', $course->day) == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                    <option value="Sunday" {{ old('day', $course->day) == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                </select>
                                @error('day')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            
                            

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="start_hour">Start</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input type="number" name="start_hour" class="form-control rounded-0 @error('start_hour') is-invalid @enderror" id="start_hour" placeholder="Hour..." value="{{ old('start_hour', $start[0]) }}" min="0" max="23">
                                                    @error('start_hour')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input type="number" name="start_minute" class="form-control rounded-0 @error('start_minute') is-invalid @enderror" id="start_minute" placeholder="Minute..." value="{{ old('start_minute', $start[1]) }}" min="0" max="59">
                                                    @error('start_minute')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_hour">End</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input type="number" name="end_hour" class="form-control rounded-0 @error('end_hour') is-invalid @enderror" id="end_hour" placeholder="Hour..." value="{{ old('end_hour', $end[0]) }}" min="0" max="23">
                                                    @error('end_hour')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <input type="number" name="end_minute" class="form-control rounded-0 @error('end_minute') is-invalid @enderror" id="end_minute" placeholder="Minute..." value="{{ old('end_minute', $end[1]) }}" min="0" max="59">
                                                    @error('end_minute')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <button class="btn btn-primary float-right mt-2"><i class="fas fa-save mr-2"></i> Save</button>
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
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
})

</script>
@endpush
