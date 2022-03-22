<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\UserMenu;
use App\Models\Menu;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('company_id',11)->paginate(25);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

		$menus = Menu::where('company_id',11)->with('children')->get();    
        
		$roles = Role::all();
        
        return view('users.create',compact('menus','roles'));
        
        //return view('users.create');
    }

    /**
     * Store a new user in the storage.
     *
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UserFormRequest $request)
    {
        try 
		{
				
               $permissions = $request->permissions;
				$roles =$request->roles;
				$pass= substr(strtoupper(str_random(50)),0,6);
				//$pass = Hash::make();
				$data = $request->all();
				
				//$data['password']=bcrypt($pass);
				$pass="tiger";
				//$pass = $request->password;
				//dd($pass);
				$data['password'] = Hash::make($pass);
				$data['company_id']=11;
        //dd( $pass);

        $user = User::create($data);

		$user->password = $pass;

    
           // $user = User::create($request->all());
            
        /**
         * Attach roles to the created user
         */
           $user->roles()->attach($roles);
           /**
            * Assign permissions to the created user
            */
            if( $permissions)
			{
                foreach($permissions as $permission)
				{
                    $user_menu = UserMenu::create([
                        'view_menu'=> isset($permission['view_menu']) ? $permission['view_menu'] : '0' ,
                        'create'=> isset($permission['create']) ? $permission['create'] : '0',
                        'view'=> isset($permission['view']) ? $permission['view'] : '0' ,
                        'update'=> isset($permission['update']) ? $permission['update'] : '0',
                        'delete'=> isset($permission['delete']) ? $permission['delete'] : '0',
                        'print'=> isset($permission['print']) ? $permission['print'] :'0' ,
                        'excel'=> isset($permission['excel']) ? $permission['excel'] : '0',
                        'menu_id'=> isset($permission['menu_id']) ? $permission['menu_id'] : '0',
                        'user_id'=> $user->id, 
                    ]);  
                }
            }

            // $data = $request->getData();
            
            // User::create($data);

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully added.');
         } 
		 catch (Exception $exception) 
		 {
			/*
             return back()->withInput()
                 ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
				 */
				 return back()->withInput()
                 ->withErrors(['unexpected_error' => $exception->getMessage()]);
         }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
       // $user = User::findOrFail($id);
        
        $user = User::with('user_menus')->findOrFail($id);
    
        $roles = Role::all();
        
        $menu_users = UserMenu::has('menu')->where('user_id',$id)->get();
        
		$creators = User::pluck('name','id')->all();
		
		$updaters = User::pluck('name','id')->all();
		
        $menus = Menu::where('company_id',11)->with('children')->get();   
		//dd($menus);
        return view('users.edit', compact('user','creators','updaters','menus','menu_users','roles'));

        //return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UserFormRequest $request)
    {
        try 
		{
			$permissions = $request->permissions;
			$roles =$request->roles;
			$data = $request->all();

			$user = User::findOrFail($id);
      
            $data['updated_by'] = Auth::Id();
            $user->update($data);

			if($permissions)
			{
				foreach($permissions as   $permission)
				{
					 /** update user permissions */
					$menu_user = UserMenu::where('menu_id',$permission['menu_id'])->where('user_id',$user->id)->first();
					$menu_user->menu_id = $permission['menu_id'];
					$menu_user->view_menu =  isset($permission['view_menu']) ? $permission['view_menu'] : '0';
					$menu_user->create = isset($permission['create']) ? $permission['create'] : '0';
					$menu_user->view =isset($permission['view']) ? $permission['view'] : '0';
					$menu_user->update =isset($permission['update']) ? $permission['update'] : '0';
					$menu_user->delete = isset($permission['delete']) ? $permission['delete'] : '0';
					$menu_user->print =isset($permission['print']) ? $permission['print'] : '0';
					$menu_user->excel = isset($permission['excel']) ? $permission['excel'] : '0';
					$menu_user->user_id =$user->id;
					$menu_user->save();
				}

			}

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully updated.');
        } 
		catch (Exception $exception) 
		{

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try 
		{
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully deleted.');
        } 
		catch (Exception $exception) 
		{

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
