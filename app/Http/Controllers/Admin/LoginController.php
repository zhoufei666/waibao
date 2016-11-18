<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use Validator;
use Session;

use App\Http\Models\admin\userModel;
use App\Http\Models\Users;
use App\Http\Controllers\CaptchaController as Captcha;

class LoginController extends Controller {

	/**
	 * 登录
	 */
	public function login(Request $request)
	{
		return view('admin/login');
	}

	/**
	 * 处理登录
	 */
	public function handleLgoin(Request $request)
	{
		if ($request->isMethod('post')) {
			// 创建验证规则
		    $rules = array(
		        'username' => 'required',
		        'password' => 'required|Regex:/^(\w){4,100}$/',
		    );
		    // 自定义验证消息
		    $messages = array(
		        'username.required' => '请填写用户名',
		        'password.required' => '请填写密码',
		        'password.regex' => '请按规则填写密码',		        
		    );

		    if (Input::all()) {
		    	
				// 开始验证
			    $validator = Validator::make(Input::all(), $rules, $messages);
			    if ($validator->passes()) {

			    	//验证码
			    	$CaptchaController = new Captcha();
			    	$verifyCaptcha = $CaptchaController->verifyCaptcha($request);
			    	if (!$verifyCaptcha) {
			    		$this->ajaxReturn(array('code'=>200,'info'=>'验证码不正确，请刷新验证码后重试','reload_captcha'=>true));
			    	}

			    	$userModel = new userModel();

			    	// 验证用户信息
			    	$user = $userModel->verifyUserInfo($request);			    	

			    	if ($user) {	
			    		   		
				    	//是否记住登录登录
				    	if (Input::get('remember')) {
				    		if ($request->session()->has('uremember_login')) {
							    $request->session()->put('remember_login', 1);
							}
							$request->session()->put('remember_login', 1);
							$this->remember_login = 1;
				    	}

				    	//登录后续操作
				    	$userModel->afterLoginAction($user);

				    	//保存用户session
				    	$request->session()->put('uid', $user['id']);
				    	$request->session()->put('user_name', $user['user_name']);
				    	Session::save();

				    	$url = 'http://'.$_SERVER['HTTP_HOST'].'/admin/index'; 
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
			return json_encode(array('code'=>0,'msg'=>'非法访问'));
		}	
	}
	

	/**
	 * 登出
	 */
	public function loginOut(Request $request)
	{
		Session::forget('uid');
		Session::forget('user_name');
		if ($request->isMethod('get')) {
			return redirect('admin/login');
		}
	}


	public function register(Request $request)
	{
		$userModel = new userModel();

		$uid = $userModel->register($request);

		if ($uid) {
			echo '注册成功';
		}else{
			echo '注册失败';
		}
	}

}
