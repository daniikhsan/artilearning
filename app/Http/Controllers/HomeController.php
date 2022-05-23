<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCourse;
use App\Models\Course;
use App\Models\Exam;
use App\Models\UserExam;
use App\Models\Grade;
use App\Models\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        
        if(auth()->user()->role == 'admin'){
            $all_courses = [];
            $courses = Course::all();
            $lecturers = User::where('role','lecturer')->get();
            $students = User::where('role','student')->get();

            foreach ($courses as $course) {
                $user_course = UserCourse::where('course_id', $course['id'])->get();
                $all_courses[$course['id']]['name'] = $course['name'];
                $all_courses[$course['id']]['sum'] = count($user_course);
            }
            
            $courses_label = collect(collect($all_courses)->pluck('name'));
            $courses_data = collect(collect($all_courses)->pluck('sum'));
            // $courses_label = $all_courses['name'];
            // $courses_data = $all_courses['sum'];
            return view('admin',[
                'title' => $title,
                'all_courses' => $all_courses,
                'courses' => $courses,
                'lecturers' => $lecturers,
                'students' => $students,
                'courses_label' => $courses_label,
                'courses_data' => $courses_data,
            ]);

        }

        if(auth()->user()->role == 'lecturer'){
            $all_courses = [];
            $courses = Course::where('user_id', auth()->user()->id)->get();
            $total_students = UserCourse::whereIn('course_id', $courses)->get();

            foreach ($courses as $course) {
                $course_students = UserCourse::where('course_id', $course['id'])->get();
                $all_courses[$course['id']]['sum'] = count($course_students);
                $all_courses[$course['id']]['name'] = $course['name'];
            }

            $courses_label = collect(collect($all_courses)->pluck('name'));
            $courses_data = collect(collect($all_courses)->pluck('sum'));

            return view('lecturer',[
                'title' => $title,
                'all_courses' => $all_courses,
                'courses_label' => $courses_label,
                'courses_data' => $courses_data,
                'courses' => $courses,
                'total_students' => $total_students,
            ]);
        }

        if(auth()->user()->role == 'student'){
            $user_get_courses = UserCourse::where('user_id',auth()->user()->id)->get()->pluck('course_id');
            $user_courses = Course::whereIn('id', $user_get_courses)->get();

            $user_get_exams = UserExam::where('user_id', auth()->user()->id)->get();
            
            $courses = [];

            foreach ($user_get_exams as $key => $user_get_exam) {
                $exam = Exam::where('id', $user_get_exam['exam_id'])->first();
                $courses[$exam['course_id']] = Grade::where('user_exam_id', $user_get_exam['id'])->first()->pluck('score');
            }

            foreach ($courses as $course_id => $course_scores) {
                // echo $course_id;
                $sum = 0;
                foreach ($course_scores as $key => $score) {
                    $sum += $score;
                }
                $courses[$course_id]['average'] = $sum/count($course_scores);
            }

            foreach ($courses as $key => $value) {
                foreach ($user_courses as $user_course) {
                    if($key == $user_course['id']){
                        $courses[$key]['name'] = $user_course['name'];
                    }
                }
            }
            
            $courses_label = collect(collect($courses)->pluck('name'));
            $courses_data = collect(collect($courses)->pluck('average'));
            return view('home',[
                'title' => $title,
                'user_courses' => $user_courses,
                'courses_label' => $courses_label,
                'courses_data' => $courses_data,
            ]);
        }
    }
}
