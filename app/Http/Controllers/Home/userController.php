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

	/**
	 * 登录
	 */
	public function login(Request $request)
	{
		if ($request->isMethod('post')) {
			// 创建验证规则
		    $rules = array(
		        'email' => 'required|Regex:/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/',
		        'password' => 'required|Regex:/^(\w){6,100}$/',
		    );
		    // 自定义验证消息
		    $messages = array(
		        'email.required' => '请填写邮箱',
		        'email.regex' => '请正确填写邮箱',
		        'password.required' => '请填写密码',
		        'password.regex' => '请按规则填写密码',		        
		    );

			if (Input::all()) {
				// 开始验证
			    $validator = Validator::make(Input::all(), $rules, $messages);
			    if ($validator->passes()) {

			    	$users = new Users();

			    	// 验证用户信息
			    	$uid = $users->verifyUserInfo($request);

			    	if ($uid) {	
			    		$url = 'http://'.$_SERVER['HTTP_HOST'];    		
				    	//是否记住登录登录
				    	if (Input::get('remember')) {
				    		if ($request->session()->has('uremember_login')) {
							    $request->session()->put('remember_login', 1);
							}
							$request->session()->put('remember_login', 1);
				    	}

				    	//登录后续操作
				    	$users->afterLoginAction($uid);

			    		$this->ajaxReturn(array('status'=>200,'info'=>'登录成功','url'=>$url));
			    	}else{
				        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
				        $this->ajaxReturn(array('status'=>0,'info'=>'登录失败,用户名和密码不一致','url'=>$url));
			    	}
			 
			    } else {
			        // 验证失败
			        $msg = $this->errorMessageArrayToString($validator->messages());
			        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
			        $this->ajaxReturn(array('status'=>0,'info'=>$msg,'url'=>$url));
			    }
			}

		}else{
			return view('Home.user.login');
		}
		
	}

	/**
	 * 注册页面
	 */
	public function register(Request $request)
	{
		if ($request->isMethod('post')) {

			// 创建验证规则
		    $rules = array(
		        'email' => 'required|unique:users|Regex:/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/',
		        'password' => 'required|Regex:/^(\w){6,100}$/',
		    );
		    // 自定义验证消息
		    $messages = array(
		        'email.required' => '请填写邮箱',
		        'email.regex' => '请正确填写邮箱',
		        'email.unique' => '该邮箱已注册',
		        'password.required' => '请填写密码',
		        'password.regex' => '请按规则填写密码',		        
		    );
			if (Input::all()) {
				// 开始验证
			    $validator = Validator::make(Input::all(), $rules, $messages);
			    if ($validator->passes()) {
			    	$users = new Users();
			    	//判断邀请码
			    	$invite_code_veriry_msg = '';
			    	if (Input::get('invite_code')) {			    		
				    	$invite_code_veriry = $request->invite_code_id = $users->getInviteCodeId(Input::get('invite_code'));
				    	if ($invite_code_veriry == 0) {
				    		$invite_code_veriry_msg = '(无效的邀请码)';
				    	}
			    	}
			    				    	
			    	// 插入数据库操作
			    	$new_uid = $users->register($request);

			    	if ($new_uid) {
			    		$url = 'http://'.$_SERVER['HTTP_HOST'];
			    		if (Input::get('login_in')) {
			    			$url = url('home/user');
			    		}

				    	//是否自动登录
				    	if (Input::get('login_in')) {
				    		if ($request->session()->has('uid')) {
							    $request->session()->put('uid', $new_uid);
							}
							$request->session()->put('uid', $new_uid);
				    	}
				    	//发送验证邮箱

			    		$this->ajaxReturn(array('status'=>200,'info'=>'注册成功'.$invite_code_veriry_msg,'url'=>$url));
			    	}else{
				        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
				        $this->ajaxReturn(array('status'=>0,'info'=>'注册失败','url'=>$url));
			    	}

			 
			    } else {
			        // 验证失败
			        $msg = $this->errorMessageArrayToString($validator->messages());
			        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
			        $this->ajaxReturn(array('status'=>0,'info'=>$msg,'url'=>$url));

			        // return Redirect::back()->withInput()->withErrors($validator);
			    }
			}

		}else{
			return view('Home.user.register');
		}
				
	}
    

}
