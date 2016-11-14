<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * 后台首页
	 * @Author   feige
	 * @DateTime 2016-11-13T22:21:26+0800
	 * @param    Request
	 */
    public function Index(Request $request)
    {
    	
    	return view('admin/Index/index');
    }
}
