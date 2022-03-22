<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use DateTime;
use Exception;
use App\User;
use Auth;
use App\Repositories\BusinessLogic;

class ApiAwbMasterController extends Controller
{
    private BusinessLogic $logic;
    public function __construct(BusinessLogic $_logic)
    {
        $this->logic = $_logic;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetList()
    {
        return $this->logic->list();
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetDataById($id)
    {
        return $this->logic->show($id);
    }
}
