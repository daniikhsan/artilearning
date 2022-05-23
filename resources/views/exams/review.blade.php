@extends('layouts.admin.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-6">
            <h6 class="m-0"><i>Review</i></h6>
            <h1 class="m-0">{{ $title }}</h1> 
            <p class="m-0">Start : {{ \Carbon\Carbon::parse($user_exam->start_datetime)->format('D, d M Y H:i:s') }} WITA</p>
            <p class="m-0">End : {{ \Carbon\Carbon::parse($user_exam->finish_datetime)->format('D, d M Y H:i:s') }} WITA</p>
        </div>
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@php 
use App\Models\AnswerOption;
use App\Models\QuestionCategory;
@endphp
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    @foreach($questions as $question)
                        <div class="col-md-12">
                            <h5 class="mb-1"><b>{{ $loop->iteration }}. {{ $question->question }}</b></h5>
                            <p class="mt-0"><b>
                                Category :
                                {{ $question->question_category->name }}
                                </b>
                            </p>
                            <p>A. {{ $question->answer_options[0]['option'] }}</p>
                            <p>B. {{ $question->answer_options[1]['option'] }}</p>
                            <p>C. {{ $question->answer_options[2]['option'] }}</p>
                            <p>D. {{ $question->answer_options[3]['option'] }}</p>
                            @php
                                $user_answer = AnswerOption::find($user_answers[$question->id]);
                                $correct_answer = AnswerOption::where('question_exam_id', $question->id)->where('is_true', 1)->first();
                            @endphp
                            <p>Your Answer : 
                                {{ $user_answer->option }} {{ $user_answer->option ==  $correct_answer->option ? '(TRUE)' : '(FALSE)'}}
                            </p>
                            <p>Correct Answer :
                                {{ $correct_answer->option }}
                            </p>
                            
                        </div>
                    @endforeach
                </div>
                <div class="col-md-3">
                    <img src="{{ $img_src }}" alt="" width="100%"><br><br>
                    <table class="table table-striped " width="100%">
                        <thead>
                            <tr class="text-center">
                                <td><b>Category</b></td>
                                <td><b>Score</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grade_details as $grade)
                                @php $category = QuestionCategory::findOrFail($grade->category_id); @endphp
                                <tr class="text-center">
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $grade->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td><b>Total</b></td>
                                <td><b>{{ $grade_exam->score }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection