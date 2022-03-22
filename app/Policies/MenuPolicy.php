<?php

namespace App\Policies;

use App\User;
use App\Models\Menu;
use App\Models\UserMenu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function index(User $user)
    {
        # code...
        $controller = str_replace('Controller','',class_basename(request()->route()->getController())) ;
        $menuId =  Menu::where('controller',$controller)->first()->id;
        //dd( $controller);
       
        $user_menu = UserMenu::where(['user_id'=>$user->id,'menu_id'=>$menuId])->first();
        return $user_menu->view_menu ? true : false;
    

    }


    /**
     * Determine whether the user can view the menu.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function view(User $user, Menu $menu)
    {
        //

    }

    /**
     * Determine whether the user can create menus.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //

        $controller = str_replace('Controller','',class_basename(request()->route()->getController())) ;
        $menuId =  Menu::where('controller',$controller)->first()->id;
      // dd( $controller);
       
        $user_menu = UserMenu::where(['user_id'=>$user->id,'menu_id'=>$menuId])->first();
        return $user_menu->create ? true : false;
    }

    /**
     * Determine whether the user can update the menu.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function update(User $user, Menu $menu)
    {
        //
        $controller = str_replace('Controller','',class_basename(request()->route()->getController())) ;
        $menuId =  Menu::where('controller',$controller)->first()->id;
      // dd( $controller);
       
        $user_menu = UserMenu::where(['user_id'=>$user->id,'menu_id'=>$menuId])->first();
        return $user_menu->update ? true : false;
    }

    /**
     * Determine whether the user can delete the menu.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function delete(User $user, Menu $menu)
    {
        //
        $controller = str_replace('Controller','',class_basename(request()->route()->getController())) ;
        $menuId =  Menu::where('controller',$controller)->first()->id;
      // dd( $controller);
       
        $user_menu = UserMenu::where(['user_id'=>$user->id,'menu_id'=>$menuId])->first();
        return $user_menu->delete ? true : false;

    }
}
