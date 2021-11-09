@extends('layouts.master')
@section('content')
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Password Confirmation</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Enter password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('phone'))
                        <div class="error">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>IsAdmin</label>
                    <input type="text" name="isAdmin" value="1" class="form-control" placeholder="Enter name" readonly>
                </div>
        
                <div class="form-group">
                    <label>Department</label>
                    <select class="form-control" name="department_id" value="{{ old('department_id') }}">
                        @foreach ($departments as $department)
                            <option name="department_id" value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('department_id'))
                        <div class="error">{{ $errors->first('department_id') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
@endsection