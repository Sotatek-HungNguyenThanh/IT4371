<?php
namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers;


use App\Foundation\AccountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    use AccountUser;

    public function getManagePasswordPage(){
        return view('user.manage_password');
    }

    public function getUpdateInfoPage(){
        return view('user.update_info');
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
}