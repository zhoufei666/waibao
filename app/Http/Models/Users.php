<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\UserAccount;

use Hash;
use Request;
use Input;
use DB;

class Users extends homeModel
{
    public function account()
	{
	    return $this->hasOne('App\Http\Models\UserAccount');
	}

	/**
	 * 验证用户信息，并返回用户id
	 * @param $request 请求的数据
 	 * @param $uid 用户id:-1该用户已删除，-2账户冻结，0没有此用户，正常情况是用户id
	 */
	public function verifyUserInfo($request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$password = md5($this->salt.$password);
		$user = $this->where('email',$email)->where('password',$password)->first(array('id','status'));

		// 以后来做邮箱激活才能登录的功能

		if ($user->id) {
			if ($user->status == 1) {
				return $user->id;
			}else{
				return $user->status;
			}
		}else{
			return 0;
		}
	}

	/**
	 * 注册插入数据库
	 */
	public function register($request)
	{	
		$data['user_name'] = 'sy_'.rand(99999,10000);	
		$data['email'] = Input::get('email');
		$data['password'] = md5($this->salt.$request->get('password'));
		$data['created_at'] = time();
		$data['updated_at'] = time();
		$data['invite_code'] = Input::get('invite_code');//明天来弄这个邀请码的事情，
		$data['last_login_ip'] = Request()->getClientIp();
		$data['last_login_time'] = time();
		
		return DB::table('users')->insertGetId($data);
	}

	/**
	 * 通过邀请码查询邀请码ID
	 */
	public function getInviteCodeId($invite_code)
	{
		$id = DB::table('invite_code')->where('code','=',$invite_code)->where('status',1)->value('id');
		
		// 查询字段可以这样写
		// select('')->find();//返回是对象
		// first('id');//返回是对象
		// value('id');//获取单个字段值

		if ($id) {
			return $id;
		}else{
			return 0;
		}
	}

	/**
	 * 用户登录后的操作
	 */
	public function afterLoginAction($uid)
	{
    	//存储已登录用户基本信息
    	$userinfo = $this->getBasicUserInfo(array('id'=>$uid),array('name'));
    	session(['uid' => $uid]);
    	session(['username'=>$userinfo->name]);
		
		$user = $this::find($uid);
		if ($user) {
	    	$user->last_login_time = time();
	    	$user->last_login_ip = Request()->getClientIp();

	    	$user->save();
		}
		
	}

	/**
	 * 获取基本的会员信息
	 */
	public function getBasicUserInfo($map = array())
	{
		return $this->where($map)->first();
	}
}
