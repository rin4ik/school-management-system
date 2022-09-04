@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Grade</h1>
    </div>
    <div class="card-body">
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
        <form action="/dashboard/grades" method="POST">
            @csrf
            <div class="mb-3">
                <label for="mark" class="form-label">Mark</label>
                <input type="number" placeholder="Place your mark" name="mark" class="form-control" id="mark">
            </div>
            <div class="mb-3">
                <label for="teacher" class="form-label">Teacher</label>
                <select name="teacher_id" id="teacher" class="form-select">
                    <option>Select a teacher</option>
                    @foreach($teachers as $value => $key)
                        <option {{$key === auth()->id() ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" name="subject_id" id="subject">
                    <option>Select a subject</option>
                    @foreach($subjects as $value => $key)
                        <option {{$key == $subject_id ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="student" class="form-label">Student</label>
                <select class="form-select" name="student_id" id="student">
                    <option>Select a student</option>
                    @foreach($students as $value => $key)
                        <option {{$key == $student_id ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection