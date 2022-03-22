<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class InitialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Session()->get('loginid'));
        if($request->session()->has('loginid'))
        {
            return redirect()->route('home');
        }
        return view('index');
    }
}