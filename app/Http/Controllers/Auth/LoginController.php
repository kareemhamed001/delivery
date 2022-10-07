<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

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

    public function login(Request $request)
    {

        $credentials=$request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

//        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $agent = new Agent;
            Log::create([
                'user_id'=>Auth::user()->id,
                'browser_type'=>$agent->browser(),
                'browser_version'=>$agent->version($agent->browser()),
                'device_type'=>$agent->deviceType(),
                'location'=>Location::get($request->ip()),
                'operation'=>'loggedIn ',
            ]);

            if (Auth::user()->role_as=='1'){
                return  redirect('driver/home')->with('done','welcome '.Auth::user()->name);
            } elseif (Auth::user()->role_as=='2'){
                return  redirect('admin/home')->with('done','welcome '.Auth::user()->name);
            }
            elseif (Auth::user()->role_as=='3'){
                return  redirect()->back()->with('error','you didnt registered');
            }
            else{
                return  redirect('/home')->with('done','Logged In Successfully');
            }
        }

        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }



    protected function authenticated()
    {
        if (Auth::user()->role_as=='1'){
            return  redirect('driver/home')->with('done','welcome '.Auth::user()->name);
        } elseif (Auth::user()->role_as=='2'){
        return  redirect('admin/home')->with('done','welcome '.Auth::user()->name);
    }
        else{
            return  redirect('/home')->with('done','Logged In Successfully');
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest'])->except('logout');
    }
}
