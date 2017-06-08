<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


// zhoufei set
use App\Http\Models\Users;
use Input;
use Validator;
use Redirect;
use Hash;
use URL;
use Cookie;
use Session;

class userController extends Controller
{
	public function index()
	{	
		$account = Users::find(1)->account;
		return view('Home.user.index',['account'=>$account]);
	}

}
