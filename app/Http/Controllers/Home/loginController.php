<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CaptchaController;


// zhoufei set
use App\Http\Models\Users;
use Input;
use Validator;
use Redirect;
use Hash;
use URL;
use Cookie;
use Session;


class loginController extends Controller
{
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
			        $msg = $validator->messages();
			        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
			        $this->ajaxReturn(array('status'=>0,'info'=>$msg,'url'=>$url));
			    }
			}

		}else{
			return view('Home.Login.login');
		}
		
	}

	/**
	 * 注册页面
	 */
	public function showRegister(Request $request)
	{
			return view('Home.Login.register');				
	}

	/**
	 * 验证注册
	 * @Author   feige
	 * @DateTime 2017-06-08T20:09:46+0800
	 * @return   json                   返回json格式
	 */
	public function register(Request $request)
	{
		if ($request->isMethod('post')) {

			// 创建验证规则
		    $rules = array(
		        'email' => 'required|unique:users|Regex:/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/',
		        'password' => 'required|Regex:/^(\w){6,100}$/',
		        'verify_code' => 'required',
		    );
		    // 自定义验证消息
		    $messages = array(
		        'email.required' => '请填写邮箱',
		        'email.regex' => '请正确填写邮箱',
		        'email.unique' => '该邮箱已注册',
		        'password.required' => '请填写密码',
		        'password.regex' => '请按规则填写密码',	
		        'verify_code.required' => '请填写验证码',	        
		    );
			if (Input::all()) {
				// 开始验证
			    $validator = Validator::make(Input::all(), $rules, $messages);
			    
			    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];//前一次url

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

			    	//判断验证码
			    	// $captcha = new CaptchaController();
			    	// if (!$captcha->verifyCaptcha(Input::get('verify_code'))){
			    	// 	die;
			    	// 	$this->ajaxReturn(array('status'=>0,'info'=>'请正确填写验证码','url'=>$url));
        //                 // return response()->withInput($request->all())->withErrors('请正确填写验证码');
        //           //        return redirect()
		      //           // ->back()
		      //           // ->withErrors($validator)
		      //           // ->withInput();
			    	// }
			    				    	
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
				        $this->ajaxReturn(array('status'=>0,'info'=>'注册失败','url'=>$url));
			    	}

			 
			    } else {
			        // 验证失败
			        $msg = $this->errorMessageToString($validator->messages());
			        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
			        $this->ajaxReturn(array('status'=>0,'info'=>$msg,'url'=>$url));

			        // return Redirect::back()->withInput()->withErrors($validator);
			        // redirect('home/register')
           //              ->withErrors($validator)
           //              ->withInput();
			    }
			}

		}
	}



    /**
     * 错误信息拼接成字符串
     * @Author   feige
     * @DateTime 2017-06-09T01:47:31+0800
     * @param    obj                   $errorMessage 错误信息对象
     * @return   string                                 错误信息
     */
    public function errorMessageToString($errorMessage = '')
    {
        $errors = '';
        if ($errorMessage) {
            foreach ($errorMessage->all() as $error) {
                $errors .= '-'.$error;
            }
        }
        return $errors;
    }

    

}
