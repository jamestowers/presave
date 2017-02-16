@extends('app')

@section('title', 'Login')

@section('content')
    <div class="container narrow">
        
        <h1 class="page-title">@yield('title')</h1>
        
        {!! Form::open() !!}
        
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'Email Address') !!}
                {!! Form::text('email') !!}
                @if ($errors->has('email'))
                    <ul class="parsley-errors-list filled">
                        <li>{{ $errors->first('email') }}</li>
                    </ul>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password') !!}
                @if ($errors->has('password'))
                    <ul class="parsley-errors-list filled">
                        <li>{{ $errors->first('password') }}</li>
                    </ul>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember"> 
                    <div class="switch"></div>
                    <label for="remember">Remember Me</label>
                    
                </div>
                {!! link_to(url('/password/reset'), 'Forgot password?', ['class' => 'small']) !!}
                {!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
