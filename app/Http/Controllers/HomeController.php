<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Auth\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	protected function authenticated(Request $request, $user)
	{
		dd($requesmt->input('depot'));
		return response([
        //
		]);
	}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
		//return view('layouts.dashboard');
		//return view('layouts.app');
		//return view('layouts.main');
    }
	
	public function index1(Request $request)
    {
		//dd($request->input('depot'));
		
        return view('home');
    }
}
