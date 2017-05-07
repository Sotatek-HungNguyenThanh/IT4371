<?php

namespace App\Http\Controllers\Admin;

use App\Database;
use App\Facades\RedisService;
use App\Facades\StaffService;
use App\Http\Controllers\Controller;
use App\Staff;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function updateStatusUser($id, Request $request){
        $user = User::findOrFail($id);
        $user->status =  $user->status == "active" ? "inactive" : "active";
        $user->save();
        RedisService::publishBlockAccountUser($user);
        $request->session()->flash('alert-success', 'Restore success!');
        return redirect()->back();
    }

    public function updateStatusStaff($id, Request $request){
        $staff = Staff::findOrFail($id);
        $staff->status =  $staff->status == "active" ? "inactive" : "active";
        $staff->save();
        RedisService::publishBlockAccountStaff($staff);
        $request->session()->flash('alert-success', 'Restore success!');
        return redirect()->back();
    }

    public function showManageDatabasePage(){
        $databases = Database::orderBy('created_at', 'desc')->limit(1)->get();
        return view('admin.database')->with("databases", $databases);
    }

    public function backupDatabase(Request $request){
        try{
            //set filename with date and time of backup
            $fileName = "backup_" . Carbon::now()->format('Y_m_d_H_i_s') . ".sql";
            $storage = new Database();
            $storage->file_name = $fileName;
            $storage->date = Carbon::now();
            $storage->path = storage_path() . "/app/database/" . $fileName;
            $storage->save();

            //mysqldump command with account credentials from .env file. storage_path() adds default local storage path
            $command = "mysqldump --user=" . env('DB_USERNAME_MASTER') . " --password=" . env('DB_PASSWORD_MASTER') . " --host=" . env('DB_HOST_MASTER') . " " . env('DB_DATABASE_MASTER') . "  > " . storage_path() . "/app/database/" . $fileName;

            //exec command allows you to run terminal commands from php
            exec($command);
            //if nothing (error) is returned
            $request->session()->flash('alert-success', 'Backup success!');
        } catch(Exception $e) {
            // if there is an error send an email
            Log::error('There has been an error backing up the database:' . $e->getMessage());
            $errors = [
                'alert-error' => 'Error! Backup error'
            ];
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back();
    }

    public function restoreDatabase($id, Request $request){
        try{
            //set filename with date and time of backup
            $storage = Database::find($id);
            //mysqldump command with account credentials from .env file. storage_path() adds default local storage path
            $command = "mysql --user=" . env('DB_USERNAME_MASTER') . " --password=" . env('DB_PASSWORD_MASTER') . " --host=" . env('DB_HOST_MASTER') . " " . env('DB_DATABASE_MASTER') . "  < " . $storage->path;

            //exec command allows you to run terminal commands from php
            exec($command);
            //if nothing (error) is returned
            $request->session()->flash('alert-success', 'Restore success!');
        } catch(Exception $e) {
            // if there is an error send an email
            Log::error('There has been an error restore up the database:' . $e->getMessage());
            $errors = [
                'alert-error' => 'Error! Restore error'
            ];
            return redirect()->back()->withErrors($errors);
        }
        return redirect()->back();
    }

    public function getCreateCustomerPage(){
        return view('admin.create_customer');
    }

    public function createCustomer(Request $request){
        $params =  $request->all();
        DB::beginTransaction();
        try {
            $user = StaffService::createUser($params);
            $bankAccount = StaffService::createBankAccount($user, $params);
            StaffService::createCard($bankAccount, $user);

            DB::commit();
            $request->session()->flash('alert-success', 'Create Customer Success!');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());

            $errors = [
                'alert-error' => 'Account existed!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function getCreateStaffPage(){
        return view('admin.create_staff');
    }

    public function createStaff(Request $request){
        $params =  $request->all();
        DB::beginTransaction();
        try {
            $staff = new Staff();
            $staff->name = $params["name"];
            $staff->email = $params["email"];
            $staff->password = bcrypt("a");
            $staff->telephone = $params["telephone"];
            $staff->address = $params["address"];
            $staff->save();

            DB::commit();
            $request->session()->flash('alert-success', 'Create Customer Success!');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());

            $errors = [
                'alert-error' => 'Account existed!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }
}
