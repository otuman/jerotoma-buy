@extends('layouts.master')
@section('extra-css')
  <style>
     .input-label{
       padding-left: 10px;
     }
     .card-title{
       font-size:25px;
       font-weight: 700;
       padding: 12px;
       font-style: normal;
     }
  </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
          <div class="card-panel">
            <div class="card-title">Login</div>
            <hr>
            <div class="card-content">
                    <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                          <label class="input-label" for="email">E-Mail Address</label>
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="input-field {{ $errors->has('password') ? ' has-error' : '' }}">
                          <input id="password" type="password" class="form-control" name="password" required>
                          <label class="input-label"  for="password" >Password</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="checkbox">
                             <input id="remember_me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                             <label for="remember_me">Remember Me</label>
                        </div>
                        <div class="input-field">
                          <button type="submit" class="btn btn-primary">
                              Login
                          </button>
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              Forgot Your Password?
                          </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
