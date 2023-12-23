<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function credentials(Request $request)
    {
        // $credentials = $request->only($this->username(), 'password');
        // $credentials['email'] = strtolower($credentials['email']);
        // $credentials['status'] = '1';
        // return $credentials;
        return [
            'email'     => $request->email,
            'password'  => $request->password,
            'status' => '1'
        ];
    }

    protected function Authenticated()
    {
        if (Auth::check()) {
            switch (Auth::user()->role) {
                case 'super_admin':
                    return redirect('admin/admin_dashboards')->with('success', 'Welcome back Supper Admin');
                    break;
                case 'branch_admin':
                    return redirect('admin/admin_dashboards')->with('success', 'Welcome back Supper Admin');
                    break;
                case 'veterinarian':
                    return redirect('veterinary/vet_dashboards')->with('success', 'Welcome back Doc.');
                    break;
                case 'client':
                    return redirect('/')->with('success', 'Goto to the apps.');
                    break;
                default:
                    return abort(404);
                    break;
            }

            // if (Auth::user()->role == 'super_admin') { // 1 - admin login
            //     return redirect('admin/admin_dashboards')->with('success', 'Welcome back Supper Admin');
            // } else if (Auth::user()->role == 'branch_admin') { // 1 - admin login
            //     return redirect('admin/admin_dashboards')->with('success', 'Welcome back Supper Admin');
            // } else if (Auth::user()->role == 'veterinarian') { // 1 - admin login
            //     return redirect('veterinary/vet_dashboards')->with('success', 'Welcome back Doc.');
            // } else {
            //     return abort(404);
            // }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
