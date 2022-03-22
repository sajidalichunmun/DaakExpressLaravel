<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesFormRequest;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class RolesController extends Controller
{

    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::with('creator','updater')->paginate(25);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $creators = User::pluck('name','id')->all();
		$updaters = User::pluck('name','id')->all();
        
        return view('roles.create', compact('creators','updaters'));
    }

    /**
     * Store a new role in the storage.
     *
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['created_by'] = Auth::Id();
            Role::create($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully added.');

        } catch (Exception $ex) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::with('creator','updater')->findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $creators = User::pluck('name','id')->all();
		$updaters = User::pluck('name','id')->all();

        return view('roles.edit', compact('role','creators','updaters'));
    }

    /**
     * Update the specified role in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['updated_by'] = Auth::Id();
            $role = Role::findOrFail($id);
            $role->update($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully updated.');

        } catch (Exception $ex) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $ex->getMessage()]);
        }        
    }

    /**
     * Remove the specified role from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully deleted.');

        } catch (Exception $ex) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $ex->getMessage()]);
        }
    }



}
