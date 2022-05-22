<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Requests\CourseAddStudentRequest;
use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;

class CourseSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Courses';
        $courses = Course::all();

        return view('courses.settings-crud.index',[
            'title' => $title,
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Course';
        $lecturers = User::where('role','lecturer')->get();

        return view('courses.settings-crud.create',[
            'title' => $title,
            'lecturers' => $lecturers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        try {
            Course::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'day' => $request->day,
                'hour' => $request->start_hour . ':' . $request->start_minute . ' - '. $request->end_hour . ':' . $request->end_minute,
            ]);

            return redirect()->route('course-setting.index')->with('success', 'Course successfully added.');
        }catch(\Throwable $th){
            return redirect()->route('course-setting.create')->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
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
        $title = 'Edit Course';
        $course = Course::findOrFail($id);
        $lecturers = User::where('role','lecturer')->get();

        $hour = explode(' - ',$course->hour);
        $start = explode(':', $hour[0]);
        $end = explode(':', $hour[1]);
        
        return view('courses.settings-crud.edit',[
            'title' => $title,
            'course' => $course,
            'lecturers' => $lecturers,
            'start' => $start,
            'end' => $end,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->name = $request->name;
            $course->user_id = $request->user_id;
            $course->day = $request->day;
            $course->hour = $request->start_hour . ':' . $request->start_minute . ' - '. $request->end_hour . ':' . $request->end_minute;
            $course->update();
    
            return redirect()->route('course-setting.index')->with('success', 'Course successfully updated.');
        }catch(\Throwable $th){
            return redirect()->route('course-setting.edit', $course->id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('course-setting.index')->with('success', 'Course successfully deleted.');
    }

    public function add_student($id)
    {
        $course = Course::findOrFail($id);
        $title = 'Add Student(s)';
        $students = User::where('role','student')->get();

        return view('courses.settings-crud.add-student',[
            'title' => $title,
            'students' => $students,
            'course' => $course,
        ]);
    }
    
    public function store_student(CourseAddStudentRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course_user_id = UserCourse::where('course_id', $id)->pluck('user_id')->toArray();
        $ids = [];

        try{
            foreach($request->user_id as $key => $value){
                if(in_array($value, $ids) || in_array($value, $course_user_id)){
                    continue;
                }
                UserCourse::create([
                    'user_id' => $value,
                    'role' => 'student',
                    'course_id' => $course->id
                ]);
                array_push($ids, $value);
            }

            return redirect()->route('course-setting.index')->with('success', 'Student(s) successfully added.');
        }catch(\Throwable $th){
            return redirect()->route('course-setting.add-student', $course->id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.' . $th->getMessage());
        }
    }
}
