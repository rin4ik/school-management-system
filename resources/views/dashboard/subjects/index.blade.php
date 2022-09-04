@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Subjects</h1>
    </div>
    <div class="card-body">
        @can('edit subjects')
        <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
            <a href="/dashboard/subjects/create" class="btn btn-primary" type="button">Add Subject</a>
        </div>
        @endcan
        <div class="table-responsive">
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        @can('see stats')
                            <th>Average Grade</th>
                        @endcan
                        @can('edit subjects')
                            <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                    <tr>
                        <td>
                            <a href="/dashboard/subjects/{{$subject->id}}">{{$subject->name}}</a>
                        </td>
                        @can('see stats')
                            <td>{{number_format($subject->average, 2)}}</td>
                        @endcan
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
        </div>
    </div>

</div>
@endsection