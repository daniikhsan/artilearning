@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header mb-0">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-md-6">
                <h1 class="m-0">{{ $title }}</h1>
                <p class="m-0">{{ $course->name }} | {{ $exam->name }} <br> {{ date('D, d M Y H:i:s' ,strtotime($exam->start_datetime)) }} s/d {{ date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)) }} WITA</p>
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
                        <form action="{{ route('exam.submit', [$course->id, $exam->id]) }}" method="post"  onsubmit="return confirm('Are you sure you want to submit all of these answers?')">  
                            @csrf
                            @php $i = 0;  @endphp
                            @foreach($exam->questions as $question)
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="" class="mb-0">{{ $loop->iteration }}. {{ $question->question }}</label>
                                    </div>
                                </div>
                                @foreach($question->answer_options as $option)
                                    <div class="col-md-12">
                                        <div class="ml-2 icheck-primary d-inline">
                                            <input type="radio" id="{{ $option->option }}-{{$loop->iteration}}" name="answer_option[{{ $question->id }}]" value="{{ $option->id }}" required>
                                            <label for="{{ $option->option }}-{{$loop->iteration}}" style="font-weight: normal;">{{ $option->option }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @php $i++;  @endphp
                            @endforeach
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary float-right mt-2" type="submit"><i class="fas fa-sign-in-alt mr-2"></i> Submit</button>
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
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endpush
