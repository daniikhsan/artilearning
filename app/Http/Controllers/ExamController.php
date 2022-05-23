<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use App\Models\QuestionCategory;
use App\Models\QuestionExam;
use App\Models\AnswerOption;
use App\Models\UserAnswer;
use App\Models\UserExam;
use App\Models\Grade;
use App\Models\GradeDetail;
use App\Http\Requests\ExamStoreRequest;
use Barryvdh\DomPDF\Facade\PDF;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $course = Course::findOrFail($id);
        $title = 'Add Exam';

        return view('exams.create',[
            'title' => $title,
            'course' => $course,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request, $id)
    {
        // return strtotime($request->start_datetime);
        try {
            $exam = Exam::create([
                'name' => $request->name,
                'start_datetime' => date('Y-m-d H:i:s', strtotime($request->start_datetime)),
                'end_datetime' => date('Y-m-d H:i:s', strtotime($request->end_datetime)),
                'course_id' => $id
            ]);
            
            foreach($request->category as $key => $value) {
                QuestionCategory::create([
                    'name' => $value,
                    'exam_id' => $exam->id
                ]);
            }

            return redirect()->route('course.show', $id)->with('success', 'Exam successfully added.');
        } catch (\Throwable $th) {
            return redirect()->route('exam.create', $id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_question($course_id, $exam_id)
    {
        $course = Course::findOrFail($course_id);
        $exam = Exam::findOrFail($exam_id);
        $title = 'Add Question';
        $categories = $exam->categories; 

        return view('exams.add_question',[
            'title' => $title,
            'course' => $course,
            'exam' => $exam,
            'categories' => $categories,
        ]);
    }

    public function store_question(Request $request, $course_id, $exam_id)
    {
        try {
            $options = [];
        
            $no = 0;
            $opt = 0;
            for ($i=0; $i < count($request->option); $i++) { 
                $options[$no][$opt] = $request->option[$i];
                $opt++;
                if(($i+1) % 4 == 0){
                    $no++;
                    $opt = 0;
                } 
            }

            foreach ($request->question as $key => $value) {
                $question = QuestionExam::create([
                    'question_category_id' => $request->category[$key],
                    'exam_id' => $exam_id,
                    'question' => $value,
                ]);
                
                for ($i=0; $i < count($options[$key]); $i++) {
                    $is_true = 0; 
                    if($request->true_option[$key] == 'A' && $i == 0){
                        $is_true = 1;
                    }
                    if($request->true_option[$key] == 'B' && $i == 1){
                        $is_true = 1;
                    }
                    if($request->true_option[$key] == 'C' && $i == 2){
                        $is_true = 1;
                    }
                    if($request->true_option[$key] == 'D' && $i == 3){
                        $is_true = 1;
                    }

                    AnswerOption::create([
                        'exam_id' => $exam_id,
                        'question_exam_id' => $question->id,
                        'option' => $options[$key][$i],
                        'is_true' => $is_true 
                    ]);
                }
            }

            return redirect()->route('course.show', $course_id)->with('success', 'Questions successfully added.');
        } catch (\Throwable $th) {
            return redirect()->route('exam.create.question', [$course_id, $exam_id])->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.' . $th->getMessage());
        }

        // dd($options);
    }

    public function attempt($course_id, $exam_id){
        $course = Course::findOrFail($course_id);
        $exam = Exam::findOrFail($exam_id);
        $title = $exam->name;

        $check_exam = UserExam::where([
            ['user_id','=',auth()->user()->id],
            ['exam_id','=',$exam_id],
        ])->exists();

        if(!$check_exam){
            UserExam::create([
                'user_id' => auth()->user()->id,
                'exam_id' => $exam_id,
                'start_datetime' => date('Y-m-d H:i:s'),
            ]);
        }
        // return response()->json($exam->questions);
        // dd($exam->questions());

        return view('exams.attempt',[
            'title' => $title,
            'course' => $course,
            'exam' => $exam,
        ]);
    }

    public function submit(Request $request, $course_id, $exam_id){

        try {
            $user_exam = UserExam::where([
                ['user_id','=',auth()->user()->id],
                ['exam_id','=',$exam_id],
            ])->first();
            $user_exam->finish_datetime = date('Y-m-d H:i:s');
            $user_exam->update();
            
            $true = 0;
            foreach ($request->answer_option as $key => $value) {
                $answer_option = AnswerOption::where([
                    ['exam_id', '=' ,$exam_id],
                    ['id', '=' ,$value],
                ])->first();
                if($answer_option->is_true == 1){
                    $is_true = 1;
                    $true += 1;
                }else{
                    $is_true = 0;
                }
                $user_answer = UserAnswer::create([
                    'user_exam_id' => $user_exam->id,
                    'answer_option_id' => $value,
                    'question_exam_id' => $key,
                    'score' => $is_true
                ]);
            }

            $questions = QuestionExam::where('exam_id', $exam_id)->get();
            $count_questions = count($questions);
            $score = round($true/$count_questions*100, 2);
            // dd($score);
            $grade = Grade::create([
                'user_exam_id' => $user_exam->id,
                'score' => $score,
            ]);

            $count_categories = [];
            $exam = Exam::findOrFail($exam_id);
            $categories = $exam->categories;
            
            foreach ($categories as $category) 
            {
                $correct = 0;
                $questions_exam_category = QuestionExam::where([
                    ['exam_id','=', $exam_id],
                    ['question_category_id','=', $category['id']],
                ])->get();
                
                $total_question_category = count($questions_exam_category);

                foreach ($questions_exam_category as $key => $question_exam_category) {
                    $user_answers_category = UserAnswer::where('question_exam_id',$question_exam_category['id'])->first();

                    if($user_answers_category->score == 1){
                        $correct += 1;
                    }

                }

                $score = $correct/$total_question_category * 100;

                $grade_details = GradeDetail::create([
                    'grade_id' => $grade->id,
                    'category_id' => $category['id'],
                    'correct_answer' => $correct,
                    'total_question' => $total_question_category,
                    'score' => round($score, 2),
                ]);

            }

            return redirect()->route('exam.review', [$course_id, $exam_id, $user_exam->id]);
        } catch (\Throwable $th) {
            return redirect()->route('exam.attempt', [$course_id, $exam_id])->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.' .$th->getMessage());
        }
    }

    public function review($course_id, $exam_id, $user_exam_id){
        $user_exam = UserExam::findOrFail($user_exam_id);
        $exam = Exam::findOrFail($exam_id);
        $title = $exam->name;
        $questions = $exam->questions;
        $user_answers = UserAnswer::where('user_exam_id', $user_exam_id)->pluck('answer_option_id','question_exam_id');

        $grade_exam = Grade::where('user_exam_id', $user_exam_id)->first();
        $grade_details = GradeDetail::where('grade_id', $grade_exam->id)->get();

        $labels = [];
        $data = [];

        foreach($grade_details as $grade){
            $category_chart = QuestionCategory::findOrFail($grade->category_id);
            array_push($labels, $category_chart->name);
            array_push($data, $grade->score);
        }
        $img_src = "https://quickchart.io/chart?c={type:'pie',data:{labels:[". "'" . implode("','", $labels) . "'" ."], datasets:[{data:[". "'" . implode("','", $data) . "'" ."]}]}}";

        return view('exams.review',[
            'title' => $title,
            'exam' => $exam,
            'questions' => $questions,
            'user_answers' => $user_answers,
            'user_exam' => $user_exam,
            'grade_exam' => $grade_exam,
            'grade_details' => $grade_details,
            'img_src' => $img_src,
            'course_id' => $course_id,
            'exam_id' => $exam_id,
            'user_exam_id' => $user_exam_id,
        ]);
    }

    public function export_pdf($course_id, $exam_id, $user_exam_id){
        $course = Course::findOrFail($course_id);
        $user_exam = UserExam::findOrFail($user_exam_id);
        $exam = Exam::findOrFail($exam_id);
        $title = $exam->name;
        $questions = $exam->questions;
        $user_answers = UserAnswer::where('user_exam_id', $user_exam_id)->pluck('answer_option_id','question_exam_id');

        $grade_exam = Grade::where('user_exam_id', $user_exam_id)->first();
        $grade_details = GradeDetail::where('grade_id', $grade_exam->id)->get();

        $labels = [];
        $data = [];

        foreach($grade_details as $grade){
            $category_chart = QuestionCategory::findOrFail($grade->category_id);
            array_push($labels, $category_chart->name);
            array_push($data, $grade->score);
        }
        $img_src = "https://quickchart.io/chart?c={type:'pie',data:{labels:[". "'" . implode("','", $labels) . "'" ."], datasets:[{data:[". "'" . implode("','", $data) . "'" ."]}]}}";

        return view('exams.print',[
            'title' => $title,
            'exam' => $exam,
            'course' => $course,
            'questions' => $questions,
            'user_answers' => $user_answers,
            'user_exam' => $user_exam,
            'grade_exam' => $grade_exam,
            'grade_details' => $grade_details,
            'img_src' => $img_src,
            'course_id' => $course_id,
            'exam_id' => $exam_id,
            'user_exam_id' => $user_exam_id,
        ]);

        $pdf = PDF::loadView('exams.print',[
            'title' => $title,
            'exam' => $exam,
            'course' => $course,
            'questions' => $questions,
            'user_answers' => $user_answers,
            'user_exam' => $user_exam,
            'grade_exam' => $grade_exam,
            'grade_details' => $grade_details,
            'img_src' => $img_src,
            'course_id' => $course_id,
            'exam_id' => $exam_id,
            'user_exam_id' => $user_exam_id,
        ])->setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => TRUE, 'setIsRemoteEnabled' => TRUE])->setPaper('A4','portrait');
        return $pdf->stream('Review - '. $exam->name .'.pdf');
    }

    public function report($course_id, $exam_id){
        // $course = Course::findOrFail($id);
        $title = 'Report';
        $user_exams = UserExam::where('exam_id', $exam_id)->where('finish_datetime','!=',null)->get();
        // return $user_exams;
        return view('exams.report',[
            'title' => $title,
            'user_exams' => $user_exams,
        ]);
    }
}
