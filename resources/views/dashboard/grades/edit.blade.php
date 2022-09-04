@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Grade</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('grades.update', $grade->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="mark" class="form-label">Mark</label>
                <input id="mark" name="mark" value="{{$grade->mark}}" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection