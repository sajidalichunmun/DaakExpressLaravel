<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Session;
use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use Str;
use Mail;
use Validator;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

		$credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
		if(!Auth::attempt($credentials))
		{
			return response(['message' => "Invalid login credentials"],401);
		}
        // Creating a token without scopes...
        $token = Auth::user()->createToken('my_app_token')->accessToken;

        $user = Auth::user();
        // $plainTextToken = $user->createToken('token')->plainTextToken;
        $plainTextToken = $token;
        $cookie = cookie('jwt',$plainTextToken, 60 * 24); //one day //name:'jwt',$token,minutes:60 * 24
        
        // Creating a token with scopes...
        //$token = $user->createToken('My Token', ['place-orders'])->accessToken;
        // return response(['user' => Auth::user(),'access_token' => $token]);
        return response(['user' => Auth::user(),'access_token' => $token,'planTextToken' => $plainTextToken])
        ->WithCookie($cookie);
    }

	public function apilogout()
    {
        $cookie = Cookie::forget('jwt');

        Session()->forget('loginid');
		// Auth::user()->tokens('my_app_token')->delete();
        //Auth::logout();
        return response(['message' => 'success'])->withCookie($cookie);
    }
    
    public function forgot(ForgotRequest $request){
        $email = $request->input('email');
        if(User::where('email',$email)->doesntExist()){
            return response(['message' => 'User does\'t exists!'],404);
        }
        try{

            $token = Str::random(10);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);
            
            Mail::send('Mails.forgot',['token' => $token],function($message) use($email){
                $message->to($email);
                $message->subject('Reset your password'); 
            });
            return response(['message' => 'success'],200);
        }catch(\Exception $ex){
            return response(['message' => $ex->getMessage()],400);
        }
    }

    public function reset1(ResetRequest $request)
    {
        $input = $request->only('token', 'password', 'password_confirmation');
        $validator = Validator::make($input, [
            'token' => 'required',
            'password' => 'required',
            'password' => 'required|confirmed',
        ]);
        //'password' => 'required|confirmed|min:8',
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $token = $request->input('token');

        if(!$passwordResets= DB::table('password_resets')->where('token', $token)->first())
        {
            return response(['message' => 'Invalid token!'],400);
        }

        
        if(!$user = User::where('email', $passwordResets->email)->first()){
            return response(['message' => 'User doesn\'t exists!'],404);
        }

        $user->password = Hash::make($request->input('password'));

        $user->save();

        return response(['message' => 'success'],200);
    }

    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');

        if(!$passwordResets= DB::table('password_resets')->where('token', $token)->first())
        {
            return response(['message' => 'Invalid token!'],400);
        }

        
        if(!$user = User::where('email', $passwordResets->email)->first()){
            return response(['message' => 'User doesn\'t exists!'],404);
        }

        $user->password = Hash::make($request->input('password'));

        //$user->save();

        return response(['message' => 'success'],200);
    }

    public function user()
    {
        return response(['message' => 'success','data' => Auth::user()],200);
    }
    
}
