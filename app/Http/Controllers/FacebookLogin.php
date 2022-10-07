<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookLogin extends Controller
{
    function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function facebookCallback(){
        try {
            $user=Socialite::driver('facebook')->user();
            dd($user);
        }catch (\Exception $e){

        }

    }
}
