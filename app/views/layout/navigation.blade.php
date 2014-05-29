

    <ul class="nav nav-tabs">
        <li><a href="{{URL::route('home')}}">Домой</a></li>
        @if(Auth::check())
            <li><a href="{{URL::route('account-sign-out')}}">Выйти </a></li>
            <li><a href="{{URL::route('account-change-password')}}">Сменить пароль </a></li>
            <li><a href="{{URL::route('profile-user',Auth::user()->username)}}"><i class="fa fa-paw"></i> Узнать свой email</a></li>
        @else
            <li><a href="{{URL::route('account-sign-in')}}">Залогиница</a></li>
            <li><a href="{{URL::route('account-create')}}">Сделать аккаунт</a></li>
            <li><a href="{{URL::route('account-forgot-password')}}">Забыл пароль</a></li>
        @endif
        <li><a href="{{URL::route('test-page')}}">Моя страничка</a></li>
    </ul>
