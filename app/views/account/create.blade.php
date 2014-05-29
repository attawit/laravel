@extends('layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">

            <form action="{{URL::route('account-create-post')}}" method="post">

                <div class="input-group">
                    <span class="input-group-addon">Email:</span>
                    <input type="text" name="email"{{ Input::old('email') ? ' value="'.e(Input::old('email')). '"' : ''}} class="form-control">
                    <span class="input-group-addon">
                        @if( $errors->has('email') )
                            {{ $errors->first('email') }}
                        @endif
                    </span>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">Name:</span>
                    <input type="text" name="username" {{ Input::old('username') ? ' value="'.e(Input::old('username')). '"' : ''}}class="form-control" >
                    <span class="input-group-addon">
                        @if( $errors->has('username') )
                            {{ $errors->first('username') }}
                        @endif
                     </span>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">Password:</span>
                    <input type="password" name="password" class="form-control" >
                    <span class="input-group-addon">
                        @if( $errors->has('password') )
                            {{ $errors->first('password') }}
                        @endif
                     </span>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">Password again:</span>
                    <input type="password" name="password_again" class="form-control" >
                    <span class="input-group-addon">
                        @if( $errors->has('password_again') )
                            {{ $errors->first('password_again') }}
                        @endif
                    </span>
                </div>

                <input type="submit" value="Create account" class="btn btn-primary">
                {{Form::token()}}
            </form>
        </div>
    </div>
</div>
@stop