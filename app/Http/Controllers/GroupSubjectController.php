<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;

class GroupSubjectController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        $user->canPerform('edit subjects');
        return view('dashboard.groups.subjectCreate', [
            'subjects' => Subject::pluck('id', 'name'),
            'groups' => Group::pluck('id', 'name'),
            'group_id' => $request->group_id
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
        $user->canPerform('edit subjects');
        $request->validate([
            'group_id' => 'required',
            'subject_id' => 'required',
        ]);
        $group = Group::findOrFail($request->group_id);
        $subject = Subject::findOrFail($request->subject_id);

        $group->subjects()->attach($subject);

        return back()->with('success', 'Successfully Created!');
    }
}
