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
		$salt = rand(10000,999999);

		$data['user_name'] = 'sy_'.rand(99999,10000);	
		$data['email'] = $request->input('email');
		$data['password'] = md5($salt.$request->input('password'));
		$data['created_at'] = date('Y-m-d H:i:s',time());
		$data['updated_at'] = date('Y-m-d H:i:s',time());
		$data['last_login_ip'] = Request()->getClientIp();
		$data['last_login_time'] = date('Y-m-d H:i:s',time());
		$data['uclass'] = $request->input('uclass')?$request->input('uclass'):2;
		$data['enable'] = $request->input('enable')?$request->input('enable'):0;
		$data['salt'] = $salt;
		
		return DB::table($this->table)->insertGetId($data);
	}

	/**
	 * [verifyUserInfo 验证用户信息，并返回用户id，user_name]
	 * @Author   feige
	 * @DateTime 2017-01-02T16:55:25+0800
	 * @param    string                   $request        [请求的数据]
	 * @param    integer                  $check_password [是否需要检查密码：0 不需要，1 需要]
	 * @return   mix                                   [如果有：返回用户id，user_name；没有返回false]
	 */
	public function verifyUserInfo($request = '',$check_password = 1)
	{
		$user_name = $request->input('username');
		$password = $request->input('password');

		$user = $this->where('user_name',$user_name)->first(array('id','user_name','password','salt'));

		// print_r(DB::getQueryLog());die;

		// 以后来做邮箱激活才能登录的功能
		if ($user) {
			if ($check_password) {
				if (md5($user['salt'].$password) == $user['password']) {
					unset($user['password']);
					return $user->toArray();
				}else{
					return false;
				}
			}else{
				return $user->toArray();
			}
		}else{
			return false;
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

	/**
	 * 修改用户信息
	 * @Author   feige
	 * @DateTime 2017-01-02T16:36:17+0800
	 * @param    string                   $uid 修改条件
	 * @param    string                   $data  要修改的数据
	 * @return   bool                          修改后的结果
	 */				
	public function updateUserInfo($uid = '',$data = '')
	{
		if (empty($uid) ||  empty($data)) {
				return false;
		}
		return $this->where('id',$uid)->update($data);
	}

}
