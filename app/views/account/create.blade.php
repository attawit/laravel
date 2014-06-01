@extends('layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">

            <form action="{{URL::route('account-create-post')}}" method="post">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-cloud"></i></span>
                    <input placeholder="Email:" type="text" name="email"{{ Input::old('email') ? ' value="'.e(Input::old('email')). '"' : ''}} class="form-control">
                </div>
                    @if( $errors->has('email') )
                        <span class="label label-warning">
                            {{ $errors->first('email') }}
                        </span>
                    @endif

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pied-piper-alt"></i></span>
                    <input placeholder="Name:" type="text" name="username" {{ Input::old('username') ? ' value="'.e(Input::old('username')). '"' : ''}}class="form-control" >
                </div>
                    @if( $errors->has('username') )
                        <span class="label label-warning">
                        {{ $errors->first('username') }}
                        </span>
                    @endif

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-compass "></i></span>
                    <input placeholder="Password:" type="password" name="password" class="form-control" >
                </div>
                    @if( $errors->has('password') )
                        <span class="label label-warning">
                        {{ $errors->first('password') }}
                        </span>
                    @endif

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <input placeholder="Password again:" type="password" name="password_again" class="form-control" >      
                </div>
                    @if( $errors->has('password_again') )
                        <span class="label label-warning">
                        {{ $errors->first('password_again') }}
                        </span><br>
                    @endif
                 <p></p>
                <input type="submit" value="Create account" class="btn btn-primary">
                {{Form::token()}}
            </form>
        </div>
    </div>
</div>
@stop