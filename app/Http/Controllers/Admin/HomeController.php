<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     *
     *
     * @return void
    */
    public function _contruct(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
    *@return \Illuminate\Contracts\Suppport\Renderable
    */
     public function index(){
    //     $user = Auth::user();

    //     $user->authorizedRoles('admin');

        return view('admin.home');
    }

}
