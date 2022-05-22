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
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('images/course-default.jpg') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title"><b>{{ $course->name }}</b></h3>
                                    <p class="card-text">
                                        Lecturer&nbsp;: {{ $course->user->name }} <br> 
                                        @php  
                                            $exams = $course->exams;
                                        @endphp
                                        Next Exam&nbsp;: {{ $current_date < date('D, d M Y H:i:s' ,strtotime($exams->last()->start_datetime))  ? date('D, d M Y H:i:s' ,strtotime($exams->last()->start_datetime)) . ' WITA' : '-'  }}
                                    </p>
                                    <a href="{{ route('course.show',$course->id) }}" class="btn btn-primary">Go to Course</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</section>
<!-- /.content -->

@endsection
