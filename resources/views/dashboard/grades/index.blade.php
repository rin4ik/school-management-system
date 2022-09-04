@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Grades</h1>
    </div>
    
    <div class="card-body">
        @can('edit grades')
        <div class="d-grid mb-4 gap-2 d-md-flex justify-content-md-end">
            <a href="/dashboard/grades/create" class="btn btn-primary" type="button">Add Grade</a>
        </div>
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mark</th>
                        <th>Teacher</th>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Group</th>
                        @can('edit grades')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                    <tr>
                        <td>{{$grade->mark}}</td>
                        @can('see teachers')
                            <td><a href="/dashboard/teachers/{{$grade->teacher?->id}}">{{$grade->teacher?->name}}</a></td>
                        @else
                            <td>{{$grade->teacher?->name}}</td>
                        @endcan
                        @can('see students')
                            <td><a href="/dashboard/students/{{$grade->student?->id}}">{{$grade->student?->name}}</a></td>
                        @else
                            <td>{{$grade->student?->name}}</td>
                        @endcan
                        @can('see subjects')
                            <td><a href="/dashboard/subjects/{{$grade->subject?->id}}">{{$grade->subject?->name}}</a></td>
                        @else
                            <td>{{$grade->subject?->name}}</td>
                        @endcan
                        @can('see groups')
                            <td><a href="/dashboard/groups/{{$grade->group?->id}}">{{$grade->group?->name}}</a></td>
                        @else
                            <td>{{$grade->group?->name}}</td>
                        @endcan
                        @can('edit grades')
                        <td>
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="mr-3" href="/dashboard/grades/{{$grade->id}}/edit">
                                    <i type="submit" class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
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
            {{ $grades->links() }}
        </div>
    </div>

</div>
@endsection