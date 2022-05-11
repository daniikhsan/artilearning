@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0">{{ $title }}</h1>
            Lecturer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Aidil Saputra Kirsan, S.ST., M.Tr.Kom <br>
            Next Exam&nbsp;: Friday, 13 May 2022
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <b>Front End</b> 
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Date : <b>Friday, 6 May 2022 15:00 WITA</b>  <br>
                            Your Score : <b>-/-</b> 
                        </p>
                        <a href="#" class="btn btn-primary">Attempt</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <b>Basic Web Programming</b> 
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Date : <b>Friday, 22 Apr 2022 15:00 WITA</b>  <br>
                            Your Score : <b>80/100</b> 
                        </p>
                        <a href="#" class="btn btn-default">Review</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection