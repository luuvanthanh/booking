@extends('layouts.master')
@section('content')
    <form action="{{ route('department.update', $department->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Name Department</label>
            <input type="text" class="form-control" value="{{ $department->name }}" name="name" placeholder="Enter Room number">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection