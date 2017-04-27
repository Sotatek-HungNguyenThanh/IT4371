<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 23:34
 */

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function showHomePage(){
        return view('staff.home');
    }
}