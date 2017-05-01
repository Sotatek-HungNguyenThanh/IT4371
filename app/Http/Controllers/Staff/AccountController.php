<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\AccountController as UserAccountController;
use App\Staff;
use Illuminate\Support\Facades\Auth;

class AccountController extends UserAccountController
{
    protected function guard(){
        return Auth::guard("staff");
    }

    protected function model(){
        return app(Staff::class);
    }

    public function getManagePasswordPage(){
        return view('staff.manage_password');
    }

    public function getUpdateInfoPage(){
        return view('staff.update_info');
    }
}