@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Teachers</h1>
    </div>
    <div class="card-body">
        @can('edit teachers')
        <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
            <a href="/dashboard/teachers/create" class="btn btn-primary" type="button">Add Teacher</a>
        </div>
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        @can('edit teachers')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>
                            <a href="/dashboard/teachers/{{$teacher->id}}">{{$teacher->name}}</a>
                        </td>
                        @can('edit teachers')
                        <td>
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="mr-3" href="/dashboard/teachers/{{$teacher->id}}/edit">
                                    <i type="submit" class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
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
            {{ $teachers->links() }}
        </div>
    </div>

</div>
@endsection