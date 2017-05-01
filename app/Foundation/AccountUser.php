<?php

namespace App\Foundation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:43
 */
trait AccountUser
{

    public function updateAvatar(Request $request){
        $params = $request->all();
        if (is_file($params['file'])) {
            $file = $params['file'];
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($file_name, File::get($file));
            $user = $this->guard()->user();
            $user->avatar = 'storage/' .$file_name;
            $user->save();
            return redirect()->back();
        }
    }

    protected function guard(){
        return Auth::guard();
    }

    protected function model(){
        return app(User::class);
    }

    public function getAccountInfo(){
        return $this->guard()->user();
    }

    public function updateAccountInfo(Request $request){
        DB::beginTransaction();
        try {
            $params = $request->all();
            $user = $this->model()->firstOrNew(['email' => $this->guard()->user()->email]);
            $user->name = $params['name'];
            $user->address = $params['address'];
            $user->telephone = $params['telephone'];
            $user->save();
            $request->session()->flash('alert-success', 'Information update!');
            DB::commit();
            return redirect()->back();
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            $errors = [
                'alert-error' => 'Error! Information not update'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }
    public function updatePassword(Request $request){
        try {
            $params = $request->all();
            $user = $this->guard()->user();
            if (Hash::check($params['old_password'], $user->password)) {
                $user->password =  Hash::make($params['new_password']);
                $user->save();
                $request->session()->flash('alert-success', 'Password change success!');
                return redirect()->back();
            }else{
                $errors = [
                    'alert-error' => 'Password wrong!'
                ];
                return redirect()->back()->withErrors($errors);
            }
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}