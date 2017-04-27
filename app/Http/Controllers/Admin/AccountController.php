<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Staff\AccountController as StaffAccountController;
use Illuminate\Support\Facades\Auth;

class AccountController extends StaffAccountController
{
    protected function guard(){
        return Auth::guard("admin");
    }
}