<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Users';
        $users = User::all();

        return view('users.index',[
            'title' => $title,
            'users' => $users,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add User';
        $majors = Major::all();

        return view('users.create',[
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
    public function store(UserStoreRequest $request)
    {
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
            'role' => $request->role
        ]);

        return redirect()->route('user.index')->with('success', 'User successfully added.');
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
    public function edit(User $user)
    {
        $title = 'Edit User';
        $majors = Major::all();

        return view('users.edit',[
            'title' => $title,
            'majors' => $majors,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->id_number = $request->id_number;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->birthplace = $request->birthplace;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->major_id = $request->major;
        $user->role = $request->role;
        $user->update();

        return redirect()->route('user.index')->with('success', 'User successfully updated.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User successfully deleted.');
    }

    public function import(Request $request)
    {
        try {
            $this->validate($request,[
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);
    
            Excel::import(new UsersImport, $request->file('file')->store('files'));
            return redirect()->route('user.index')->with('success', 'User successfully imported.');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('error', 'Something went wrong. Make sure the data you have entered is correct and there is no duplication.');
        }
    }
}
