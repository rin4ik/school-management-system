@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Students</h1>
    </div>
    <div class="card-body">
        @can('edit teachers')
        <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
            <a href="/dashboard/students/create" class="btn btn-primary" type="button">Add Student</a>
        </div>
        @endcan
        <div class="table-responsive">
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
                    @foreach ($students as $student)
                    <tr>
                        @can('see students')
                            <td><a href="/dashboard/students/{{$student->id}}">{{$student->name}}</a></td>
                        @else
                            <td>{{$student->name}}</td>
                        @endcan
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
            {{ $students->links() }}
        </div>
    </div>

</div>
@endsection