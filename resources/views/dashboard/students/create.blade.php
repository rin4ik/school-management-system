@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Student</h1>
    </div>
    <div class="card-body">
        <form action="/dashboard/students" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" placeholder="Student name" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="group_id" class="form-label">Group</label>
                <select class="form-select" name="group_id" id="group_id">
                    <option>Select a group</option>
                    @foreach($groups as $value => $key)
                        <option {{$key == $group_id ? 'selected="selected"' : '' }} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection