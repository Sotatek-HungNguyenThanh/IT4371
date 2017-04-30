<?php

namespace App\Http\Controllers;
use LRedis;

class HomeController extends Controller
{
    public function showHomePage(){
        return view('user.home');
    }

    public function test(){
        $redis = LRedis::connection();
        $redis->publish('deposit', "Hello socket");
        return "success";
    }
}