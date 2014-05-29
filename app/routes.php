<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home',
));

Route::get('/user/{username}', array(
    'as'=>'profile-user',
    'uses'=>'ProfileController@user'
));

/*
* Authenticated group
*/
Route::group(array('before' => 'auth'), function(){

    /*
     * CSRF protection
     */

    Route::group(array('before'=>'csrf'), function(){

        /*
        * Change password POSt
        */

        Route::post('/account/change-password', array(
            'as'=>'account-change-password-post',
            'uses'=>'AccountController@postChangePassword'
        ));

    });
    /*
     * Change password GET
     */

    Route::get('/account/change-password', array(
        'as'=>'account-change-password',
        'uses'=>'AccountController@getChangePassword'
    ));

    /*
    * Sign out (GET)
    */

    Route::get('/account/sign-out', array(
        'as'=>'account-sign-out',
        'uses'=>'AccountController@getSignOut'
        ));

});

/*
* Unauthenticated group
*/
Route::group(array('before'=>'guest'), function(){

    /*
     * CSRF protection
     */
    Route::group(array('before'=>'csrf'),function(){

        /*
         * Create account POST
         */

        Route::post('/account/create',array(
            'as'=>'account-create-post',
            'uses'=>'AccountController@postCreate'
        ));

        /*
         * Sign IN POST
         */

        Route::post('/account/sign-in',array(
            'as'    =>'account-sign-in',
            'uses'  =>'AccountController@postSignIn'
        ));

         /*
         * Forgot Password (POST)
         */
        Route::post('/account/forgot-password', array(
            'as'    =>'account-forgot-password',
            'uses'  =>'AccountController@postForgotPassword'
        ));

    });

    /*
    * Create account GET
    */
    Route::get('/account/create', array(
        'as'    =>'account-create',
        'uses'  =>'AccountController@getCreate'
    ));

    /*
    * Sign In GET
    */
    Route::get('/account/sign-in', array(
        'as'    =>'account-sign-in',
        'uses'  =>'AccountController@getSignIn'
    ));

    /*
    * Activate account (GET)
    */
    Route::get('/account/activate/{code}', array(
        'as'    =>'account-activate',
        'uses'  =>'AccountController@getActivate'
    ));
    
    /*
     * Forgot Password (GET)
     */
    Route::get('/account/forgot-password', array(
        'as'    =>'account-forgot-password',
        'uses'  =>'AccountController@getForgotPassword'
    ));
    
    Route::get('/account/recover/{code}',array(
        'as'    =>'account-recover',
        'uses'  =>'AccountController@getRecover'
    ));
    
});

/*
 * My Test Page
 */
    Route::get('/test/', array(
        'as'=>'test-page',
        'uses'=>'TestController@getTest'
    ));
    