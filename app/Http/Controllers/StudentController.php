<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::role('student')->latest()->paginate(20);
        return view('dashboard.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::pluck('id', 'name');
        $user = auth()->user();
        $user->canPerform('edit students');
        return view('dashboard.students.create', ['groups' => $groups, 'group_id' => request()->group_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $user->canPerform('edit students');
        $validated = $request->validate([
            'name' => 'required',
            'group_id' => 'required|integer'
        ]);
        

        $student = User::create([
            'name' => $request->name,
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        $group = Group::findOrFail($request->group_id);
        $group->students()->attach($student);
        $role = Role::whereName('student')->first();
        $student->assignRole($role);
        return back()->with('success', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::with('grades', 'grades.subject', 'grades.teacher')->find($id);
        return view('dashboard.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::find($id);
        return view('dashboard.students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $user = auth()->user();
        $user->canPerform('edit students');

        $student->update($request->only('name'));
        return back()->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $user = auth()->user();
        $user->canPerform('edit students');
        $student->delete();
        return back()->with('success', 'Successfully Deleted!');
    }
}
