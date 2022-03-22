<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuFormRequest;
use App\Models\Menu;
use App\Models\UserMenu;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class MenusController extends Controller
{
    /**
     * Display a listing of the menus.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $menus = Menu::where('company_id',11)->latest()->with('menu','creator','updater')->paginate(25);
		//dd($menus);
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu.
     *
     * @return Illuminate\View\View
     */
    public function create()
	{
        //$menus = Menu::kct()->pluck('name','id')->all();
		$menus = Menu::where('company_id',11)->pluck('name','id')->all();
		$creators = User::pluck('name','id')->all();
		$updaters = User::pluck('name','id')->all();
       
        return view('menus.create', compact('menus','creators','updaters'));
    }

    /**
     * Store a new menu in the storage.
     *
     * @param App\Http\Requests\MenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MenuFormRequest $request)
    {
        try 
		{
            $data = $request->getData();
			
            $data['created_by'] = Auth::Id();
            $data['company_id'] = 11;
			
			//dd($data);
			
            $menu = Menu::create($data);
			
			$users = User::where('company_id',11)->get();
			
            foreach($users as $user){
                 UserMenu::create([
                    'menu_id'=> $menu->id,
                    'user_id'=> $user->id, 
                ]); 

            }
			//dd($data['company_id']);

            return redirect()->route('menus.menu.index')
                ->with('success_message', 'Menu was successfully added.');
        } 
		catch (Exception $exception) 
		{

             return back()->withInput()
                 ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $menu = Menu::with('menu','creator','updater')->findOrFail($id);

        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        //$menus = Menu::kct()->pluck('name','id')->all();
		$menus = Menu::where('company_id',11)->pluck('name','id')->all();
		$creators = User::pluck('name','id')->all();
		$updaters = User::pluck('name','id')->all();

        return view('menus.edit', compact('menu','menus','creators','updaters'));
    }

    /**
     * Update the specified menu in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\MenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MenuFormRequest $request)
    {
        try 
		{
            
            $data = $request->getData();
            $data['updated_by'] = Auth::Id();
            $menu = Menu::findOrFail($id);
            $menu->update($data);

            return redirect()->route('menus.menu.index')
                ->with('success_message', 'Menu was successfully updated.');
        } 
		catch (Exception $exception) 
		{

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified menu from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try 
		{
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return redirect()->route('menus.menu.index')
                ->with('success_message', 'Menu was successfully deleted.');
        } 
		catch (Exception $exception) 
		{

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}