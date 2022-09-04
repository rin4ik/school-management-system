@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$teacher->name}}</h1>
    </div>
    <div class="card-body">
        <h2 class="h3 mb-0 text-gray-800 mb-2">Grades</h2>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success" role="alert">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mark</th>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Group</th>
                        @can('edit grades')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teacher->marks as $grade)
                    <tr>
                        <td>
                            {{$grade->mark}}
                        </td>
                        <td><a href="/dashboard/students/{{$grade->student?->id}}">{{$grade->student?->name}}</a></td>
                        <td><a href="/dashboard/subjects/{{$grade->subject?->id}}">{{$grade->subject?->name}}</a></td>
                        <td>
                            <a href="/dashboard/groups/{{$grade->group?->id}}">{{$grade->group?->name}}</a>
                        </td>
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
                    @empty
                        <p>No Grades</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection