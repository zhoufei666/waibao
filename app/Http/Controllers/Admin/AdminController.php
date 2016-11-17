<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Redirect;

class AdminController extends Controller {

    public function __construct(Request $request)
    {
        $this->isLogin($request);
    }

    //跳转方式：
    //跳转到／home页
    // return redirect('/home');
    
    //登录成功后跳转登录前的那页，但一般我不这么用根据情况使用
    // return redirect()->back();
    
    //成功后登录我想使用的控制器
    // return redirect()->action('IndexController@index');
     // Route()->to('login');
    // Redirect::to('Admin\LoginController@login');
    // return redirect()->action('Admin\LoginController@login');
    // return redirect('/');
    // return redirect()->back();


    /**
     * 判断用户是否登录
     * @param int $uid 用户id
     */
	public function isLogin(Request $request)
	{
		$uid = Session::get('uid'); 

        //未登陆跳转页面
        if ($uid === NULL) {
            return Redirect::route('login');
            // return route('login');            
            // dd(Redirect::route('login'));
            // return redirect()->back();
            // // return Redirect::route('login');
            // // print_r($request->session()->all());die;
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
