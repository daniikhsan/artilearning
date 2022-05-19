<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorStoreRequest;
use App\Http\Requests\MajorUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Department;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Majors';
        $majors = Major::all();

        return view('majors.index',[
            'title' => $title,
            'majors' => $majors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add Major';
        $departments = Department::all();

        return view('majors.create',[
            'title' => $title,
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajorStoreRequest $request)
    {
        try {
            Major::create([
                'name' => $request->name,
                'department_id' => $request->department_id,
            ]);

            return redirect()->route('major.index')->with('success', 'Major successfully added.');
        }catch(\Throwable $th){
            return redirect()->route('major.create')->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
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
    public function edit(Major $major)
    {
        $title = 'Edit Major';
        $departments = Department::all();

        return view('majors.edit',[
            'title' => $title,
            'major' => $major,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajorUpdateRequest $request, Major $major)
    {
        try {
            $major->name = $request->name;
            $major->department_id = $request->department_id;
            $major->update();
    
            return redirect()->route('major.index')->with('success', 'Major successfully updated.');
        }catch(\Throwable $th){
            return redirect()->route('major.edit', $major->id)->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('major.index')->with('success', 'Major successfully deleted.');
    }
}
