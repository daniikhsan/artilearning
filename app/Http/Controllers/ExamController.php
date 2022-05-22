<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use App\Models\QuestionCategory;
use App\Models\QuestionExam;
use App\Models\AnswerOption;
use App\Http\Requests\ExamStoreRequest;

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
            
            foreach ($request->category as $key => $value) {
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
}
