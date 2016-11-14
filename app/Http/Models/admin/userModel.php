<?php

namespace App\Http\Models\admin;

use Illuminate\Database\Eloquent\Model;

use Request;
use DB;
use Session;

class userModel extends adminModel
{
    public $table = 'users';

    /**
	 * 注册插入数据库
	 * 返回新增id
	 */
	public function register(Request $request)
	{	
		$salt = rand(1,999999);

		$data['name'] = $request->input('name');	
		$data['email'] = $request->input('email');
		$data['password'] = md5($salt.$request->input('password'));
		$data['created_at'] = date('Y-m-d H:i:s',time());
		$data['updated_at'] = date('Y-m-d H:i:s',time());
		$data['last_login_ip'] = Request()->getClientIp();
		$data['last_login_time'] = date('Y-m-d H:i:s',time());
		$data['uclass'] = $request->input('uclass')?$request->input('uclass'):2;
		$data['enable'] = $request->input('enable')?$request->input('enable'):0;
		$data['salt'] = $salt;
		
		return $this->insertGetId($data);
	}

	/**
	 * 验证用户信息，并返回用户id，user_name
	 * @param $request 请求的数据
 	 * @param $uid 用户id
 	 * @param $user_name 用户名
	 */
	public function verifyUserInfo($request)
	{
		$user_name = $request->input('username');
		$password = $request->input('password');
		$password = md5($this->salt.$password);

		// DB::connection()->enableQueryLog();
		$user = $this->where('user_name',$user_name)->where('password',$password)->first(array('id','user_name'));

		// print_r(DB::getQueryLog());die;

		// 以后来做邮箱激活才能登录的功能

		if ($user) {
			return $user->toArray();
		}else{
			return 0;
		}
	}


	/**
	 * 登录后-操作用户表
	 */
	public function afterLoginAction($user = '')
	{
		if ($user == '') {
			return false;
		}

		//修改登录信息
		$data['last_login_ip'] =  Request()->getClientIp();
		$data['last_login_time'] = date('Y-m-d H:i:s',time());

		return $this->where('id',$user['id'])->update($data);
	}

}
