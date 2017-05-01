<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Staff\AccountController as StaffAccountController;
use Illuminate\Support\Facades\Auth;

class AccountController extends StaffAccountController
{
    protected function guard(){
        return Auth::guard("admin");
    }

    protected function model(){
        return app(Admin::class);
    }

    public function getManagePasswordPage(){
        return view('admin.manage_password');
    }

    public function getUpdateInfoPage(){
        return view('admin.update_info');
    }


}