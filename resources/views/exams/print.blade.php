<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Review {{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/admin/dist/css/adminlte.min.css')}}">

  <style>
    .page-break {
        page-break-after: always;
    }
  </style>
</head>
<body>
@php 
use App\Models\AnswerOption;
use App\Models\QuestionCategory;
@endphp
<center>
    <h1 class="m-0">{{ $title }}</h1> 
    <h6 class="mb-1"><i>Review {{ $course->name }}</i></h6>
    <p class="m-0">Start : {{ \Carbon\Carbon::parse($user_exam->start_datetime)->format('D, d M Y H:i:s') }} WITA | Finish : {{ \Carbon\Carbon::parse($user_exam->finish_datetime)->format('D, d M Y H:i:s') }} WITA</p>
</center>
<hr>
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
</div>
<div class="page-break"></div>
<div class="row">
    <div class="col-md-12">
        <center><img src="@php echo $img_src @endphp" alt="Pie Chart" width="50%"></center><br><br>
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
</body>
</html>
