@extends('layouts.admin.master')

@section('content')
@php
date_default_timezone_set('Asia/Makassar');
$current_date = date('D, d M Y H:i:s', time());
@endphp
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0">{{ $title }}</h1>
            Lecturer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $course->user->name }} <br>
            @php $day = 'next ' . $course->day @endphp
            Next Exam&nbsp;: {{ $current_date < date('D, d M Y H:i:s' ,strtotime($exams->last()->start_datetime))  ? date('D, d M Y H:i:s' ,strtotime($exams->last()->start_datetime)) . ' WITA' : '-'  }}
        </div><!-- /.col -->
        @if(auth()->user()->role == 'lecturer' && $course->user_id == auth()->user()->id)
            <div class="col-md-6">
                <a href="{{ route('exam.create', $course->id) }}" class="btn btn-outline-primary float-right"><i class="fas fa-plus mr-2"></i> Add Exam</a>
            </div>
        @endif
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
use App\Models\UserExam;
use App\Models\Grade;
@endphp
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($exams as $exam)
                @php 
                    $user_exam = UserExam::where('user_id', auth()->user()->id)->where('exam_id',$exam->id)->first();
                    if($user_exam){
                        $grade = Grade::where('user_exam_id', $user_exam->id)->first();
                    }
                @endphp
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $exam->name }}</b> 
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Date : <b>{{ date('D, d M Y H:i:s' ,strtotime($exam->start_datetime)) }} s/d {{ date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)) }} WITA</b>  <br>
                                Your Score : <b>{{ $user_exam? $grade->score : '-' }}/100</b>
                                 
                            </p>
                            @if(auth()->user()->role == 'student')
                                
                                @if($user_exam)
                                    @if($user_exam->finish_datetime == null)
                                        @if(Carbon\Carbon::now() >= $exam->start_datetime)
                                            <a href="{{ route('exam.attempt', [$course->id, $exam->id]) }}" class="btn btn-primary">Attempt</a>
                                        @endif
                                    @else
                                        <a href="{{ route('exam.review', [$course->id, $exam->id, $user_exam->id]) }}" class="btn btn-default ">Review</a>
                                    @endif
                                @else 
                                    @if(Carbon\Carbon::now() >= $exam->start_datetime && Carbon\Carbon::now() <= $exam->end_datetime)
                                        <a href="{{ route('exam.attempt', [$course->id, $exam->id]) }}" class="btn btn-primary">Attempt</a>
                                    @endif 
                                @endif
                            @endif
                            @if(auth()->user()->role == 'lecturer')
                                @php 
                                    $question_exists = \App\Models\QuestionExam::where('exam_id', $exam->id)->exists();
                                @endphp
                                @if(!$question_exists)
                                    <a href="{{ route('exam.create.question', [$course->id, $exam->id]) }}" class="btn btn-default">Add Question</a>
                                @endif
                                <a href="{{ route('exam.report', [$course->id, $exam->id]) }}" class="btn btn-success">Report</a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('css')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endpush

@push('js')

@endpush