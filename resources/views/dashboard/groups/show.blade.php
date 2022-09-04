@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Group {{$group->name}}</h1>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
            @can('edit students')
            <a href="/dashboard/students/create?group_id={{$group->id}}" class="btn btn-primary" type="button">Add Student</a>
            @endcan
            @can('edit subjects')
            <a href="/dashboard/group-subjects/create?group_id={{$group->id}}" class="btn ml-2 btn-primary" type="button">Add Subject</a>
            @endcan
        </div>
        <h2 class="h3 mb-0 text-gray-800 mb-2">Students</h2>
        <div class="table-responsive">
            @if(count($group->students))
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            @can('edit students')
                            <th>Actions</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group->students as $student)
                        <tr>
                            <td>
                                <a href="/dashboard/students/{{$student->id}}">{{$student->name}}</a>
                            </td>
                            @can('edit students')
                            <td>
                                <div class="d-flex align-items-center justify-content-end">
                                    <a class="mr-3" href="/dashboard/students/{{$student->id}}/edit">
                                        <i type="submit" class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </form>   
                                </div>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="h6 text-gray-800 text-center">No Students</div>
            @endif
        </div>
    </div>
    <div class="card-body">
        <h2 class="h3 mb-0 text-gray-800 mb-2">Subjects</h2>
        <div class="table-responsive">
            @if(count($group->subjects))
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        @can('edit subjects')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group->subjects as $subject)
                    <tr>
                        <td>
                            <a href="/dashboard/subjects/{{$subject->id}}">{{$subject->name}}</a>
                        </td>
                        @can('edit subjects')
                        <td>
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="mr-3" href="/dashboard/subjects/{{$subject->id}}/edit">
                                    <i type="submit" class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </form>   
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="h6 text-gray-800 text-center">No Students</div>
            @endif
        </div>
    </div>
</div>
@endsection