<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\UserMenu;
use App\Models\Menu;
use Auth;
use DB;

class MenuComposer{

    public $menus;
    public $userMenus;
    
	public function __construct() 
	{
        $this->userMenus=[];
    }
	
    public function compose(View $view)
    {
        if(Auth::check())
		{
            $id =auth()->user()->id;
			$this->userMenus = UserMenu::where('user_id', $id )->where('view_menu',1)->pluck('menu_id')->all();

        }
       //dd(  $this->userMenus);
        $this->menus = Menu::
		where('company_id','=',11)
		->with('children')
		->whereNull('menu_id')->get();
		//$this->menus = DB::select('SELECT *FROM MENUS WHERE COMPANY_ID=11 AND MENU_ID IS NULL')->ToArray();
        //dd( $this->menus);
        $view->with(['menus'=>$this->menus,'userMenus'=>$this->userMenus]);
    
    }
}