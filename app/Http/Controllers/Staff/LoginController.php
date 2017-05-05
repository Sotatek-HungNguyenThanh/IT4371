<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 18:00
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = "staff";
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/staff/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        return view('staff.login');
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            ["email" => $request->email, "password" => $request->password, "status" => "active"],
            $request->has('remember')
        );
    }
}