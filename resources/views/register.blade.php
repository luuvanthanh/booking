@include('layouts.css')
<div class="container">
    <div class="login-header">
        <h1>Register</h1>
    </div>
    @if (session('error'))
        <span class="loi">{{ session('error') }}</span>
    @endif
    <form action="{{ route('postRegister') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter name">
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>
          
                <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter email">
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
        
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" placeholder="Enter password">
                    @if ($errors->has('password_confirmation'))
                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
        
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter address">
                    @if ($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter phone">
                    @if ($errors->has('phone'))
                        <div class="error">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label for="exampleInputPassword1">isAdmin</label>
                    <input type="text" name="isAdmin" value="1" class="form-control" readonly>
                    @if ($errors->has('isAdmin'))
                        <div class="error">{{ $errors->first('isAdmin') }}</div>
                    @endif
                </div>
        
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Department</label>
                    <select class="form-control" name="department_id" value="{{old('department_id')}}">
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
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
{{-- @include('layouts.js') --}}