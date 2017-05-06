<?php

namespace App\Http\Controllers\Admin;

use App\Facades\RedisService;
use App\Http\Controllers\Controller;
use App\Staff;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showListUserPage(){
        $users = User::get();
        return view('admin.list_user')->with("users", $users);
    }

    public function showListStaffPage(){
        $staffs = Staff::get();
        return view('admin.list_staff')->with("staffs", $staffs);
    }

    public function updateStatusUser($id){
        $user = User::findOrFail($id);
        $user->status =  $user->status == "active" ? "inactive" : "active";
        $user->save();
        RedisService::publishBlockAccountUser($user);
        return redirect()->back();
    }

    public function updateStatusStaff($id){
        $staff = Staff::findOrFail($id);
        $staff->status =  $staff->status == "active" ? "inactive" : "active";
        $staff->save();
        RedisService::publishBlockAccountStaff($staff);
        return redirect()->back();
    }
}
