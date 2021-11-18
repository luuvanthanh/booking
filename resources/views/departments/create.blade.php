@extends('layouts.master')
@section('content')
    <form action="{{  route('department.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name Department</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Room number">
            @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Add department</button>
    </form>
@endsection