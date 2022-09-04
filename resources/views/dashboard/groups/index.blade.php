@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Groups</h1>
    </div>
    <div class="card-body">
        @can('edit groups')
        <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
            <a href="/dashboard/groups/create" class="btn btn-primary" type="button">Add Group</a>
        </div>
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        @can('edit groups')
                        <th>Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td>
                            <a href="/dashboard/groups/{{$group->id}}">{{$group->name}}</a>
                        </td>
                        @can('edit groups')
                        <td>
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="mr-3" href="/dashboard/groups/{{$group->id}}/edit">
                                    <i type="submit" class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
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