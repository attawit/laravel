@extends('layout.main')

@section('content')
<form action="{{URL::route('account-change-password-post')}}" method="post" xmlns="http://www.w3.org/1999/html">
        <div class="input-group ">
           <span class="input-group-addon"><i class="fa fa-qq"></i> Старый пароль</span>
            <input class="form-control" type="password" name="old_password">
            <span class="input-group-addon">
                @if($errors->has('old_password'))
                    {{$errors->first('old_password')}}
                @endif
            </span>
        </div>
        <p></p>
        <div class="input-group ">
            <span class="input-group-addon"> <i class="fa fa-gears"></i> Новый пароль</span>
            <input class="form-control" type="password" name="password">
            <span class="input-group-addon">
                @if($errors->has('password'))
                    {{$errors->first('password')}}
                @endif
            </span>
        </div>
        <p></p>
        <div class="input-group ">
            <span class="input-group-addon"> <i class="fa fa-bookmark"></i> Новый пароль еще раз</span>
            <input class="form-control" type="password" name="password_again">
            <span class="input-group-addon">
                @if($errors->has('password_again'))
                    {{$errors->first('password_again')}}
                @endif
            </span>
        </div>
        <p></p>
        <input class="btn btn-primary" type="submit" value="Поменять пароль">
        {{Form::token()}}
    </form>
@stop