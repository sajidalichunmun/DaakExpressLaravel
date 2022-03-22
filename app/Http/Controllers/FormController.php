<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator,Redirect,Response;
use App\Contact;
use Exception;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajax-form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		try
		{
			/*request()->validate([
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'mobile_number' => 'required|unique:users'
			]);
			 */
			$data = $request->all();
			//$arr = array('msg' => $data, 'status' => false);
			$check = Contact::insert($data);
			$arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
			if($check){ 
				$arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
			}
		}
		catch(Exception $ex)
		{
			$arr = array('msg' => $ex->getMessage(), 'status' => false);
		}
        return Response()->json($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
