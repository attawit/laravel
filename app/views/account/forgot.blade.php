@extends('layout.main')

@section('content')
<form method="post" action="{{URL::route('account-forgot-password')}}">
    <div class="input-group">
        <span class="input-group-addon">Email</span>
        <input type="text" name="email" class="form-control" {{ (Input::old('email') ) ? 'value="' . e(Input::old('email')). '"' : '' }} >
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Восстановить</button>
        </span>
        {{Form::token()}}
    </div>
        @if( $errors->has('email') )
        <span class="label label-warning">{{ $errors->first('email') }}</span>
        @endif
</form>
@stop