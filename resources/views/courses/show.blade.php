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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($exams as $exam)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <b>{{ $exam->name }}</b> 
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Date : <b>{{ date('D, d M Y H:i:s' ,strtotime($exam->start_datetime)) }} s/d {{ date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)) }} WITA</b>  <br>
                                Your Score : <b>-/-</b>
                                 
                            </p>
                            @if(auth()->user()->role == 'student')
                                <a href="#" class="btn btn-primary {{ $current_date < date('D, d M Y H:i:s' ,strtotime($exam->start_datetime)) ? 'disabled' : $current_date > date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)) ? 'disabled' : ''  }}">Attempt</a>
                                @if($current_date > date('D, d M Y H:i:s' ,strtotime($exam->end_datetime)))
                                    <a href="#" class="btn btn-default ">Review</a>
                                @endif
                            @endif
                            @if(auth()->user()->role == 'lecturer')
                                @php 
                                    $question_exists = \App\Models\QuestionExam::where('exam_id', $exam->id)->exists();
                                @endphp
                                @if(!$question_exists)
                                    <a href="{{ route('exam.create.question', [$course->id, $exam->id]) }}" class="btn btn-default">Add Question</a>
                                @endif
                                <a href="{{ route('exam.create.question', [$course->id, $exam->id]) }}" class="btn btn-success">Report</a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection