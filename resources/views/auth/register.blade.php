@extends('app')

@section('title', 'Register')

@section('content')
        
    <div class="container pad">
        <div class="col4">
            <h1 class="page-title text-light">@yield('title')</h1>
        </div>

        <div class="col8 last">
            {!! Form::open() !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name') !!}
                    {!! Form::text('name') !!}
                    @if ($errors->has('name'))
                        <ul class="parsley-errors-list filled">
                            <li>{{ $errors->first('name') }}</li>
                        </ul>
                    @endif
                </div>
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
                    {!! Form::label('password') !!}
                    {!! Form::password('password') !!}
                    @if ($errors->has('password'))
                        <ul class="parsley-errors-list filled">
                            <li>{{ $errors->first('password') }}</li>
                        </ul>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!! Form::label('password_confirmation') !!}
                    {!! Form::password('password_confirmation') !!}
                    @if ($errors->has('password'))
                        <ul class="parsley-errors-list filled">
                            <li>{{ $errors->first('password') }}</li>
                        </ul>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::submit('register', ['role' => 'button', 'class' => 'btn-secondary btn-lg']) !!}
                </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection
