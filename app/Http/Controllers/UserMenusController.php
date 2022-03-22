<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserMenusFormRequest;
use App\Models\Menu;
use App\Models\User;
use App\Models\UserMenu;
use Exception;


class UserMenusController extends Controller
{
    /**
     * Display a listing of the user menus.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $userMenus = UserMenu::with('user','menu')->paginate(25);

        return view('user_menus.index', compact('userMenus'));
    }

    /**
     * Show the form for creating a new user menu.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $Users = User::pluck('name','id')->all();
		$Menus = Menu::pluck('name','id')->all();
        
        return view('user_menus.create', compact('Users','Menus'));
    }

    /**
     * Store a new user menu in the storage.
     *
     * @param App\Http\Requests\UserMenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UserMenusFormRequest $request)
    {
        try 
		{
            
            $data = $request->getData();
            
            UserMenu::create($data);

            return redirect()->route('user_menus.user_menu.index')
                             ->with('success_message', 'User Menu was successfully added.');

        } 
		catch (Exception $exception) 
		{

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified user menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $userMenu = UserMenu::with('user','menu')->findOrFail($id);

        return view('user_menus.show', compact('userMenu'));
    }

    /**
     * Show the form for editing the specified user menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
		
        $userMenu = UserMenu::findOrFail($id);
        $Users = User::pluck('name','id')->all();
		$Menus = Menu::pluck('name','id')->all();

        return view('user_menus.edit', compact('userMenu','Users','Menus'));
    }

    /**
     * Update the specified user menu in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\UserMenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UserMenusFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $userMenu = UserMenu::findOrFail($id);
            $userMenu->update($data);

            return redirect()->route('user_menus.user_menu.index')
                             ->with('success_message', 'User Menu was successfully updated.');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified user menu from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $userMenu = UserMenu::findOrFail($id);
            $userMenu->delete();

            return redirect()->route('user_menus.user_menu.index')
                             ->with('success_message', 'User Menu was successfully deleted.');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}