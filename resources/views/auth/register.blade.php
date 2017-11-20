@extends('layouts.master')
@section('extra-css')
  <style>
     .input-label{
       padding-left: 10px;
     }
     .card-title{
       font-size:25px;
       font-weight: 700;
       padding: 0 12px 12px;
       font-style: normal;
     }
  </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
      <div class="col m8 offset-m2">
        <div class="card-panel">
            <div class="card-title">Create Account</div>
            <hr>
            <div class="card-content">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="input-field{{ $errors->has('firstName') ? ' has-error' : '' }}">
                          <input id="firstName" type="text" class="validate" name="firstName" value="{{ old('firstName') }}" required autofocus>
                          <label for="firstName" class="input-label">First Name</label>
                          @if ($errors->has('firstName'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('firstName') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="input-field{{ $errors->has('lastName') ? ' has-error' : '' }}">
                          <input id="lastName" type="text" class="validate" name="lastName" value="{{ old('lastName') }}" required autofocus>
                          <label for="lastName" class="input-label">Last Name</label>
                          @if ($errors->has('lastName'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('lastName') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                          <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                          <label for="email" class="input-label">E-Mail Address</label>
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                          <input id="password" type="password" class="validate" name="password" required>
                          <label for="password" class="input-label">Password</label>
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="input-field">
                          <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                          <label for="password-confirm" class="input-label">Confirm Password</label>
                        </div>
                        <div class="input-field">
                          <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
