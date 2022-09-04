@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$student->name}}</h1>
        @can('see stats')
            <h5 class="text-gray-900">Average Grade: {{number_format($student->average, 2)}}</h5>
        @endcan
    </div>
    
    <div class="card-body">
        @can('edit grades')
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/dashboard/grades/create?student_id={{$student->id}}" class="btn btn-primary" type="button">Add Grade</a>
            </div>
        @endcan
        <h2 class="h3 mb-0 text-gray-800 mb-2">Grades</h2>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mark</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        @can('edit grades')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->grades as $grade)
                    <tr>
                        <td>
                            {{$grade->mark}}
                        </td>
                        @can('see teachers')
                            <td><a href="/dashboard/teachers/{{$grade->teacher?->id}}">{{$grade->teacher?->name}}</a></td>
                        @else
                            <td>{{$grade->teacher?->name}}</td>
                        @endcan
                        @can('see subjects')
                            <td><a href="/dashboard/subjects/{{$grade->subject?->id}}">{{$grade->subject?->name}}</a></td>
                        @else
                            <td>{{$grade->subject?->name}}</td>
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
        </div>
    </div>

</div>
@endsection