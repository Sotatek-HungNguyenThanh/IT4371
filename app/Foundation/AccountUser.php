<?php

namespace App\Foundation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:43
 */
trait AccountUser
{
    public function updatePassword(Request $request){
        $newPassword = $request->new_password;
        $oldPassword = $request->old_password;
        $user = $this->guard()->user();
        if (Hash::check($oldPassword, $user->password))
        {
            $user->password = bcrypt($newPassword);
            $user->save();
            $request->session()->flash('alert-success', 'Password change success!');
            return redirect()->back();
        }
        $errors = [
            'alert-error' => 'Password wrong!'
        ];
        return redirect()->back()->withErrors($errors);
    }

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
}