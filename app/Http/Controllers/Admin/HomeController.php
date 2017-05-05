<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 20:00
 */

namespace App\Http\Controllers\Admin;


class HomeController
{
    public function showHomePage(){
        return view('admin.update_info');
    }
}