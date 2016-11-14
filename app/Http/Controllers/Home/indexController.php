<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
	/**
	 * 网站首页
	 * @return 
	 */
    public function index()
    {
    	return view('Home.index');
    }

}
