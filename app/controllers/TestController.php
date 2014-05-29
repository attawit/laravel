<?php
/**
 * Created by PhpStorm.
 * User: Алекс
 * Date: 04.05.14
 * Time: 23:14
 */

class TestController extends BaseController  {
    public function getTest(){
       return View::make('test.test');
    }
} 