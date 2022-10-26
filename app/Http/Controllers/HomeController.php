<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function joinUs()
    {

        return view('join_us');
    }
    public function storeJoinOrder(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:50'],
            'phone_number'=>['required','numeric','max_digits:11','min_digits:11'],
            'national_id'=>['required','numeric','max_digits:14','min_digits:14'],
            'moto_number'=>['required','numeric','max_digits:4','min_digits:4'],
            'moto_model'=>['required','numeric','date_format:Y'],
            'year_of_getting_licence'=>['required','numeric','date_format:Y'],
            'number_of_years_of_the_license'=>['required','numeric','max:3','min:1'],
//            'have_box'=>['nullable']
        ]);

        try {


            $user=User::find(Auth::user()->id);
            return $user;


        }catch (\Exception $e){

        }

        return back()->with('Done') ;
    }
}
