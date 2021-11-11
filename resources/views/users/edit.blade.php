@extends('layouts.master')
@section('content')
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="{{ $user->password }}" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{ $user->address }}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="Enter name">
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
                    <select class="form-control" name="department_id">
                        @if(!empty($departments))
                            @foreach ($departments as $departmentName)
                                <option name="department_id" value="{{ $departmentName->id }}" {{  $user->department_id == $departmentName->id ? 'selected' : '' }}>{{ $departmentName->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('department_id'))
                        <div class="error">{{ $errors->first('department_id') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection