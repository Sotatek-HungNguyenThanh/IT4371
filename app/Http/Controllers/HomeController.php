<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 23:35
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function showHomePage(){
        return view('user.home');
    }
}