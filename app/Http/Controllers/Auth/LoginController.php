<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

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
	 
    protected $redirectTo = RouteServiceProvider::HOME;
	//protected $redirectTo = '/home';
    //protected $redirectAfterLogout = '/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	public function login(Request $request)
	{
		try{

			$request->validate([
				'email' => 'required|email',
				'password' => 'required'
			]);

			$credentials = [
				'email' => $request->email,
				'password' => $request->password,
			];
			
			if( Auth::attempt($credentials))
			{
				// Creating a token without scopes...
				//$token = Auth::user()->createToken('authToken')->accessToken;
				
				// Creating a token with scopes...
				//$token = $user->createToken('My Token', ['place-orders'])->accessToken;

				/*** @var User $user */
				
				$user = Auth::user();
				$token = $user->createToken('authToken')->accessToken;

				//$user = User::where('email',$request->email)->first();
				
				if($user)
				{
					if(Hash::check($request->password,$user->password))
					{
						Session()->put('loginid',$user->id);
						Session()->put('access_token',$token);
						$request->session()->put('loginid',$user->id);
						
						return redirect($this->redirectTo);
					}
					else
					{
						return back()->with('password','Password not matched!!');
					}
				}
				else
				{
					return back()->with('email','This email is not registered!!');
				}
			}else{
				return back()->withInput()->withErrors(['errors' => 'Invalid login credentials!!']);
			}
		}catch(\Exception $ex){
            return back()->withInput()->withErrors(['errors' => $ex->getMessage()]);
        }
	}
	public function login1(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

		$credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
		if( Auth::attempt($credentials))
		{
			$user = User::where('email',$request->email)->first();
			
			if($user)
			{
				if(Hash::check($request->password,$user->password))
				{
					//$token = $user->createToken('myApptoken')->plainTextToken;
					// $response = [
					// 	'user' => $user,
					// 	'token' => $token
					// ];
					// return response($response,201); //every thing is created and successfully

					// $user->token->delete();
					Session()->put('loginid',$user->id);
					$request->session()->put('loginid',$user->id);
					//dd(Session()->get('loginid'));
					return redirect($this->redirectTo);
				}
				else
				{
					return back()->with('password','Password not matched!!');
				}
			}
			else
			{
				return back()->with('email','This email is not registered!!');
			}
		}
	}
	public function index()
	{   
	  $user_id = Auth::user()->id;  
	}

	public function methodB() 
	{
		session(['depot' => 'Sajid']);
	}

	protected function authenticated(Request $request, $user)
	{
		redirect('home');
		//$this->setUserSession($user);
	}

	protected function setUserSession($user)
	{
		session(
			[
				'depot' => $user->settings->depot
			]
		);
	}
	
	protected function setUserSession1($user)
	{
		session(
			[
				'last_invoiced_at' => $user->settings->last_invoiced_at,
				'total_amount_due' => $user->settings->total_amount_due
			]
		);
	}
		
	public function logout(Request $request) {
        Session()->forget('loginid');
		//auth()->user()->tokens()->delete();
        Auth::logout();

        //return redirect('/login');
		return redirect('/');
    }

	public function ForgotUsername() {
       return view('auth.forgot-username');
    }

	public function ForgotUsername1(Request $request) {
		
		$email = $request->input('email');

		$input = $request->only('email');

        $validator = Validator::make($input, [
            'email' => 'required|email',
        ]);
		
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
		
		$user = User::where(['email' => $email])->first();
		
        if(!$user){
            return response(['message' => 'User does\'t exists!'],404);
        }
        try{
            Mail::send('Mails.mail-forgot-username',['username' => $user->name],function($message) use($email){
                $message->to([$email]);
                $message->subject('Forgot Username'); 
            });
			return back()->with('status', "Check your email");
        }catch(\Exception $ex){
            return response(['message' => $ex->getMessage()],400);
        }

	 }
}
