<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\User;
use App\Http\Requests\LecturerStoreRequest;
use App\Http\Requests\LecturerUpdateRequest;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Lecturers';
        $lecturers = User::where('role','lecturer')->get();

        return view('lecturers.index',[
            'title' => $title,
            'lecturers' => $lecturers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Lecturer';
        $majors = Major::all();

        return view('lecturers.create',[
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
    public function store(LecturerStoreRequest $request)
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
                'role' => 'lecturer'
            ]);
    
            return redirect()->route('lecturer.index')->with('success', 'Lecturer successfully added.');
        }catch(\Throwable $th){
            return redirect()->route('lecturer.create')->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
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
    public function edit(User $lecturer)
    {
        $title = 'Edit Lecturer';
        $majors = Major::all();

        return view('lecturers.edit',[
            'title' => $title,
            'majors' => $majors,
            'lecturer' => $lecturer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LecturerUpdateRequest $request, User $lecturer)
    {
        try {
            $lecturer->id_number = $request->id_number;
            $lecturer->name = $request->name;
            $lecturer->email = $request->email;
            $lecturer->gender = $request->gender;
            $lecturer->birthplace = $request->birthplace;
            $lecturer->date_of_birth = $request->date_of_birth;
            $lecturer->address = $request->address;
            $lecturer->religion = $request->religion;
            $lecturer->major_id = $request->major;
            $lecturer->role = 'lecturer';
            $lecturer->update();
    
            return redirect()->route('lecturer.index')->with('success', 'Lecturer successfully updated.');
        }catch(\Throwable $th){
            return redirect()->route('lecturer.edit', $lecturer->id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturer.index')->with('success', 'Lecturer successfully deleted.');
    }

}
