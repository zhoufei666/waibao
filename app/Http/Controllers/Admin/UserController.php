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

class userController  extends AdminController {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 修改用户密码
	 * @Author   feige
	 * @DateTime 2017-01-02T16:18:48+0800
	 * @return   [type]                   [description]
	 */
	public function forgetPassword()
	{
		return view('admin.user.forgetpassword');
	}

	/**
	 * 修改用户密码-操作
	 * @Author   feige
	 * @DateTime 2017-01-02T16:19:23+0800
	 * @return   [type]                   [description]
	 */
	public function updatePassword(Request $request)
	{
		//先不做权限管理--我修改我自己的密码，我忘记了
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
			    	$user = $userModel->verifyUserInfo($request,0);			    	

			    	if ($user) {	
			    		//修改密码
			    		$update_data['password'] = md5($user['salt'].$request->input('password'));
			    		$update_data['user_name'] = $request->input('username');
			    		$update_result = $userModel->updateUserInfo($user['id'],$update_data);
			    		if ($update_result) {
			    			$url = 'http://'.$_SERVER['HTTP_HOST'].'/admin/login'; 
			    			$this->ajaxReturn(array('status'=>200,'info'=>'修改成功','url'=>$url));
			    		}else{ 
			    			$this->ajaxReturn(array('status'=>0,'info'=>'修改失败'));
			    		}				    	
			    	}else{
				        $this->ajaxReturn(array('status'=>0,'info'=>'没有找到该用户'));
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


}
