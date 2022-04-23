<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     *
     *
     *@return void
    */
    public function _contruct(){
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
    *@return \Illuminate\Contracts\Suppport\Renderable
    */
    public function index(){
        return view('user.home');
    }




}
