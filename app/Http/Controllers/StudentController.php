<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\User;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Students';
        $students = User::where('role','student')->get();

        return view('students.index',[
            'title' => $title,
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Student';
        $majors = Major::all();

        return view('students.create',[
            'title' => $title,
            'majors' => $majors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        try{
            $user = User::create([
                'id_number' => $request->id_number,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('password'),
                'gender' => $request->gender,
                'birthplace' => $request->birthplace,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'religion' => $request->religion,
                'major_id' => $request->major,
                'role' => 'student'
            ]);
    
            return redirect()->route('student.index')->with('success', 'Student successfully added.');
        }catch(\Throwable $th){
            return redirect()->route('student.create')->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
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
    public function edit(User $student)
    {
        $title = 'Edit Student';
        $majors = Major::all();

        return view('students.edit',[
            'title' => $title,
            'majors' => $majors,
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, User $student)
    {
        try {
            $student->id_number = $request->id_number;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->gender = $request->gender;
            $student->birthplace = $request->birthplace;
            $student->date_of_birth = $request->date_of_birth;
            $student->address = $request->address;
            $student->religion = $request->religion;
            $student->major_id = $request->major;
            $student->role = 'student';
            $student->update();
    
            return redirect()->route('student.index')->with('success', 'Student successfully updated.');
        }catch(\Throwable $th){
            return redirect()->route('student.edit', $student->id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student successfully deleted.');
    }
}
