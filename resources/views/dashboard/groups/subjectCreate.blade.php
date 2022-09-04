@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Subject To Group</h1>
    </div>
    <div class="card-body">
        <form action="/dashboard/group-subjects" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select name="subject_id" id="subject" class="form-select">
                    <option>Select a subject</option>
                    @foreach($subjects as $value => $key)
                        <option {{$key === auth()->id() ? 'selected="selected"' : ''}} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="group" class="form-label">Group</label>
                <select class="form-select" name="group_id" id="group">
                    <option>Select a group</option>
                    @foreach($groups as $value => $key)
                        <option {{$key == $group_id ? 'selected="selected"' : ''}} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="mt-4 btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection