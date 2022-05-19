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
                    <form action="{{ route('student.update', $student->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="id_number">ID Number (NIM/NIP)</label>
                            <input type="text" name="id_number" class="form-control rounded-0 @error('id_number') is-invalid @enderror" id="id_number" placeholder="Input ID Number..." value="{{ old('id_number', $student->id_number) }}">
                            @error('id_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="Input Name..." value="{{ old('name', $student->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control rounded-0 @error('email') is-invalid @enderror" id="email" placeholder="Input Email..." value="{{ old('email', $student->email) }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class="form-control rounded-0 @error('address') is-invalid @enderror" rows="2" placeholder="Input address...">{{ old('address', $student->address) }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="gender">Gender</label>
                            <select class="custom-select rounded-0 @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option selected disabled>Choose Gender...</option>
                                <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-2">
                                    <label for="birthplace">Birthplace</label>
                                    <input type="text" name="birthplace" class="form-control rounded-0 @error('birthplace') is-invalid @enderror" id="birthplace" placeholder="Input Birthplace..." value="{{ old('birthplace', $student->birthplace) }}">
                                    @error('birthplace')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-2">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control rounded-0 @error('date_of_birth') is-invalid @enderror" id="date_of_birth" placeholder="Input Date of Birth..." value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                    @error('date_of_birth')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="religion">Religion</label>
                            <select class="custom-select rounded-0 @error('religion') is-invalid @enderror" id="religion" name="religion">
                                <option selected disabled>Choose Religion...</option>
                                <option value="Islam" {{ old('religion', $student->religion) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Protestan" {{ old('religion', $student->religion) == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                <option value="Katolik" {{ old('religion', $student->religion) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('religion', $student->religion) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('religion', $student->religion) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('religion', $student->religion) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                            @error('religion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="major">Major</label>
                            <select class=" @error('major') is-invalid @enderror select2" id="major" name="major" style="width: 100%;">
                                <option selected disabled>Choose Major...</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}" {{ old('major', $student->major_id) == $major->id ? 'selected' : '' }}>{{ Str::title($major->name) }} ({{ Str::title($major->department->name) }})</option>
                                @endforeach
                            </select>
                            @error('major')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
