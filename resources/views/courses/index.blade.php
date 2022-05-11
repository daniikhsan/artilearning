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
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/course-default.jpg') }}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title"><b>Pemrograman Web</b></h3>
                                <p class="card-text">
                                    Lecturer&nbsp;: Aidil Saputra Kirsan, S.ST., M.Tr.Kom <br>
                                    Next Exam&nbsp;: Friday, 13 May 2022
                                </p>
                                <a href="{{ route('course.show',1) }}" class="btn btn-primary">Go to Course</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-stream mr-2"></i>
                            Timeline
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-2">
                            <a href="#">
                                <div class="row"  style="color: #000;">
                                    <div class="col-md-2 col-xl-1 my-auto">
                                        <i class="fas fa-scroll fa-2xl"></i>
                                    </div>
                                    <div class="col-md-7 col-xl-8">
                                        <h5 class="mb-0">Ujian Front End</h5>
                                        <small>Pemrograman Web | 25 May 2022</small>
                                    </div>
                                    <div class="col-md-3 col-xl-3 my-auto">
                                       <small class="float-right">15:00 WITA</small> 
                                    </div>
                                </div>
                            </a>
                            <hr>
                        </div>
                        <div class="mb-2">
                            <a href="#">
                                <div class="row"  style="color: #000;">
                                    <div class="col-md-2 col-xl-1 my-auto">
                                        <i class="fas fa-scroll fa-2xl"></i>
                                    </div>
                                    <div class="col-md-7 col-xl-8">
                                        <h5 class="mb-0">Ujian Front End</h5>
                                        <small>Pemrograman Web | 25 May 2022</small>
                                    </div>
                                    <div class="col-md-3 col-xl-3 my-auto">
                                       <small class="float-right">15:00 WITA</small> 
                                    </div>
                                </div>
                            </a>
                            <hr>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /.content -->

@endsection
