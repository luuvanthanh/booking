@include('layouts.css')
<div class="login">
  <div class="login-header">
    <h1>Login</h1>
    @if (session('error'))
        <span class="loi">{{ session('error') }}</span>
    @endif
    @if (session('success'))
    <span class="loi">{{ session('success') }}</span>
    @endif
    </div>
    <form action="{{ route('postLogin') }}" method="POST">
        @csrf
        <div class="login-form">
            <h3>Username:</h3>
            <input type="text" name="email" value="" placeholder="Username"/><br>
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
            <h3>Password:</h3>
            <input type="password" name="password" placeholder="Password"/>
            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
            <br>
            <button type="submit" class="login-button">Login</button>
            <br>
            <a href="{{ route('getRegister') }}" class="sign-up">Sign Up!</a>
            <br>
            <a href="{{ route('forget.password.get') }}" class="no-access">Forgot password</a>
        </div>
    </form>
</div>
{{-- @include('layouts.js') --}}