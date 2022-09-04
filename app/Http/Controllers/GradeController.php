<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('subject', 'teacher', 'student', 'group')->latest()->paginate(20);
        return view('dashboard.grades.index', ['grades' => $grades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $user = auth()->user();
        $user->canPerform('edit grades');
        $teachers = User::role('teacher')->pluck('id', 'name');
        $students = User::role('student')->pluck('id', 'name');
        $subjects = Subject::pluck('id', 'name');
        return view('dashboard.grades.create', [
            'subjects' => $subjects,
            'teachers' => $teachers,
            'students' => $students,
            'subject_id' => $request->subject_id,
            'student_id' => $request->student_id,
        ]);
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
        $user->canPerform('edit grades');
        $validated = $request->validate([
            'mark' => 'required|integer',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
        ]);
        $student = User::findOrFail($request->student_id);
        Grade::create(array_merge(
            $request->only('mark', 'subject_id', 'teacher_id', 'student_id'),
            ['group_id' => $student->group->id]
        ));
        return back()->with('success', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('dashboard.grades.edit', ['grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $user = auth()->user();
        $user->canPerform('edit grades');
        $grade->update($request->only('mark'));
        return back()->with('success', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $user = auth()->user();

        if(!$user->hasPermissionTo('edit grades')) 
        {
            return back()->withErrors(['msg' => 'Permissions Denied']);
        }
        $grade->delete();
        return back()->with('success', 'Successfully Deleted!');
    }
}
