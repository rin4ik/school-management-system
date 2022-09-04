@extends('layouts.auth')

@section('content')
<div class="container-fluid vh-100 bg-white px-4 py-5 rounded-lg shadow-lg">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="ml-4 h3 mb-0 text-gray-800">School Dashboard</h1>
    </div>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{$errors->first()}}
        </div>
    @endif
    <h5 class="text-center w-100 text-gray-800 ml-1">
        {{$msg}}
    </h5>

</div>
@endsection