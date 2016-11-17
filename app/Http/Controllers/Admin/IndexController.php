<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use Redirect;

class IndexController extends AdminController
{
	function __construct(Request $request)
	{
		parent::__construct($request);
	}
	/**
	 * 后台首页
	 * @Author   feige
	 * @DateTime 2016-11-13T22:21:26+0800
	 * @param    Request
	 */
    public function index(Request $request)
    {
    	return view('admin/Index/index');
    }

    public function show()
    {
    	echo 'sb';
    }
}
