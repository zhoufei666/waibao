<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

   	//登录人员uid name
   	public $uid = '';
   	public $username = '';
   	public $remember_login = '';

   	public function __construct()
    {
   		//登录人员uid name
	   	$this->uid = session('uid');
	   	$this->username = session('username');
	   	$this->remember_login = session('remember_login');
   	}

   	

   	/**
   	 * 判断是是否是登录
   	 * @param $uid  验证用户的id
   	 * @return bool 
   	 */
   	public function is_login($uid = '')
   	{
   		$session_uid = session('uid');
   		if ($uid) {   			
   			return ($uid == $session_uid)?true:false;
   		}else{
   			return $session_uid;
   		}
   	}


    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    protected function ajaxReturn($data,$type='') {
        $type = empty($type)?'JSON':$type;
        switch (strtoupper($type)){
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler.'('.json_encode($data).');');  
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);            
        }
    }

    /**
     * 表单验证错误实例--返回数组
     * @param object $object 实例对象
     * @param array $field 返回错误信息字段 
     */
    public function errorMessageArrayToString($object,$field = '')
    {
    	$msg = '';
    	foreach ($object->all() as $key => $message) {
    		if ($field != '') {
    			if (in_array($key, $field)) {
    				$msg = $msg.$message.'  ';
    			}
    		}else{
    			$msg = $msg.$message.'  ';
    		}
    	}
    	return $msg;
    }
}
