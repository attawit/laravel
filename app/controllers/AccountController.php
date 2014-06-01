<?php
/**
 * Created by PhpStorm.
 * User: Алекс
 * Date: 03.05.14
 * Time: 17:55
 */

class AccountController extends BaseController {
    
    public function getSignIn(){
        return View::make('account.signIn');
    }

    public function postSignIn(){   //Проверяем корректность ФОРМАТА введенных данных
        $validator = Validator::make(Input::all(), array(
            'email'     => 'required|email',
            'password'  =>'required'
        ));

        if($validator->fails()){    //В случее ошибки в формате, возвращам объект ошибки роутеру на туже стр.
            return Redirect::route('account-sign-in')->withErrors($validator)->withInput();
        }
            else{    
                    $remember = ( Input::has('remember') ) ? true : false; //Проверяем передается ли значение чекбокса
                               //Правильные данные передаем в обект скласса Auth
                    $auth = Auth::attempt(array(
                        'email'     => Input::get('email'),
                        'password'  => Input::get('password'),
                        'active'    => 1
                    ),$remember);

                    if($auth){
                        //Redirect to the intended page
                        return Redirect::intended('/');
                    }
                        else{
                            return Redirect::route('account-sign-in')->with('global', 'Мэил или пароль не верны. Попробуйте еще раз ')->with('class','label label-warning');
                        }
            }
        return Redirect::route('account-sign-in')->with('global', 'Произошла проблема со входом на сайт. Попробуйте позже ')->with('class','label label-danger');

    }

    public function getChangePassword(){
        return View::make('account.password');
    }

    public function postChangePassword(){
        $validator = Validator::make(Input::all(), array(
            'old_password'      =>'required',
            'password'          =>'required|min:6',
            'password_again'    =>'required|same:password'
        ));
        if($validator->fails()){
            return Redirect::route('account-change-password')->withErrors($validator);
        }
        else{
            $user           = User::find(Auth::user()->id);

            $old_password   = Input::get('old_password');
            $password       = Input::get('password');

            //Проверяем совпадают ли MD5 хеши строго пароля и пороля хрпнящегося в Бд Юзера
            if(Hash::check($old_password, $user->getAuthPassword() )){
                $user->password = Hash::make($password);
                if( $user->save() ){
                    return Redirect::route('home')->with('global','Ваш пароль был успешно изменен ');
                }
            }
            else{
                return Redirect::route('home')->with('global','Ваш старый пароль не совпадает с текущим ');
            }

        }
        return Redirect::route('account-change-password-post')->with('global', 'Не могу сменить пароль ');
    }

    public function getSignOut(){
        Auth::logout();
        return Redirect::route('home');
    }

    public function getCreate(){
        return View::make('account.create');
    }

    public function postCreate(){
        $validator = Validator::make(Input::all(), array(
            'email'             =>'required|max:50|email|unique:users',
            'username'          =>'required|max:20|min:3|unique:users',
            'password'          =>'required|min:6',
            'password_again'    =>'required|same:password',
            )
        );
        if( $validator->fails() ){
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput()
                ->with('varning','form-group has-error');
        }
            else{
                $email      = Input::get('email');
                $username   = Input::get('username');
                $password   = Input::get('password');

        //Activation code
            $code = str_random(60);

            $user= User::create(array(
                'email'     => $email,
                'username'  => $username,
                'password'  => Hash::make($password),
                'code'      => $code,
                'active'    => 0

            ));

            if($user){

                Mail::send('emails.auth.activate',
                            array('link'=>URL::route('account-activate', $code),'username'=>$username),
                            function($message) use ($user){
                                $message->to($user->email, $user->username)->subject('Активация аккаунта');
                            }
                );

                return Redirect::route('home')
                    ->with('global', "Вы зарегистрированны!На вашу почту было отправлено сообщение с кодом! ");
            }
        }
    }

    public function getActivate($code){
        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if($user->count()){
            $user= $user->first();

            //Update user to active state
            $user -> active = 1;
            $user -> code   = '';

            if($user->save()){
                return Redirect::route('home')
                    ->with('global', "Поздравляю {$user->username} , активация прошла успешно !!!!!!")->with('class','bg-primary');
            }
        }
        return Redirect::route('home')
            ->with('global', 'Простите, но активировать аккаунт не удалось, поробуйте позже :(' )->with('class','bg-danger');
    }
    
    public function getForgotPassword(){
        return View::make('account.forgot');
    }
    
    public function postForgotPassword(){
        $validator = Validator::make(Input::all(),array(
            'email' => 'required|email'
        ));
        if($validator->fails()){
            return Redirect::route('account-forgot-password')->withErrors($validator)->withInput();
        }
        else{
           $user = User::where('email', '=', Input::get('email'));
           if($user->count()){
               $user = $user -> first();
               //Code generation
               $code        = str_random(60);
               $password    = str_random(10);
               
               $user->code           = $code;
               $user->password_temp  = Hash::make($password);
               
               if($user->save()){
                   Mail::send('emails.auth.forgot', array('link'=>URL::route('account-recover',$code), 'username'=>$user->username, 'password'=>$password), function ($message)use ($user){
                       $message->to($user->email, $user->username)->subject('Your new password');
                   });
                   return Redirect::route('home')
                           ->with('global','Мы выслали вам новый пароль на почу')->with('class','label label-primary');
               }
           }
        }
        return Redirect::route('account-forgot-password')->with('global', 'Не удалось получить новый пароль! ')->with('class','label label-warning');
    }
    
    public function getRecover($code){
        $user=User::where('code', '=', $code)
                ->where('password_temp', '!=' ,'');
        if($user->count()){
            $user =  $user->first();
            $user -> password       = $user->password_temp;
            $user -> code           = "";
            $user -> password_temp  = "";
            
            if($user->save()){
                return Redirect::route('home')->with('global',' Пароль успешно изменен, вы можете войти используя новый пароль')->with('class','label label-primary');
            }
        }
        return Redirect::route('home')->with('global','Не удалось изменить пароль, попробуйте еще раз')->with('class','label label-warning');
    }
} 