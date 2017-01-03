<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Redirect;

class AdminController extends Controller {

    public function __construct()
    {
        $this->isLogin();
    }

    /**  
     * 获取当前方法名  
     * @return string  
     */  
    public function getCurrentMethodName()  
    {  
        return getCurrentAction()['method'];  
    }
    /**  
     * 获取当前控制器与方法  
     * @return array  
     */  
    public function getCurrentAction()  
    {  
        $action = \Route::current()->getActionName();  
        list($class, $method) = explode('@', $action);  
     
        return   ['controller' => $class, 'method' => $method];
    }


    /**
     * 判断用户是否登录
     * @return bool
     */
	 public function isLogin()
	 {
	 	$uid = Session::get('uid');
         if ($uid === NULL) {
             return false;
         }else{
             return true;
         }
	 }

    // dd(route('login'));
    // return  redirect(route('login'));

    // return Redirect::route('login');
    // return route('login');
    // dd(Redirect::route('login'));
    // return redirect()->back();
    // // return Redirect::route('login');
    // // print_r($request->session()->all());die;


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

}

/**
 * 开发规范
 * 1.用户id：统一用uid
 *
 *
 *
 *
 *
 */
