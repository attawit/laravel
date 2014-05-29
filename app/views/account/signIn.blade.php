@extends('layout.main')

@section('content')
<div class="col-lg-8">
    <div class="panel-primary">
        <div class="panel panel-body">
            <form method="post" action="{{URL::route('account-sign-in')}}">
                <div class="input-group">
                    <span class="input-group-addon">Email <i class="fa fa-envelope "></i></span>
                    <input class="form-control" type="email" name="email" {{ Input::old('username') ? ' value="'.e(Input::old('username')). '"' : ''}}class="form-control" >
                    <span class="input-group-addon">
                        @if($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </span>
                </div>
                <p></p>
                <div class="input-group">
                    <span class="input-group-addon">Password <i class="fa fa-gear"></i></span>
                        <input class="form-control" type="password" name="password"/>
                    <span class="input-group-addon">
                        @if($errors->has('password'))
                            {{$errors->first('password')}}
                        @endif
                    </span>
                </div>
                <div class="field">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember"> Запомнить меня</label>
                </div>
                <p></p>
                <input class="btn btn-primary" type="submit" value="Войти">
                {{ Form::token() }}
            </form>
        </div>
    </div>
</div>
@stop