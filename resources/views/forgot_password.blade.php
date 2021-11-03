@include('layouts.css')
<div class="login">
  <div class="login-header">
    <h1>Forgot password</h1>
    </div>
    <form action="" method="POST">
        @csrf
        <div class="login-form">
            <h3>Username:</h3>
            <input type="text" name="email" placeholder="Enter email"/><br>
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
            <button type="submit" class="login-button">Send mail</button>
        </div>
    </form>
</div>
{{-- @include('layouts.js') --}}