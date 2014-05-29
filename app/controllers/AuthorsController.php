<?php
/**
 * Created by PhpStorm.
 * User: Алекс
 * Date: 02.05.14
 * Time: 15:45
 */

class AuthorsController extends BaseController {

    public  $restful = true;

    public function get_index(){
        return View::make('authors.index');
    }

} 