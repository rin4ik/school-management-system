@extends('layouts.auth')

@section('content')
<div class="container-fluid bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Subject</h1>
    </div>
    <div class="card-body">
        <form action="/dashboard/subjects" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" placeholder="Subject name" name="name" class="form-control" id="name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection